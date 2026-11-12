<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Item;
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

        // Pemakaian kategori dihitung dari kategori BARANG (items->category)
        // yang tertaut ke alat, bukan dari kolom 'kategori' di tabel peminjamans
        // yang isinya sering tidak konsisten.
        $categoryCounts = (clone $activePeminjaman)
            ->join('alats', 'alats.id', '=', 'peminjamans.alat_id')
            ->join('items', 'items.alat_id', '=', 'alats.id')
            ->join('categories', 'categories.id', '=', 'items.category_id')
            ->selectRaw('LOWER(categories.nama) as kategori_name, COUNT(*) as total')
            ->groupBy('kategori_name')
            ->pluck('total', 'kategori_name');

        $alats = Alat::query()
            ->where('is_active', true)
            ->with('item.category')
            ->orderBy('nama_alat')
            ->get();

        $pendingSiswaCount = User::where('role', 'siswa')
            ->where('status_akun', 'pending')
            ->count();

        return view('petugas.dashboard', [
            'totalStok' => Item::sum('stok'),
            'stokTersedia' => Alat::where('is_active', true)->sum('stok'),
            'alats' => $alats,
            'dipinjamCount' => $statusCounts->get('dipinjam', 0)
                + $statusCounts->get('disetujui', 0)
                + $statusCounts->get('menunggu_konfirmasi', 0),
            'menungguCount' => $statusCounts->get('menunggu', 0),
            'pendingSiswaCount' => $pendingSiswaCount,
            'terlambatCount' => $lateCount,
            'peminjamans' => $peminjamans,
            'latePeminjamans' => $latePeminjamans,
            'categoryCounts' => $categoryCounts,
        ]);
    }
}
