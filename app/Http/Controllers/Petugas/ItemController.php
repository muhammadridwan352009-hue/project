<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // Read: Menampilkan daftar barang
    public function index()
    {
        $items = Item::with('category')->latest()->get();
        return view('petugas.inventaris', compact('items'));
    }

    // Create: Form tambah barang
    public function create()
    {
        $categories = Category::all();
        return view('petugas.create', compact('categories'));
    }

    // Store: Validasi & Simpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode_barang' => 'required|string|max:20|unique:items,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'kondisi'     => 'required|in:baik,rusak_ringan,rusak_berat',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'kode_barang.unique'   => 'Kode barang sudah terdaftar.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'stok.min'             => 'Stok minimal bernilai 0.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.max'             => 'Ukuran foto maksimal 2 MB.',
        ]);

        $data = $request->only(['category_id', 'kode_barang', 'nama_barang', 'stok', 'kondisi']);

        // Simpan foto barang ke storage/public/foto-barang
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-barang', 'public');
        }

        Item::create($data);

        return redirect()->route('petugas.inventaris.index')
                         ->with('success', 'Data barang berhasil ditambahkan!');
    }

    // Edit: Form edit barang
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('petugas.edit', compact('item', 'categories'));
    }

    // Update: Validasi & Perbarui data barang
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode_barang' => 'required|string|max:20|unique:items,kode_barang,' . $item->id,
            'nama_barang' => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'kondisi'     => 'required|in:baik,rusak_ringan,rusak_berat',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['category_id', 'kode_barang', 'nama_barang', 'stok', 'kondisi']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($item->foto && Storage::disk('public')->exists($item->foto)) {
                Storage::disk('public')->delete($item->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-barang', 'public');
        }

        $item->update($data);

        return redirect()->route('petugas.inventaris.index')
                         ->with('success', 'Data barang berhasil diperbarui!');
    }

    // Delete: Hapus data barang
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('petugas.inventaris.index')
                         ->with('success', 'Data barang berhasil dihapus!');
    }
}