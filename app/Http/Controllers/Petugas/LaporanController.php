<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\LaporanKondisiAlat;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(): View
    {
        $laporanKondisis = LaporanKondisiAlat::query()
            ->with(['peminjaman.user', 'peminjaman.alat'])
            ->latest()
            ->get();

        return view('petugas.laporan', [
            'laporanKondisis' => $laporanKondisis,
            'rekapKondisi' => $laporanKondisis
                ->countBy('kondisi_terima')
                ->all(),
        ]);
    }

    public function exportKondisi(): StreamedResponse
    {
        $laporanKondisis = LaporanKondisiAlat::query()
            ->with(['peminjaman.user', 'peminjaman.alat'])
            ->latest()
            ->get();

        return response()->streamDownload(function () use ($laporanKondisis): void {
            $output = fopen('php://output', 'w');
            if ($output === false) {
                throw new \RuntimeException('Tidak dapat membuka aliran ekspor laporan.');
            }

            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, [
                'Tanggal laporan',
                'Nama siswa',
                'Email siswa',
                'Nama alat',
                'Kode inventaris',
                'Kategori',
                'Lokasi kegiatan',
                'Tanggal pengembalian',
                'Kondisi alat',
                'Deskripsi kondisi',
                'Bukti foto terlampir',
            ]);

            foreach ($laporanKondisis as $laporan) {
                fputcsv($output, [
                    $laporan->created_at?->format('Y-m-d H:i:s'),
                    $laporan->peminjaman?->user?->name ?? $laporan->nama_peminjam,
                    $laporan->peminjaman?->user?->email ?? '',
                    $laporan->peminjaman?->alat?->nama_alat ?? '',
                    $laporan->kode_inventaris,
                    $laporan->kategori,
                    $laporan->lokasi_kegiatan,
                    $laporan->tanggal_pengembalian,
                    str_replace('_', ' ', $laporan->kondisi_terima),
                    $laporan->deskripsi_kerusakan,
                    $laporan->kirim_dengan_foto ? 'Ya' : 'Tidak',
                ]);
            }

            fclose($output);
        }, 'laporan-kondisi-alat.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
