<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Halaman daftar notifikasi siswa.
     */
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', auth()->id())
            ->with('peminjaman.alat')
            ->latest()
            ->paginate(15);

        $belumDibaca = Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->count();

        return view('siswa.notifikasi', compact('notifikasis', 'belumDibaca'));
    }

    /**
     * Tandai satu notifikasi sebagai dibaca.
     */
    public function tandaiDibaca(Request $request, $id)
    {
        $notifikasi = Notifikasi::where('user_id', auth()->id())->findOrFail($id);
        $notifikasi->update(['dibaca' => true]);

        return redirect()->route('siswa.notifikasi');
    }

    /**
     * Tandai semua notifikasi sebagai dibaca.
     */
    public function tandaiSemuaDibaca(Request $request)
    {
        Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return redirect()->route('siswa.notifikasi')
            ->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}
