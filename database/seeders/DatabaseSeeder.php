<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        // Account Petugas
        User::updateOrCreate(
            ['email' => 'petugas@smkn5surakarta.id'],
            [
                'name' => 'Rizky Maulana',
                'email' => 'petugas@smkn5surakarta.id',
                'password' => Hash::make('password123'),
                'role' => 'petugas',
            ]
        );

        // Account Siswa (Ditambahkan kolom 'nis' agar bisa login pakai NIS 33189)
        User::updateOrCreate(
            ['email' => 'siswa@smkn5surakarta.id'],
            [
                'name' => 'Nadia Putri',
                'nis' => '33189', // <--- Ditambahkan agar pencarian NIS di AuthController berhasil
                'email' => 'siswa@smkn5surakarta.id',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
            ]
        );

        // Contoh pengisian form login siswa (akun dummy):
        // NIS : 33189
        // Email dummy : siswa@smkn5surakarta.id
        // Kata sandi  : password123

        // 10 Akun dummy tambahan khusus login siswa
        $siswaDummy = [
            ['name' => 'Ahmad Fauzan',    'nis' => '33001', 'email' => 'ahmad.fauzan@siswa.smkn5surakarta.id',    'kelas' => 'X RPL 1'],
            ['name' => 'Bunga Lestari',   'nis' => '33002', 'email' => 'bunga.lestari@siswa.smkn5surakarta.id',   'kelas' => 'X RPL 2'],
            ['name' => 'Citra Ayu',       'nis' => '33003', 'email' => 'citra.ayu@siswa.smkn5surakarta.id',       'kelas' => 'XI TKJ 1'],
            ['name' => 'Dimas Prasetyo',  'nis' => '33004', 'email' => 'dimas.prasetyo@siswa.smkn5surakarta.id',  'kelas' => 'XI TKJ 2'],
            ['name' => 'Eka Wulandari',   'nis' => '33005', 'email' => 'eka.wulandari@siswa.smkn5surakarta.id',   'kelas' => 'XI MM 1'],
            ['name' => 'Fajar Nugroho',   'nis' => '33006', 'email' => 'fajar.nugroho@siswa.smkn5surakarta.id',   'kelas' => 'XI MM 2'],
            ['name' => 'Gita Permata',    'nis' => '33007', 'email' => 'gita.permata@siswa.smkn5surakarta.id',    'kelas' => 'XII RPL 1'],
            ['name' => 'Hendra Saputra',  'nis' => '33008', 'email' => 'hendra.saputra@siswa.smkn5surakarta.id',  'kelas' => 'XII RPL 2'],
            ['name' => 'Indah Sari',      'nis' => '33009', 'email' => 'indah.sari@siswa.smkn5surakarta.id',      'kelas' => 'XII TKJ 1'],
            ['name' => 'Joko Ramadhan',   'nis' => '33010', 'email' => 'joko.ramadhan@siswa.smkn5surakarta.id',   'kelas' => 'XII TKJ 2'],
        ];

        foreach ($siswaDummy as $siswa) {
            User::updateOrCreate(
                ['email' => $siswa['email']],
                [
                    'name' => $siswa['name'],
                    'nis' => $siswa['nis'],
                    'email' => $siswa['email'],
                    'kelas' => $siswa['kelas'],
                    'password' => Hash::make('password123'),
                    'role' => 'siswa',
                ]
            );
        }

        $this->call(MuhammadRidwanArrosyidSeeder::class);
        $this->call(KatalogAlatSeeder::class);
    }
}