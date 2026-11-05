<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $belum = Peminjaman::query()
            ->with(['user', 'alat'])
            ->whereIn('status', ['disetujui', 'dipinjam'])
            ->orderBy('tanggal_kembali')
            ->get();

        $sudah = Peminjaman::query()
            ->with(['user', 'alat'])
            ->where('status', 'dikembalikan')
            ->orderByDesc('updated_at')
            ->get();

        $formatDate = static fn ($date) => $date?->format('d M Y') ?? '-';
        $categoryClass = static fn (?string $category) => in_array(strtolower((string) $category), ['osis', 'rohis'], true)
            ? strtolower($category)
            : '';

        $pendingReturns = $belum->map(function (Peminjaman $peminjaman) use ($formatDate, $categoryClass) {
                $tanggalKembali = $peminjaman->tanggal_kembali;
                $lateDays = $tanggalKembali && $tanggalKembali->lt(today())
                    ? (int) $tanggalKembali->diffInDays(today())
                    : 0;
                $kategori = $peminjaman->kategori ?: $peminjaman->alat?->kategori;

                return [
                    'id' => (string) $peminjaman->id,
                    'name' => $peminjaman->user?->name ?? 'Nama peminjam tidak tersedia',
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
                    'returnDate' => '-',
                    'dueLabel' => $lateDays > 0 ? 'Terlambat ' . $lateDays . ' hari' : 'Jatuh tempo ' . $formatDate($tanggalKembali),
                    'lateDays' => $lateDays,
                    'damaged' => $peminjaman->kondisi_kembali !== null && $peminjaman->kondisi_kembali !== 'baik',
                    'damageNote' => $peminjaman->catatan_kondisi ?? '',
                ];
            })->values();
        $returnedRecords = $sudah->map(function (Peminjaman $peminjaman) use ($formatDate, $categoryClass) {
                $kategori = $peminjaman->kategori ?: $peminjaman->alat?->kategori;
                $tanggalPengembalian = $peminjaman->tanggal_pengembalian ?? $peminjaman->updated_at;
                $lateDays = $peminjaman->tanggal_kembali && $tanggalPengembalian
                    && $tanggalPengembalian->gt($peminjaman->tanggal_kembali)
                    ? (int) $peminjaman->tanggal_kembali->diffInDays($tanggalPengembalian)
                    : 0;

                return [
                    'name' => $peminjaman->user?->name ?? 'Nama peminjam tidak tersedia',
                    'className' => $peminjaman->user?->kelas ?? '-',
                    'nis' => $peminjaman->user?->nis ?? '-',
                    'item' => $peminjaman->alat?->nama_alat ?? 'Alat tidak tersedia',
                    'code' => $peminjaman->alat?->kode_alat ?? '-',
                    'category' => strtoupper($kategori ?? '-'),
                    'categoryClass' => $categoryClass($kategori),
                    'borrowDate' => $formatDate($peminjaman->tanggal_pinjam),
                    'returnDate' => $formatDate($tanggalPengembalian),
                    'fine' => $lateDays * 5000,
                ];
            })->values();

        return view('petugas.pengembalian', [
            'pendingReturns' => $pendingReturns,
            'returnedRecords' => $returnedRecords,
            'activeTab' => $pendingReturns->isEmpty() && $returnedRecords->isNotEmpty()
                ? 'sudah'
                : 'belum',
        ]);
    }

    public function konfirmasi(Request $request, $id)
    {
        $data = $request->validate([
            'kondisi_kembali' => 'nullable|in:baik,rusak_ringan,rusak_berat',
            'catatan_kondisi' => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($id, $data) {
            $peminjaman = Peminjaman::query()
                ->lockForUpdate()
                ->findOrFail($id);

            if (!in_array($peminjaman->status, ['disetujui', 'dipinjam'], true)) {
                return; // sudah diproses sebelumnya, jangan dobel
            }

            $alat = Alat::query()
                ->lockForUpdate()
                ->findOrFail($peminjaman->alat_id);

            // Kembalikan stok alat
            $alat->increment('stok');

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_pengembalian' => today(),
                'kondisi_kembali' => $data['kondisi_kembali'] ?? 'baik',
                'catatan_kondisi' => $data['catatan_kondisi'] ?? $peminjaman->catatan_kondisi,
            ]);

            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'peminjaman_id' => $peminjaman->id,
                'jenis' => 'dikembalikan',
                'judul' => 'Alat telah dikembalikan 🔄',
                'pesan' => 'Alat ' . $alat->nama_alat . ' telah dikembalikan dan diterima petugas.' .
                    ' Terima kasih telah meminjam dengan tertib.',
            ]);
        });

        return back()->with('success', 'Pengembalian berhasil disimpan.');
    }
}
