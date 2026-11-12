<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Alat;

class KatalogController extends Controller
{
    // Menampilkan katalog alat
    public function index()
    {
        $alats = Alat::where('is_active', true)->latest()->get();

        return view('siswa.katalog', compact('alats'));
    }

    // Menampilkan detail alat
    public function show($id)
    {
        $alat = Alat::where('is_active', true)->findOrFail($id);

        return view('siswa.detail-alat', compact('alat'));
    }
}