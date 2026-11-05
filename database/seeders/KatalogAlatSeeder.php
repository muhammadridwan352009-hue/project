<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class KatalogAlatSeeder extends Seeder
{
    public function run(): void
    {
        $alats = [
            [
                'kode_alat' => 'MM-PRN-001',
                'nama_alat' => 'Printer Epson',
                'kategori' => 'multimedia',
                'stok' => 1,
                'kondisi' => 'baik',
                'deskripsi' => 'Printer Epson untuk mencetak dokumen dan materi kegiatan sekolah.',
            ],
            [
                'kode_alat' => 'MM-PRO-007',
                'nama_alat' => 'Projector Epson',
                'kategori' => 'multimedia',
                'stok' => 1,
                'kondisi' => 'baik',
                'deskripsi' => 'Proyektor untuk presentasi dan kegiatan belajar mengajar di kelas atau aula.',
            ],
            [
                'kode_alat' => 'RH-KRM-003',
                'nama_alat' => 'Karpet Sajadah Roll',
                'kategori' => 'rohis',
                'stok' => 1,
                'kondisi' => 'baik',
                'deskripsi' => 'Sajadah untuk mendukung kegiatan ibadah dan keagamaan di sekolah.',
            ],
            [
                'kode_alat' => 'MM-CAM-002',
                'nama_alat' => 'Kamera Mirrorless Sony A6000',
                'kategori' => 'multimedia',
                'stok' => 1,
                'kondisi' => 'baik',
                'deskripsi' => 'Kamera Sony untuk dokumentasi kegiatan sekolah dan praktik fotografi.',
            ],
            [
                'kode_alat' => 'MM-TRI-003',
                'nama_alat' => 'Tripod Kamera 1.5 Meter',
                'kategori' => 'multimedia',
                'stok' => 1,
                'kondisi' => 'baik',
                'deskripsi' => 'Tripod kamera dengan tinggi hingga 1,5 meter untuk membantu pengambilan gambar yang stabil.',
            ],
        ];

        $columns = array_flip(Schema::getColumnListing('alats'));

        foreach ($alats as $alat) {
            Alat::firstOrCreate(
                ['kode_alat' => $alat['kode_alat']],
                array_intersect_key($alat, $columns)
            );
        }
    }
}
