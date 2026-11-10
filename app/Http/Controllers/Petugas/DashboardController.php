<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $statusCounts = Peminjaman::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $activePeminjaman = Peminjaman::query()
            ->whereIn('status', ['disetujui', 'dipinjam']);

        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->take(8)
            ->get();

        $lateQuery = Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])
            ->whereDate('tanggal_kembali', '<', today());

        $lateCount = (clone $lateQuery)->count();
        $latePeminjamans = $lateQuery->with(['user', 'alat'])
            ->orderBy('tanggal_kembali')
            ->take(3)
            ->get();

        $categoryCounts = (clone $activePeminjaman)
            ->selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $alats = Alat::query()
            ->where('is_active', true)
            ->orderBy('nama_alat')
            ->get();

        $pendingSiswaCount = User::where('role', 'siswa')
            ->where('status_akun', 'pending')
            ->count();

        return view('petugas.dashboard', [
            'totalStok' => Alat::sum('stok'),
            'alats' => $alats,
            'dipinjamCount' => $statusCounts->get('dipinjam', 0),
            'menungguCount' => $statusCounts->get('menunggu', 0),
            'pendingSiswaCount' => $pendingSiswaCount,
            'terlambatCount' => $lateCount,
            'peminjamans' => $peminjamans,
            'latePeminjamans' => $latePeminjamans,
            'categoryCounts' => $categoryCounts,
        ]);
    }
}
