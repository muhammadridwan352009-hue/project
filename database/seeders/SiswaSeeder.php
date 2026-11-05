<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Nadia Putri',
            'email' => 'sisa@smkn5surakarta.id',
            'nis' => '12345',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        User::create([
            'name' => 'Test Siswa',
            'email' => 'test@siswa.com',
            'nis' => '67890',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);
    }
}