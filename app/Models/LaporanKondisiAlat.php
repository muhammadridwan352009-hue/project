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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    /**
     * Helper status badge
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'sedang_diproses' => ['label' => 'Sedang Diproses', 'class' => 'bg-amber-100 text-amber-700 border-amber-200'],
            'selesai' => ['label' => 'Selesai', 'class' => 'bg-emerald-100 text-emerald-700 border-emerald-200'],
            default => ['label' => 'Menunggu', 'class' => 'bg-blue-100 text-blue-700 border-blue-200'],
        };
    }

    /**
     * Helper kondisi format label
     */
    public function getKondisiLabelAttribute()
    {
        return match ($this->kondisi_terima) {
            'rusak_ringan' => 'Rusak Ringan',
            'rusak_berat' => 'Rusak Berat',
            'tidak_berfungsi' => 'Tidak Berfungsi',
            'kehilangan' => 'Kehilangan / Komponen Kurang',
            default => ucwords(str_replace('_', ' ', $this->kondisi_terima ?? '-')),
        };
    }
}
