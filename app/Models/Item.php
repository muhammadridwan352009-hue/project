<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'alat_id', 'kode_barang', 'nama_barang', 'stok', 'kondisi', 'foto'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}