<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKondisiAlat extends Model
{
    use HasFactory;

    protected $table = 'laporan_kondisi_alats';

    protected $guarded = [];

    protected $casts = [
        'kirim_dengan_foto' => 'boolean',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}