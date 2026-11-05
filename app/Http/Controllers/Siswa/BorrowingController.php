<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Borrowing;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Str;

class BorrowingController extends Controller
{
    // Daftar peminjaman milik siswa yang login
    public function index()
    {
        $items = Item::all();
        $peminjaman = Borrowing::with('item')
            ->when(Auth::check(), fn ($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->get();

        return view('siswa.peminjaman', compact('items', 'peminjaman'));
    }

    // Form ajukan peminjaman
    public function create()
    {
        // Ubah nama kolom di bawah jika di tabel items berbeda
        $alat = Item::all()
            ->map(fn ($i) => [
                'id'              => $i->id,
                'kategori'        => $i->kategori ?? 'Umum',
                'nama'            => $i->nama,
                'kode_inventaris' => $i->kode_inventaris,
                'stok'            => (int) $i->stok,
            ])
            ->filter(fn ($i) => $i['stok'] > 0)
            ->values();

        return view('siswa.ajukan', [
            'alat'     => $alat,
            'kategori' => $alat->pluck('kategori')->unique()->values(),
        ]);
    }

    // Simpan pengajuan
    public function store(Request $request)
    {
        $data = $request->validate([
            'organisasi'       => 'required|string|max:100',
            'penanggung_jawab' => 'required|string|max:100',
            'alat_id'          => 'required|exists:items,id',
            'jumlah'           => 'required|integer|min:1',
            'tanggal_pinjam'   => 'required|date|after_or_equal:today',
            'tanggal_kembali'  => 'required|date|after_or_equal:tanggal_pinjam',
            'waktu_mulai'      => 'required|date_format:H:i',
            'waktu_selesai'    => 'required|date_format:H:i|after:waktu_mulai',
            'keperluan'        => 'required|string|max:500',
            'lokasi'           => 'required|string|max:150',
        ]);

        $item = Item::findOrFail($data['alat_id']);
        if ($data['jumlah'] > $item->stok) {
            return back()->withInput()->withErrors([
                'jumlah' => "Jumlah melebihi stok tersedia ({$item->stok}).",
            ]);
        }

        Borrowing::create([
            'user_id'          => Auth::id(),
            'nama_peminjam'    => $request->user()->name,
            'item_id'          => $data['alat_id'],
            'jumlah'           => $data['jumlah'],
            'organisasi'       => $data['organisasi'],
            'penanggung_jawab' => $data['penanggung_jawab'],
            'tanggal_pinjam'   => $data['tanggal_pinjam'],
            'tanggal_kembali'  => $data['tanggal_kembali'],
            'waktu_mulai'      => $data['waktu_mulai'],
            'waktu_selesai'    => $data['waktu_selesai'],
            'keperluan'        => $data['keperluan'],
            'lokasi'           => $data['lokasi'],
            'status'           => 'pending',
        ]);

        return redirect()->route('siswa.peminjaman')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }
}