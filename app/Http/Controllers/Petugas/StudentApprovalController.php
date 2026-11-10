<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StudentApprovalController extends Controller
{
    /**
     * Tampilkan halaman persetujuan akun siswa dalam satu tabel tunggal.
     */
    public function index(Request $request): View
    {
        $search = trim($request->query('q', ''));

        $query = User::query()
            ->where('role', 'siswa');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        // Urutkan data berdasarkan pendaftaran terbaru
        $students = $query->latest()->paginate(20)->withQueryString();

        $pendingSiswaCount = User::where('role', 'siswa')
            ->where('status_akun', 'pending')
            ->count();

        return view('petugas.persetujuan-siswa', [
            'students' => $students,
            'search' => $search,
            'pendingSiswaCount' => $pendingSiswaCount,
        ]);
    }

    /**
     * Setujui akun siswa (berubah status menjadi approved).
     */
    public function approve(int $id): RedirectResponse
    {
        $student = User::where('role', 'siswa')->findOrFail($id);
        $student->update([
            'status_akun' => 'approved',
        ]);

        return back()->with('status', "Akun siswa {$student->name} ({$student->nis}) berhasil DISETUJUI.");
    }

    /**
     * Tolak akun siswa (berubah status menjadi rejected).
     */
    public function reject(int $id): RedirectResponse
    {
        $student = User::where('role', 'siswa')->findOrFail($id);
        $student->update([
            'status_akun' => 'rejected',
        ]);

        return back()->with('status', "Akun siswa {$student->name} ({$student->nis}) berhasil DITOLAK.");
    }

    /**
     * Hapus permanen akun siswa beserta relasinya (peminjaman, notifikasi, dsb).
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = User::where('role', 'siswa')->findOrFail($id);
        $nama = $student->name;
        $nis = $student->nis;

        // Hapus relasi terkait agar tidak ada data yatim (orphan).
        Peminjaman::where('user_id', $student->id)->delete();
        Notifikasi::where('user_id', $student->id)->delete();

        $student->delete();

        return back()->with('status', "Akun siswa {$nama} ({$nis}) berhasil DIHAPUS permanen.");
    }
}
