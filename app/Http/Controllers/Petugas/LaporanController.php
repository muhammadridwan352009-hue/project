<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\LaporanKondisiAlat;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $kondisi = $request->query('kondisi');

        $query = LaporanKondisiAlat::query()
            ->with(['user', 'alat', 'peminjaman.user', 'peminjaman.alat'])
            ->latest();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_peminjam', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('alat', function ($a) use ($search) {
                      $a->where('nama_alat', 'like', "%{$search}%");
                  })
                  ->orWhereHas('peminjaman.alat', function ($pa) use ($search) {
                      $pa->where('nama_alat', 'like', "%{$search}%");
                  })
                  ->orWhere('kode_inventaris', 'like', "%{$search}%");
            });
        }

        if (!empty($kondisi) && $kondisi !== 'all') {
            $query->where('kondisi_terima', $kondisi);
        }

        $allLaporan = $query->get();

        // Bagi menjadi 3 tab
        // 1. Semua
        // 2. Menunggu Diproses (status == 'menunggu' atau 'sedang_diproses')
        // 3. Selesai (status == 'selesai')
        $laporanSemua = $allLaporan;
        $laporanMenunggu = $allLaporan->filter(fn ($item) => in_array($item->status, ['menunggu', 'sedang_diproses']));
        $laporanSelesai = $allLaporan->filter(fn ($item) => $item->status === 'selesai');

        // Rekap untuk statistik
        $totalLaporan = LaporanKondisiAlat::count();
        $totalMenunggu = LaporanKondisiAlat::where('status', 'menunggu')->count();
        $totalProses = LaporanKondisiAlat::where('status', 'sedang_diproses')->count();
        $totalSelesai = LaporanKondisiAlat::where('status', 'selesai')->count();

        return view('petugas.laporan', [
            'laporanSemua'    => $laporanSemua,
            'laporanMenunggu' => $laporanMenunggu,
            'laporanSelesai'  => $laporanSelesai,
            'counts' => [
                'semua'    => $laporanSemua->count(),
                'menunggu' => $laporanMenunggu->count(),
                'selesai'  => $laporanSelesai->count(),
                'total'    => $totalLaporan,
                'stat_menunggu' => $totalMenunggu,
                'stat_proses'   => $totalProses,
                'stat_selesai'  => $totalSelesai,
            ],
            'search'  => $search,
            'kondisi' => $kondisi,
        ]);
    }

    public function show($id)
    {
        $laporan = LaporanKondisiAlat::with(['user', 'alat', 'peminjaman.user', 'peminjaman.alat'])
            ->findOrFail($id);

        return response()->json([
            'id' => $laporan->id,
            'nama_siswa' => $laporan->user?->name ?? $laporan->peminjaman?->user?->name ?? $laporan->nama_peminjam,
            'email_siswa' => $laporan->user?->email ?? $laporan->peminjaman?->user?->email ?? '-',
            'nama_alat' => $laporan->alat?->nama_alat ?? $laporan->peminjaman?->alat?->nama_alat ?? '-',
            'kode_alat' => $laporan->alat?->kode_alat ?? $laporan->kode_inventaris ?? '-',
            'kategori' => $laporan->kategori ?? $laporan->alat?->kategori ?? '-',
            'kondisi_terima' => $laporan->kondisi_terima,
            'kondisi_label' => $laporan->kondisi_label,
            'deskripsi_kerusakan' => $laporan->deskripsi_kerusakan,
            'foto_url' => $laporan->foto ? asset('storage/' . $laporan->foto) : null,
            'tanggal_laporan' => $laporan->created_at?->format('d M Y, H:i') ?? '-',
            'status' => $laporan->status ?? 'menunggu',
            'catatan_petugas' => $laporan->catatan_petugas ?? '',
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'          => 'required|in:menunggu,sedang_diproses,selesai',
            'catatan_petugas' => 'nullable|string|max:2000',
        ]);

        $laporan = LaporanKondisiAlat::findOrFail($id);
        $laporan->update([
            'status'          => $request->status,
            'catatan_petugas' => $request->catatan_petugas,
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui menjadi: ' . ucwords(str_replace('_', ' ', $request->status)));
    }

    public function exportKondisi(): StreamedResponse
    {
        $laporanKondisis = LaporanKondisiAlat::query()
            ->with(['user', 'alat', 'peminjaman.user', 'peminjaman.alat'])
            ->latest()
            ->get();

        return response()->streamDownload(function () use ($laporanKondisis): void {
            $output = fopen('php://output', 'w');
            if ($output === false) {
                throw new \RuntimeException('Tidak dapat membuka aliran ekspor laporan.');
            }

            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, [
                'ID Laporan',
                'Tanggal Laporan',
                'Nama Siswa',
                'Nama Alat',
                'Kode Inventaris',
                'Kategori',
                'Kondisi Alat',
                'Deskripsi Kerusakan',
                'Status Laporan',
                'Catatan Petugas',
            ]);

            foreach ($laporanKondisis as $laporan) {
                fputcsv($output, [
                    $laporan->id,
                    $laporan->created_at?->format('Y-m-d H:i:s'),
                    $laporan->user?->name ?? $laporan->peminjaman?->user?->name ?? $laporan->nama_peminjam,
                    $laporan->alat?->nama_alat ?? $laporan->peminjaman?->alat?->nama_alat ?? '-',
                    $laporan->alat?->kode_alat ?? $laporan->kode_inventaris ?? '-',
                    $laporan->kategori ?? '-',
                    $laporan->kondisi_label,
                    $laporan->deskripsi_kerusakan,
                    ucwords(str_replace('_', ' ', $laporan->status ?? 'menunggu')),
                    $laporan->catatan_petugas ?? '-',
                ]);
            }

            fclose($output);
        }, 'laporan-kondisi-alat-' . date('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
