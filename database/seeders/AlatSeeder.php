<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alat::updateOrCreate(
            ['kode' => 'MM-CAM-014'],
            [
                'nama' => 'Kamera Sony Alpha A6400',
                'kategori' => 'Multimedia',
                'lokasi' => 'Ruang Multimedia',
                'stok_tersedia' => 3,
                'kondisi' => 'Baik',
                'deskripsi' => 'Kamera digunakan untuk kegiatan fotografi, dokumentasi acara sekolah, dan praktik videografi siswa.',
                'persyaratan' => 'Mengisi formulir peminjaman dan menunggu persetujuan petugas.',
                'perlengkapan' => ['Kamera', 'Baterai', 'Charger', 'Tali kamera'],
            ]
        );
    }
}