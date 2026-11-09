<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kategori',
        'stok',
        'deskripsi',
        'kondisi',
        'foto',
        'is_active',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function laporanKondisis()
    {
        return $this->hasMany(LaporanKondisiAlat::class, 'alat_id');
    }

    public function getFotoKatalogAttribute(): ?string
    {
        if ($this->foto) {
            return '/storage/' . ltrim($this->foto, '/');
        }

        $pemetaanGambar = [
            'printer' => 'printer.jpg',
            'projector' => 'proyektor.jpg',
            'proyektor' => 'proyektor.jpg',
            'sajadah' => 'sajadah.jpg',
            'sony' => 'sony1.jpg',
            'tenda' => 'tenda.jpg',
            'tripod' => 'tripod.jpg',
        ];
        $nama = strtolower($this->nama_alat ?? '');

        foreach ($pemetaanGambar as $kataKunci => $namaFile) {
            if (str_contains($nama, $kataKunci) && file_exists(public_path($namaFile))) {
                return '/' . $namaFile;
            }
        }

        return null;
    }

    /**
     * Deskripsi yang ditampilkan di halaman detail siswa.
     * Gunakan deskripsi dari database jika terisi,
     * jika tidak, tampilkan deskripsi default sesuai jenis alat.
     */
    public function getDeskripsiTampilAttribute(): string
    {
        if (!empty($this->deskripsi)) {
            return $this->deskripsi;
        }

        $nama = strtolower($this->nama_alat ?? '');

        $default = [
            'kamera dslr'      => 'Kamera DSLR profesional untuk dokumentasi kegiatan sekolah, ekskul, dan acara resmi. Dilengkapi lensa kit dan kartu memori.',
            'kamera mirrorless'=> 'Kamera mirrorless ringan dan portabel, cocok untuk dokumentasi acara sekolah serta produksi konten multimedia.',
            'tripod'           => 'Tripod kokoh penopang kamera atau video, memastikan hasil rekaman stabil saat dokumentasi kegiatan sekolah.',
            'drone'            => 'Drone untuk pengambilan gambar udara (aerial) pada kegiatan lapangan dan dokumentasi acara besar sekolah.',
            'mikrofon wireless'=> 'Mikrofon wireless bebas kabel untuk wawancara, MC, dan perekaman suara kegiatan indoor maupun outdoor.',
            'ring light'       => 'Pencahayaan ring light untuk menghasilkan foto dan video indoor yang terang dan jernih.',
            'projector'        => 'Proyektor untuk presentasi, pemutaran film, dan kegiatan belajar mengajar di ruang kelas atau aula.',
            'laptop'           => 'Laptop high-performance untuk editing video, foto, dan desain grafis kegiatan multimedia sekolah.',
            'speaker'          => 'Speaker untuk pemenuhan kegiatan sekolah seperti pengajian, upacara, dan acara besar di dalam maupun luar ruangan.',
            'mimbar'           => 'Mimbar portable lipat untuk ceramah, tabligh akbar, dan kegiatan keagamaan sekolah.',
            'karpet'           => 'Karpet sajadah roll untuk shalat berjamaah dan kegiatan keagamaan di lapangan atau aula sekolah.',
            'sound system'     => 'Sound system lengkap untuk memperkuat suara pada kegiatan sekolah seperti pengajian, upacara, dan pentas seni.',
            'al-qur\'an'       => 'Al-Qur\'an besar untuk kegiatan tilawah, khataman, dan perlombaan qur\'an di sekolah.',
            'gitar'            => 'Gitar untuk latihan rutin dan penampilan ekskul band maupun kegiatan musik sekolah.',
            'bass'             => 'Bass elektrik untuk section bass pada penampilan band sekolah dan kegiatan musik.',
            'drum'             => 'Drum set lengkap dengan cymbal untuk latihan band dan penampilan musik di sekolah.',
            'keyboard'         => 'Keyboard untuk latihan ekskul band, penampilan musik, dan kegiatan seni sekolah.',
            'amplifier'        => 'Amplifier untuk memperkuat sinyal gitar elektrik dan bass saat latihan atau penampilan band.',
            'mixer'            => 'Mixer audio untuk mengatur keseimbangan suara pada penampilan band dan kegiatan sekolah.',
            'tenda'            => 'Tenda event untuk kegiatan outdoor, bazar, dan acara sekolah di area terbuka.',
            'banner'           => 'Standee roll up untuk dekorasi panggung, arahan acara, dan dokumentasi kegiatan sekolah.',
            'panggung'         => 'Panggung modular untuk pentas seni, upacara, dan kegiatan panggung sekolah lainnya.',
            'genset'           => 'Genset portable sebagai sumber listrik darurat pada kegiatan outdoor tanpa sumber listrik.',
            'soundcard'        => 'Soundcard untuk live streaming dan perekaman audio acara sekolah.',
            'mic'              => 'Mikrofon untuk MC, pembicara, dan penampilan pada acara sekolah.',
        ];

        foreach ($default as $kata => $deskripsi) {
            if (str_contains($nama, $kata)) {
                return $deskripsi;
            }
        }

        return 'Alat inventaris sekolah untuk mendukung kegiatan praktik, dokumentasi acara, dan operasional siswa.';
    }
}