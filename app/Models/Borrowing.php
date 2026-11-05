<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'nama_peminjam',
        'item_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'catatan_petugas'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}