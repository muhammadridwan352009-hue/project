<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanPerpanjangan extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali_lama',
        'tanggal_kembali_baru',
        'status',
        'disetujui_oleh',
    ];

    protected $casts = [
        'tanggal_kembali_lama' => 'date',
        'tanggal_kembali_baru' => 'date',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}
