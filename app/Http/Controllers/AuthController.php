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

        User::create([
            'name' => $validated['name'],
            'nis' => $validated['nis'],
            'kelas' => $validated['tingkat_kelas'].' '.$validated['jurusan'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'siswa',
        ]);

        return redirect()
            ->route('login.siswa')
            ->with('status', 'Pendaftaran berhasil. Silakan masuk dengan akun siswa Anda.');
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

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::user();
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
