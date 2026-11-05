<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Halaman profil siswa.
     */
    public function siswa()
    {
        $user = Auth::user();

        return view('siswa.profil', compact('user'));
    }

    /**
     * Halaman profil petugas.
     */
    public function petugas()
    {
        $user = Auth::user();

        return view('petugas.profil', compact('user'));
    }

    /**
     * Perbarui data profil pengguna yang sedang login.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ];

        if ($user->role === 'siswa') {
            $rules['nis'] = 'required|string|max:20|unique:users,nis,' . $user->id;
            $rules['kelas'] = 'nullable|string|max:50';
        }

        $data = $request->validate($rules);

        // Jika kolom password diisi, validasi dan update password
        if ($request->filled('password')) {
            $request->validate([
                'password_lama' => 'required|string',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if (!Hash::check($request->input('password_lama'), $user->password)) {
                return back()->withErrors(['password_lama' => 'Kata sandi lama tidak sesuai.']);
            }

            $data['password'] = $request->input('password');
        }

        $user->update($data);

        $route = $user->role === 'petugas' ? 'petugas.profil' : 'siswa.profil';

        return redirect()->route($route)->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Simpan / perbarui foto profil pengguna yang sedang login.
     */
    public function updateFoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'foto.required' => 'Silakan pilih foto terlebih dahulu.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.max'      => 'Ukuran foto maksimal 2 MB.',
        ]);

        // Hapus foto lama jika ada
        $this->hapusFotoLama($user);

        $user->update([
            'foto' => $request->file('foto')->store('foto-profil', 'public'),
        ]);

        $route = $user->role === 'petugas' ? 'petugas.profil' : 'siswa.profil';

        return redirect()->route($route)->with('success', 'Foto profil berhasil diperbarui.');
    }

    /**
     * Hapus foto profil pengguna yang sedang login.
     */
    public function hapusFoto()
    {
        $user = Auth::user();

        $this->hapusFotoLama($user);

        $user->update(['foto' => null]);

        $route = $user->role === 'petugas' ? 'petugas.profil' : 'siswa.profil';

        return redirect()->route($route)->with('success', 'Foto profil berhasil dihapus.');
    }

    /**
     * Hapus file foto lama dari storage.
     */
    private function hapusFotoLama($user): void
    {
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }
    }
}
