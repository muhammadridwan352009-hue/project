<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel database
    protected $table = 'peminjamans';

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'alat_id',
        'kategori',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_pengembalian',
        'keperluan',
        'lokasi_penggunaan',
        'keterangan',
        'status',
        'kondisi_kembali',
        'catatan_kondisi',
        'kondisi_awal_1',
        'kondisi_awal_2',
        'kondisi_awal_3',
        'kondisi_awal_4',
        'pilih_kondisi_awal',
        'foto_kondisi_awal',
        'kondisi_kembali_1',
        'kondisi_kembali_2',
        'kondisi_kembali_3',
        'kondisi_kembali_4',
        'pilih_kondisi_kembali',
        'foto_kondisi_kembali',
    ];

    // Format tanggal
    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_pengembalian' => 'date',
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke alat
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    // Relasi ke laporan kondisi alat
    public function laporanKondisi()
    {
        return $this->hasOne(LaporanKondisiAlat::class);
    }

    public function perpanjangans()
    {
        return $this->hasMany(PeminjamanPerpanjangan::class);
    }
}