<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alats = [
            // ===== MULTIMEDIA =====
            ['kode_alat' => 'MM-CAM-001', 'nama_alat' => 'Kamera DSLR Canon EOS 700D', 'kategori' => 'multimedia', 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Kamera DSLR untuk dokumentasi kegiatan sekolah dan ekskul multimedia.'],
            ['kode_alat' => 'MM-CAM-002', 'nama_alat' => 'Kamera Mirrorless Sony A6000', 'kategori' => 'multimedia', 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Kamera mirrorless ringan untuk dokumentasi acara dan konten multimedia.'],
            ['kode_alat' => 'MM-TRI-003', 'nama_alat' => 'Tripod Kamera 1.5 Meter', 'kategori' => 'multimedia', 'stok' => 6, 'kondisi' => 'baik', 'deskripsi' => 'Tripod kokoh untuk kamera dan video shooting kegiatan sekolah.'],
            ['kode_alat' => 'MM-DRI-004', 'nama_alat' => 'Drone DJI Mini 2', 'kategori' => 'multimedia', 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Drone untuk pengambilan gambar udara pada acara sekolah.'],
            ['kode_alat' => 'MM-MIC-005', 'nama_alat' => 'Mikrofon Wireless Rode', 'kategori' => 'multimedia', 'stok' => 5, 'kondisi' => 'baik', 'deskripsi' => 'Mikrofon wireless untuk wawancara dan perekaman suara.'],
            ['kode_alat' => 'MM-LIG-006', 'nama_alat' => 'Ring Light 18 Inci', 'kategori' => 'multimedia', 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Pencahayaan untuk konten foto dan video indoor.'],
            ['kode_alat' => 'MM-PRO-007', 'nama_alat' => 'Projector Epson', 'kategori' => 'multimedia', 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Proyektor untuk presentasi dan pemutaran film sekolah.'],
            ['kode_alat' => 'MM-LAP-008', 'nama_alat' => 'Laptop Editing Asus ROG', 'kategori' => 'multimedia', 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Laptop high-performance untuk editing video dan desain.'],

            // ===== ROHIS =====
            ['kode_alat' => 'RH-SPK-001', 'nama_alat' => 'Speaker Portable Aylong', 'kategori' => 'rohis', 'stok' => 5, 'kondisi' => 'baik', 'deskripsi' => 'Speaker portable untuk pengajian dan kegiatan rohis.'],
            ['kode_alat' => 'RH-MIM-002', 'nama_alat' => 'Mimbar Portable', 'kategori' => 'rohis', 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Mimbar lipat untuk ceramah dan tabligh akbar.'],
            ['kode_alat' => 'RH-KRM-003', 'nama_alat' => 'Karpet Sajadah Roll', 'kategori' => 'rohis', 'stok' => 8, 'kondisi' => 'baik', 'deskripsi' => 'Karpet sajadah roll untuk shalat berjamaah di lapangan.'],
            ['kode_alat' => 'RH-SYS-004', 'nama_alat' => 'Sound System Kecil', 'kategori' => 'rohis', 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Sound system kecil untuk adzan dan pengajian rutin.'],
            ['kode_alat' => 'RH-MRT-005', 'nama_alat' => 'Sound System Portable', 'kategori' => 'rohis', 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Sound system lengkap dengan mikrofon untuk acara rohis.'],
            ['kode_alat' => 'RH-QLB-006', 'nama_alat' => "Al-Qur'an Besar", 'kategori' => 'rohis', 'stok' => 10, 'kondisi' => 'baik', 'deskripsi' => "Al-Qur'an besar untuk tilawah dan khataman."],

            // ===== BAND =====
            ['kode_alat' => 'BD-GTR-001', 'nama_alat' => 'Gitar Akustik Yamaha F310', 'kategori' => 'band', 'stok' => 6, 'kondisi' => 'baik', 'deskripsi' => 'Gitar akustik untuk latihan dan penampilan ekskul band.'],
            ['kode_alat' => 'BD-GTR-002', 'nama_alat' => 'Gitar Elektrik Squier Stratocaster', 'kategori' => 'band', 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Gitar elektrik untuk penampilan band sekolah.'],
            ['kode_alat' => 'BD-BAS-003', 'nama_alat' => 'Bass Elektrik Ibanez', 'kategori' => 'band', 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Bass elektrik untuk section bass ekskul band.'],
            ['kode_alat' => 'BD-DRM-004', 'nama_alat' => 'Drum Set Pearl Roadshow', 'kategori' => 'band', 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Drum set lengkap dengan cymbal untuk latihan band.'],
            ['kode_alat' => 'BD-KBD-005', 'nama_alat' => 'Keyboard Yamaha PSR-E373', 'kategori' => 'band', 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Keyboard untuk latihan dan penampilan musik.'],
            ['kode_alat' => 'BD-MIC-006', 'nama_alat' => 'Mikrofon Shure SM58', 'kategori' => 'band', 'stok' => 5, 'kondisi' => 'baik', 'deskripsi' => 'Mikrofon vokal untuk penampilan band dan acara sekolah.'],
            ['kode_alat' => 'BD-AMP-007', 'nama_alat' => 'Amplifier Gitar Roland', 'kategori' => 'band', 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Amplifier untuk gitar elektrik dan bass.'],
            ['kode_alat' => 'BD-MIX-008', 'nama_alat' => 'Mixer Audio 8 Channel', 'kategori' => 'band', 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Mixer untuk pengaturan audio penampilan band.'],

            // ===== OSIS =====
            ['kode_alat' => 'OS-SPK-001', 'nama_alat' => 'Speaker Aktif 15 Inch', 'kategori' => 'osis', 'stok' => 6, 'kondisi' => 'baik', 'deskripsi' => 'Speaker aktif untuk event OSIS dan acara sekolah.'],
            ['kode_alat' => 'OS-MIC-002', 'nama_alat' => 'Mic Wireless Ganda Shure', 'kategori' => 'osis', 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Mic wireless ganda untuk MC dan pembicara acara.'],
            ['kode_alat' => 'OS-TND-003', 'nama_alat' => 'Tenda Event 3x3 Meter', 'kategori' => 'osis', 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Tenda untuk kegiatan outdoor dan bazar OSIS.'],
            ['kode_alat' => 'OS-PAN-004', 'nama_alat' => 'Banner Standee Roll Up', 'kategori' => 'osis', 'stok' => 8, 'kondisi' => 'baik', 'deskripsi' => 'Standee untuk dekorasi panggung dan dokumentasi acara.'],
            ['kode_alat' => 'OS-SLM-005', 'nama_alat' => 'Sound System Lapangan', 'kategori' => 'osis', 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Sound system besar untuk acara lapangan seperti MPLS dan pentas seni.'],
            ['kode_alat' => 'OS-MPG-006', 'nama_alat' => 'Panggung Modular', 'kategori' => 'osis', 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Panggung modular untuk pentas seni dan upacara.'],
            ['kode_alat' => 'OS-GNS-007', 'nama_alat' => 'Genset Portable 2.5 KVA', 'kategori' => 'osis', 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Genset untuk kegiatan outdoor tanpa sumber listrik.'],
            ['kode_alat' => 'OS-SCR-008', 'nama_alat' => 'Soundcard Streaming', 'kategori' => 'osis', 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Soundcard untuk live streaming acara sekolah.'],
        ];

        foreach ($alats as $alat) {
            Alat::updateOrCreate(
                ['kode_alat' => $alat['kode_alat']],
                $alat
            );
        }
    }
}
