<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MuhammadRidwanArrosyidSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id'],
            [
                'name' => 'Muhammad Ridwan Arrosyid',
                'nis' => '2232001',
                'kelas' => 'XII RPL A',
                'role' => 'siswa',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
