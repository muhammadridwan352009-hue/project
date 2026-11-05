<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanPerpanjangan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApprovalController extends Controller
{
    public function index()
    {
        $borrowings = Peminjaman::with(['user', 'alat'])->latest()->get();
        $perpanjangans = PeminjamanPerpanjangan::with(['peminjaman.user', 'peminjaman.alat'])
            ->where('status', 'menunggu')
            ->latest()
            ->get();

        return view('petugas.persetujuan', compact('borrowings', 'perpanjangans'));
    }

    public function updatePerpanjangan(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        DB::transaction(function () use ($id, $data) {
            $perpanjangan = PeminjamanPerpanjangan::query()
                ->lockForUpdate()
                ->findOrFail($id);
            $peminjaman = Peminjaman::query()
                ->lockForUpdate()
                ->findOrFail($perpanjangan->peminjaman_id);

            if ($perpanjangan->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'perpanjangan' => 'Permintaan perpanjangan ini sudah diproses.',
                ]);
            }

            if ($data['status'] === 'disetujui') {
                if (
                    !in_array($peminjaman->status, ['disetujui', 'dipinjam'], true)
                    || !$peminjaman->tanggal_kembali->equalTo($perpanjangan->tanggal_kembali_lama)
                    || $peminjaman->tanggal_kembali->lt(today())
                ) {
                    throw ValidationException::withMessages([
                        'perpanjangan' => 'Permintaan tidak dapat disetujui karena status atau tanggal peminjaman sudah berubah.',
                    ]);
                }

                $peminjaman->update([
                    'tanggal_kembali' => $perpanjangan->tanggal_kembali_baru,
                ]);
            }

            $perpanjangan->update([
                'status' => $data['status'],
                'disetujui_oleh' => auth()->id(),
            ]);

            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'peminjaman_id' => $peminjaman->id,
                'jenis' => 'perpanjangan',
                'judul' => 'Permintaan perpanjangan ' . ($data['status'] === 'disetujui' ? 'disetujui' : 'ditolak'),
                'pesan' => 'Pengajuan perpanjangan untuk alat ' . optional($peminjaman->alat)->nama_alat .
                    ($data['status'] === 'disetujui'
                        ? ' telah disetujui. Tanggal kembali diperpanjang.'
                        : ' ditolak oleh petugas.'),
            ]);
        });

        return redirect()->route('petugas.persetujuan')
            ->with('success', 'Permintaan perpanjangan berhasil ' . ($data['status'] === 'disetujui' ? 'disetujui.' : 'ditolak.'));
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:menunggu,disetujui,dipinjam,ditolak,dikembalikan',
        ]);

        DB::transaction(function () use ($id, $data) {
            $peminjaman = Peminjaman::query()
                ->lockForUpdate()
                ->findOrFail($id);
            $alat = Alat::query()
                ->lockForUpdate()
                ->findOrFail($peminjaman->alat_id);

            $statusAktif = ['disetujui', 'dipinjam'];
            $stokSudahDipakai = in_array($peminjaman->status, $statusAktif, true);
            $akanMemakaiStok = in_array($data['status'], $statusAktif, true);

            if (!$stokSudahDipakai && $akanMemakaiStok) {
                if ($alat->stok < 1) {
                    throw ValidationException::withMessages([
                        'status' => 'Stok alat tidak mencukupi untuk menyetujui peminjaman ini.',
                    ]);
                }

                $alat->decrement('stok');
            } elseif ($stokSudahDipakai && !$akanMemakaiStok) {
                $alat->increment('stok');
            }

            $statusSebelumnya = $peminjaman->status;
            $perubahanStatus = ['status' => $data['status']];
            if ($data['status'] === 'dikembalikan' && $statusSebelumnya !== 'dikembalikan') {
                $perubahanStatus['tanggal_pengembalian'] = today();
            }
            $peminjaman->update($perubahanStatus);

            // Buat notifikasi untuk siswa sesuai status baru
            $pesanStatus = [
                'disetujui' => [
                    'judul' => 'Peminjaman disetujui ✅',
                    'pesan' => 'Selamat! Pengajuan peminjaman alat ' . $alat->nama_alat .
                        ' telah disetujui. Silakan ambil alat di ruang sarpras sesuai jadwal.',
                ],
                'dipinjam' => [
                    'judul' => 'Alat sedang dipinjam 📦',
                    'pesan' => 'Alat ' . $alat->nama_alat . ' sedang kamu pinjam.' .
                        ' Jangan lupa kembalikan sebelum ' .
                        optional($peminjaman->tanggal_kembali)->format('d M Y') . '.',
                ],
                'ditolak' => [
                    'judul' => 'Peminjaman ditolak ❌',
                    'pesan' => 'Maaf, pengajuan peminjaman alat ' . $alat->nama_alat .
                        ' ditolak oleh petugas. Silakan ajukan kembali atau hubungi ruang sarpras.',
                ],
                'dikembalikan' => [
                    'judul' => 'Alat telah dikembalikan 🔄',
                    'pesan' => 'Alat ' . $alat->nama_alat . ' telah dikembalikan dan diterima petugas.' .
                        ' Terima kasih telah meminjam dengan tertib.',
                ],
            ];

            if (isset($pesanStatus[$data['status']])) {
                Notifikasi::create([
                    'user_id' => $peminjaman->user_id,
                    'peminjaman_id' => $peminjaman->id,
                    'jenis' => $data['status'],
                    'judul' => $pesanStatus[$data['status']]['judul'],
                    'pesan' => $pesanStatus[$data['status']]['pesan'],
                ]);
            }
        });

        return redirect()->route('petugas.persetujuan')
            ->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}