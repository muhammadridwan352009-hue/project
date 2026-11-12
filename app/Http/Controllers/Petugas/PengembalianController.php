<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        // 1. Belum Dikembalikan (status disetujui / dipinjam dan belum mengajukan pengembalian)
        $belum = Peminjaman::query()
            ->with(['user', 'alat'])
            ->whereIn('status', ['disetujui', 'dipinjam'])
            ->orderBy('tanggal_kembali', 'asc')
            ->get();

        // 2. Menunggu Konfirmasi (status menunggu_konfirmasi)
        $konfirmasi = Peminjaman::query()
            ->with(['user', 'alat'])
            ->where('status', 'menunggu_konfirmasi')
            ->orderBy('tanggal_pengajuan_kembali', 'desc')
            ->get();

        // 3. Riwayat Pengembalian (status dikembalikan)
        $sudah = Peminjaman::query()
            ->with(['user', 'alat'])
            ->where('status', 'dikembalikan')
            ->orderByDesc('tanggal_pengembalian')
            ->orderByDesc('updated_at')
            ->get();

        $formatDate = static fn ($date) => $date ? Carbon::parse($date)->format('d M Y') : '-';
        $categoryClass = static fn (?string $category) => in_array(strtolower((string) $category), ['osis', 'rohis'], true)
            ? strtolower($category)
            : '';

        $mapPeminjaman = function (Peminjaman $peminjaman, string $stage = 'belum') use ($formatDate, $categoryClass) {
            $tanggalKembali = $peminjaman->tanggal_kembali ? Carbon::parse($peminjaman->tanggal_kembali)->startOfDay() : null;
            $tanggalBanding = ($stage === 'sudah' && $peminjaman->tanggal_pengembalian)
                ? Carbon::parse($peminjaman->tanggal_pengembalian)->startOfDay()
                : today()->startOfDay();

            $lateDays = 0;
            if ($tanggalKembali && $tanggalBanding->gt($tanggalKembali)) {
                $lateDays = (int) $tanggalKembali->diffInDays($tanggalBanding);
            }

            $kategori = $peminjaman->kategori ?: $peminjaman->alat?->kategori;

            return [
                'id' => (string) $peminjaman->id,
                'name' => $peminjaman->user?->name ?? 'Peminjam tidak diketahui',
                'className' => $peminjaman->user?->kelas ?? '-',
                'nis' => $peminjaman->user?->nis ?? '-',
                'role' => $peminjaman->user?->role ?? 'siswa',
                'stat' => 'Peminjaman #' . $peminjaman->id,
                'item' => $peminjaman->alat?->nama_alat ?? 'Alat tidak tersedia',
                'code' => $peminjaman->alat?->kode_alat ?? '-',
                'category' => strtoupper($kategori ?? '-'),
                'categoryClass' => $categoryClass($kategori),
                'borrowDate' => $formatDate($peminjaman->tanggal_pinjam),
                'dueDate' => $formatDate($tanggalKembali),
                'requestDate' => $formatDate($peminjaman->tanggal_pengajuan_kembali),
                'returnDate' => $peminjaman->tanggal_pengembalian ? $formatDate($peminjaman->tanggal_pengembalian) : '-',
                'status' => $peminjaman->status,
                'dueLabel' => $lateDays > 0 ? 'Terlambat ' . $lateDays . ' hari' : 'Tepat Waktu',
                'lateDays' => $lateDays,
                'damaged' => in_array($peminjaman->kondisi_kembali, ['rusak_ringan', 'rusak_berat'], true),
                'condition' => $peminjaman->kondisi_kembali ?? 'baik',
                'damageNote' => $peminjaman->catatan_kondisi ?? '',
            ];
        };

        $belumRecords = $belum->map(fn ($p) => $mapPeminjaman($p, 'belum'))->values();
        $konfirmasiRecords = $konfirmasi->map(fn ($p) => $mapPeminjaman($p, 'konfirmasi'))->values();
        $sudahRecords = $sudah->map(fn ($p) => $mapPeminjaman($p, 'sudah'))->values();

        // Default tab
        $activeTab = $request->query('tab', 'belum');
        if (!in_array($activeTab, ['belum', 'konfirmasi', 'sudah'], true)) {
            $activeTab = $konfirmasiRecords->isNotEmpty() ? 'konfirmasi' : ($belumRecords->isNotEmpty() ? 'belum' : 'sudah');
        }

        return view('petugas.pengembalian', [
            'belumRecords' => $belumRecords,
            'konfirmasiRecords' => $konfirmasiRecords,
            'sudahRecords' => $sudahRecords,
            'activeTab' => $activeTab,
        ]);
    }

    public function konfirmasi(Request $request, $id)
    {
        $data = $request->validate([
            'kondisi_kembali' => 'required|in:baik,rusak_ringan,rusak_berat',
            'catatan_kondisi' => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($id, $data) {
            $peminjaman = Peminjaman::query()
                ->lockForUpdate()
                ->findOrFail($id);

            // Validasi status: hanya peminjaman yang sedang dipinjam/disetujui/menunggu_konfirmasi yang bisa dikonfirmasi pengembaliannya
            if (!in_array($peminjaman->status, ['menunggu_konfirmasi', 'disetujui', 'dipinjam'], true)) {
                return;
            }

            $alat = Alat::query()
                ->lockForUpdate()
                ->findOrFail($peminjaman->alat_id);

            $kondisi = $data['kondisi_kembali'];
            $isKondisiBaik = ($kondisi === 'baik');

            // Ketentuan: Stok tersedia otomatis bertambah jika barang dalam kondisi baik dan layak digunakan.
            // Jika barang rusak (rusak_ringan atau rusak_berat), stok TIDAK boleh otomatis bertambah sebelum dinyatakan layak digunakan.
            if ($isKondisiBaik) {
                $alat->increment('stok');
            }

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_pengembalian' => today(),
                'kondisi_kembali' => $kondisi,
                'catatan_kondisi' => $data['catatan_kondisi'] ?? null,
            ]);

            // Kirim notifikasi ke siswa
            $pesanKondisi = match ($kondisi) {
                'baik' => 'dengan kondisi Baik. Stok alat telah dipulihkan.',
                'rusak_ringan' => 'dengan catatan Rusak Ringan. Barang akan melalui tahap pemeliharaan/perbaikan.',
                'rusak_berat' => 'dengan catatan Rusak Berat. Barang dilaporkan untuk penanganan lebih lanjut.',
            };

            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'peminjaman_id' => $peminjaman->id,
                'jenis' => 'dikembalikan',
                'judul' => 'Pengembalian Alat Dikonfirmasi Petugas ✅',
                'pesan' => 'Alat "' . $alat->nama_alat . '" telah berhasil diterima oleh petugas ' . $pesanKondisi .
                    ($data['catatan_kondisi'] ? ' (Catatan: ' . $data['catatan_kondisi'] . ')' : ''),
            ]);
        });

        return back()->with('success', 'Konfirmasi pengembalian alat berhasil disimpan.');
    }
}
