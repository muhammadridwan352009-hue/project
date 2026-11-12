<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    // Read: Menampilkan daftar barang
    public function index()
    {
        $items = Item::with(['category', 'alat'])->latest()->get();
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
            'kode_barang' => [
                'required',
                'string',
                'max:20',
                'unique:items,kode_barang',
                Rule::unique('alats', 'kode_alat'),
            ],
            'nama_barang' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
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

        $data = $request->only(['category_id', 'kode_barang', 'nama_barang', 'deskripsi', 'stok', 'kondisi']);

        // Simpan foto barang ke storage/public/foto-barang
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-barang', 'public');
        }

        DB::transaction(function () use ($data) {
            $item = Item::create($data);
            $category = Category::findOrFail($item->category_id);
            $alat = new Alat();
            $this->syncStudentCatalogItem($alat, $item, $category, (int) $item->stok);
            $alat->save();
            $item->alat()->associate($alat)->save();
        });

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
            'kode_barang' => [
                'required',
                'string',
                'max:20',
                Rule::unique('items', 'kode_barang')->ignore($item->id),
                Rule::unique('alats', 'kode_alat')->ignore($item->alat_id),
            ],
            'nama_barang' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'stok'        => 'required|integer|min:0',
            'kondisi'     => 'required|in:baik,rusak_ringan,rusak_berat',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['category_id', 'kode_barang', 'nama_barang', 'deskripsi', 'stok', 'kondisi']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-barang', 'public');
        }

        $fotoLama = $item->foto;
        DB::transaction(function () use ($item, $data) {
            $item = Item::query()->lockForUpdate()->findOrFail($item->id);
            $stokLama = (int) $item->stok;
            $stokBaru = (int) $data['stok'];
            $alatBaru = !$item->alat_id;
            $alat = $alatBaru
                ? new Alat()
                : Alat::query()->lockForUpdate()->findOrFail($item->alat_id);

            $peminjamanAktif = $alatBaru
                ? 0
                : $alat->peminjamans()
                    ->whereIn('status', ['disetujui', 'dipinjam', 'menunggu_konfirmasi'])
                    ->count();
            $stokTersediaLama = $alatBaru ? 0 : (int) $alat->stok;
            $stokTidakTersedia = $alatBaru
                ? 0
                : max(0, $stokLama - $stokTersediaLama - $peminjamanAktif);

            if ($stokBaru < $peminjamanAktif + $stokTidakTersedia) {
                throw ValidationException::withMessages([
                    'stok' => 'Total unit tidak boleh lebih sedikit daripada unit yang sedang dipinjam atau tidak layak digunakan.',
                ]);
            }

            $stokTersediaBaru = $stokBaru - $peminjamanAktif - $stokTidakTersedia;
            $item->update($data);
            $category = Category::findOrFail($item->category_id);
            $this->syncStudentCatalogItem($alat, $item, $category, $stokTersediaBaru);
            $alat->save();
            $item->alat()->associate($alat)->save();
        });

        if ($request->hasFile('foto') && $fotoLama && Storage::disk('public')->exists($fotoLama)) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()->route('petugas.inventaris.index')
                         ->with('success', 'Data barang berhasil diperbarui!');
    }

    // Delete: Hapus data barang
    public function destroy(Item $item)
    {
        DB::transaction(function () use ($item) {
            if ($item->alat_id) {
                Alat::whereKey($item->alat_id)->update([
                    'is_active' => false,
                    'stok' => 0,
                ]);
            }

            $item->delete();
        });

        return redirect()->route('petugas.inventaris.index')
                         ->with('success', 'Data barang berhasil dihapus!');
    }

    private function syncStudentCatalogItem(Alat $alat, Item $item, Category $category, int $stokTersedia): void
    {
        $alat->fill([
            'kode_alat' => $item->kode_barang,
            'nama_alat' => $item->nama_barang,
            'deskripsi' => $item->deskripsi,
            'kategori' => strtolower($category->nama),
            'stok' => $stokTersedia,
            'kondisi' => ucfirst(str_replace('_', ' ', $item->kondisi)),
            'is_active' => true,
        ]);

        if ($item->foto) {
            $alat->foto = $item->foto;
        }
    }
}