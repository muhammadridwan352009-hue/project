<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';

    protected $fillable = [
        'user_id',
        'peminjaman_id',
        'jenis',
        'judul',
        'pesan',
        'dibaca',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    /** Ikon sesuai jenis notifikasi */
    public function getIkonAttribute(): string
    {
        return match ($this->jenis) {
            'disetujui'    => '✅',
            'ditolak'      => '❌',
            'dikembalikan' => '🔄',
            'dipinjam'     => '📦',
            'perpanjangan' => '⏰',
            default        => '🔔',
        };
    }

    /** Warna badge sesuai jenis notifikasi */
    public function getWarnaAttribute(): string
    {
        return match ($this->jenis) {
            'disetujui'    => 'disetujui',
            'ditolak'      => 'ditolak',
            'dikembalikan' => 'dikembalikan',
            default        => 'menunggu',
        };
    }
}
