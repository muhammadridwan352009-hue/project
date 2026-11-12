<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class AuthController extends Controller
{
    public function registerSiswa(Request $request)
    {
        $jurusan = [
            'DPIB',
            'BKP',
            'TOI',
            'TITL',
            'TEI',
            'TP',
            'TKRO',
            'TBSM',
            'RPL',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'regex:/^[0-9]{5,20}$/', 'unique:users,nis'],
            'tingkat_kelas' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'jurusan' => ['required', Rule::in($jurusan)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => trim(preg_replace('/\s+/', ' ', $validated['name'])),
            'nis' => $validated['nis'],
            'kelas' => $validated['tingkat_kelas'].' '.$validated['jurusan'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'siswa',
            'status_akun' => 'pending',
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Pendaftaran berhasil diajukan! Akun Anda saat ini berstatus pending (menunggu persetujuan petugas sarpras). Silakan tunggu hingga disetujui untuk dapat login.');
    }

    // Petugas mendaftarkan akun siswa baru dari ruang petugas
    public function createSiswaPetugas()
    {
        return view('petugas.daftar-siswa');
    }

    public function storeSiswaPetugas(Request $request)
    {
        $jurusan = [
            'DPIB', 'BKP', 'TOI', 'TITL', 'TEI', 'TP', 'TKRO', 'TBSM', 'RPL',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'regex:/^[0-9]{5,20}$/', 'unique:users,nis'],
            'tingkat_kelas' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'jurusan' => ['required', Rule::in($jurusan)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => trim(preg_replace('/\s+/', ' ', $validated['name'])),
            'nis' => $validated['nis'],
            'kelas' => $validated['tingkat_kelas'].' '.$validated['jurusan'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'siswa',
            'status_akun' => 'approved',
        ]);

        return redirect()
            ->route('petugas.persetujuan-siswa')
            ->with('status', 'Akun siswa resmi berhasil dibuat dan langsung disetujui (aktif).');
    }

    /**
     * Proses autentikasi terpadu untuk Siswa dan Petugas.
     * Sistem secara otomatis membaca kolom `role` pada tabel `users`.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $email = trim($request->input('email'));
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Cari data user berdasarkan email
        $user = User::where('email', $email)->first();

        // Jika user ditemukan dan password cocok
        if ($user && \Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            // Periksa status akun jika role adalah siswa
            if ($user->role === 'siswa') {
                $status = $user->status_akun ?? 'pending';

                if ($status === 'pending') {
                    return back()
                        ->with('error', 'Akun Anda masih dalam status PENDING (menunggu persetujuan petugas sarpras). Anda belum dapat masuk.')
                        ->withInput($request->only('email'));
                }

                if ($status === 'rejected') {
                    return back()
                        ->with('error', 'Mohon maaf, pendaftaran akun Anda DITOLAK oleh petugas. Silakan hubungi pihak sarpras sekolah.')
                        ->withInput($request->only('email'));
                }
            }

            // Lakukan login
            Auth::guard('web')->login($user, $remember);
            $request->session()->regenerate();

            // Arahkan ke dashboard sesuai role
            if ($user->role === 'petugas') {
                return redirect()->intended(route('petugas.dashboard'));
            }

            return redirect()->intended(route('siswa.beranda'));
        }

        return back()
            ->withErrors([
                'email' => 'Email atau kata sandi yang Anda masukkan salah.',
            ])
            ->withInput($request->only('email'));
    }

    public function loginSiswa(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
            'nis' => 'nullable|string|max:20',
        ]);

        $login = trim($request->input('login'));

        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'nis';

        $credentials = [
            $field => $login,
            'password' => $request->input('password'),
            'role' => 'siswa',
        ];

        // Cari data user terlebih dahulu untuk mengecek status akun
        $userCheck = User::where($field, $login)
            ->where('role', 'siswa')
            ->first();

        if ($userCheck && \Illuminate\Support\Facades\Hash::check($request->input('password'), $userCheck->password)) {
            $status = $userCheck->status_akun ?? 'pending';

            if ($status === 'pending') {
                return back()
                    ->with('error', 'Akun Anda masih dalam status PENDING (menunggu persetujuan petugas sarpras). Anda belum dapat masuk.')
                    ->withInput($request->except('password'));
            }

            if ($status === 'rejected') {
                return back()
                    ->with('error', 'Mohon maaf, pendaftaran akun Anda DITOLAK oleh petugas. Silakan hubungi pihak sarpras sekolah.')
                    ->withInput($request->except('password'));
            }
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::user();

            // Pengecekan tambahan keamanan status akun
            if ($user->status_akun !== 'approved') {
                $statusMsg = $user->status_akun === 'rejected'
                    ? 'Pendaftaran akun Anda telah ditolak oleh petugas.'
                    : 'Akun Anda masih menunggu persetujuan (pending) petugas sarpras.';
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->with('error', $statusMsg)
                    ->withInput($request->except('password'));
            }

            $profileData = [];

            if ($request->filled('nis')) {
                $profileData['nis'] = $request->input('nis');
            }

            if ($request->filled('tingkat_kelas') || $request->filled('jurusan')) {
                $profileData['tingkat_kelas'] = $request->input('tingkat_kelas');
                $profileData['jurusan'] = $request->input('jurusan');
            }

            $validator = Validator::make($profileData, [
                'nis' => [
                    'nullable',
                    'string',
                    'max:20',
                    Rule::unique('users', 'nis')->ignore($user->id),
                ],
                'tingkat_kelas' => [
                    'nullable',
                    'string',
                    Rule::in(['X', 'XI', 'XII']),
                    'required_with:jurusan',
                ],
                'jurusan' => [
                    'nullable',
                    'string',
                    Rule::in(['DPIB', 'BKP', 'TOI', 'TITL', 'TEI', 'TP', 'TKRO', 'TBSM', 'RPL']),
                    'required_with:tingkat_kelas',
                ],
            ]);

            if ($validator->fails()) {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors($validator)
                    ->withInput($request->except('password'));
            }

            if (isset($profileData['nis'])) {
                $profileData['nis'] = trim($profileData['nis']);
            }

            if (isset($profileData['tingkat_kelas'], $profileData['jurusan'])) {
                $profileData['tingkat_kelas'] = trim($profileData['tingkat_kelas']);
                $profileData['jurusan'] = trim($profileData['jurusan']);
                $profileData['kelas'] = $profileData['tingkat_kelas'].' '.$profileData['jurusan'];
                unset($profileData['tingkat_kelas'], $profileData['jurusan']);
            }

            if ($profileData !== []) {
                $user->update($profileData);
            }

            $request->session()->regenerate();

            return redirect()->route('siswa.beranda');
        }

        return back()
            ->withErrors([
                'login' => 'NIS/email atau kata sandi salah.',
            ])
            ->withInput($request->except('password'));
    }

    public function loginPetugas(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = trim($request->input('login'));

        // Saat ini akun petugas hanya dikenali lewat email
        $field = 'email';

        $credentials = [
            $field => $login,
            'password' => $request->input('password'),
            'role' => 'petugas',
        ];

        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('petugas.dashboard');
        }

        return back()
            ->withErrors([
                'login' => 'ID/email atau kata sandi petugas salah.',
            ])
            ->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
