<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PeminjamanPerpanjangan;
use App\Models\Alat;
use App\Models\LaporanKondisiAlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function beranda(Request $request)
    {
        $siswa = $request->user('web');

        $statusCounts = Peminjaman::where('user_id', $siswa->id)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $peminjamans = Peminjaman::where('user_id', $siswa->id)
            ->with('alat')
            ->latest()
            ->take(5)
            ->get();

        $peminjamanDisetujui = Peminjaman::where('user_id', $siswa->id)
            ->whereIn('status', ['disetujui', 'dipinjam'])
            ->with('alat')
            ->latest()
            ->take(3)
            ->get();

        $kategoriList = \App\Models\Category::all()->map(function ($cat) {
            $count = Alat::where('is_active', true)
                ->where('kategori', strtolower($cat->nama))
                ->count();
            return [
                'nama' => $cat->nama,
                'count' => $count,
                'slug' => strtolower($cat->nama),
            ];
        });

        return view('siswa.beranda', compact(
            'siswa',
            'peminjamans',
            'statusCounts',
            'peminjamanDisetujui',
            'kategoriList'
        ));
    }

    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', Auth::id())
            ->with(['alat', 'perpanjangans'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('is_active', true)->where('stok', '>', 0)->get();
        return view('siswa.peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'alat_id'           => 'required|exists:alats,id',
            'kategori'          => 'required|in:multimedia,rohis,band,osis',
            'tanggal_pinjam'    => 'required|date|after_or_equal:today',
            'tanggal_kembali'   => 'required|date|after_or_equal:tanggal_pinjam',
            'keperluan'         => 'required|string|max:255',
            'lokasi_penggunaan' => 'required|string|max:255',
            'keterangan'        => 'nullable|string|max:500',
        ]);

        if (Carbon::parse($data['tanggal_kembali'])->gt(Carbon::parse($data['tanggal_pinjam'])->addDays(7))) {
            throw ValidationException::withMessages([
                'tanggal_kembali' => 'Masa peminjaman maksimal 7 hari.',
            ]);
        }

        $alat = Alat::findOrFail($data['alat_id']);
        if (!$alat->is_active || $alat->stok <= 0) {
            return back()->with('error', 'Stok alat tidak tersedia.');
        }

        Peminjaman::create([
            'user_id'           => Auth::id(),
            'alat_id'           => $data['alat_id'],
            'kategori'          => $data['kategori'],
            'tanggal_pinjam'    => $data['tanggal_pinjam'],
            'tanggal_kembali'   => $data['tanggal_kembali'],
            'keperluan'         => $data['keperluan'],
            'lokasi_penggunaan' => $data['lokasi_penggunaan'],
            'keterangan'        => $data['keterangan'] ?? null,
            'status'            => 'menunggu',
        ]);

        return redirect()->route('siswa.peminjaman.index')
            ->with('success', 'Peminjaman berhasil diajukan! Menunggu persetujuan petugas.');
    }

    public function requestPerpanjangan($id)
    {
        DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::query()
                ->where('user_id', Auth::id())
                ->lockForUpdate()
                ->findOrFail($id);

            if (!in_array($peminjaman->status, ['disetujui', 'dipinjam'], true)) {
                throw ValidationException::withMessages([
                    'perpanjangan' => 'Perpanjangan hanya dapat diminta untuk peminjaman yang disetujui atau sedang dipinjam.',
                ]);
            }

            if ($peminjaman->tanggal_kembali->lt(today())) {
                throw ValidationException::withMessages([
                    'perpanjangan' => 'Perpanjangan harus diminta sebelum tanggal pengembalian.',
                ]);
            }

            $sudahMenunggu = PeminjamanPerpanjangan::query()
                ->where('peminjaman_id', $peminjaman->id)
                ->where('status', 'menunggu')
                ->exists();

            if ($sudahMenunggu) {
                throw ValidationException::withMessages([
                    'perpanjangan' => 'Permintaan perpanjangan peminjaman ini masih menunggu persetujuan petugas.',
                ]);
            }

            PeminjamanPerpanjangan::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali_lama' => $peminjaman->tanggal_kembali,
                'tanggal_kembali_baru' => $peminjaman->tanggal_kembali->copy()->addDays(7),
            ]);
        });

        return redirect()->route('siswa.peminjaman.index')
            ->with('success', 'Permintaan perpanjangan 7 hari berhasil dikirim dan menunggu persetujuan petugas.');
    }

    public function getAlatsByKategori($kategori)
    {
        $alats = Alat::where('kategori', $kategori)
            ->where('is_active', true)
            ->where('stok', '>', 0)
            ->get(['id', 'nama_alat', 'kode_alat', 'stok']);

        return response()->json($alats);
    }

    /**
     * Halaman Form Laporan Kondisi Alat
     */
    public function laporanKondisi(Request $request)
    {
        $peminjamans = Peminjaman::query()
            ->where('user_id', $request->user()->id)
            ->where(function ($query) {
                $query->whereIn('status', ['disetujui', 'dipinjam', 'dikembalikan'])
                    ->orWhereHas('laporanKondisi');
            })
            ->with(['alat', 'laporanKondisi'])
            ->latest()
            ->get();

        $peminjaman = $peminjamans->firstWhere('id', (int) $request->query('peminjaman_id'))
            ?? $peminjamans->first(fn (Peminjaman $item) => $item->laporanKondisi === null)
            ?? $peminjamans->first();

        return view('siswa.laporan-kondisi', [
            'peminjaman'  => $peminjaman,
            'peminjamans' => $peminjamans,
            'laporan'     => $peminjaman?->laporanKondisi,
        ]);
    }

    /**
     * Simpan Laporan Kondisi Alat
     */
    public function storeLaporanKondisi(Request $request)
    {
        $data = $request->validate([
            'peminjaman_id'       => 'required|exists:peminjamans,id',
            'lokasi_kegiatan'     => 'required|string|max:255',
            'tanggal_pengembalian' => 'nullable|date',
            'kondisi_terima'      => 'required|in:baik,rusak_ringan,rusak_berat,belum_dipakai',
            'deskripsi_kerusakan' => 'required|string|max:1000',
            'kirim_dengan_foto'   => 'nullable|boolean',
        ]);

        $peminjaman = Peminjaman::query()
            ->where('user_id', $request->user()->id)
            ->with('alat')
            ->findOrFail($data['peminjaman_id']);

        $laporanSebelumnya = LaporanKondisiAlat::where('peminjaman_id', $peminjaman->id)->exists();
        if (!$laporanSebelumnya && !in_array($peminjaman->status, ['disetujui', 'dipinjam', 'dikembalikan'], true)) {
            abort(403, 'Laporan hanya dapat dibuat untuk peminjaman yang sudah disetujui atau selesai.');
        }

        LaporanKondisiAlat::updateOrCreate(
            ['peminjaman_id' => $peminjaman->id],
            [
                'nama_peminjam' => $request->user()->name,
                'kode_inventaris' => $peminjaman->alat->kode_alat,
                'kategori' => $peminjaman->kategori,
                'lokasi_kegiatan' => $data['lokasi_kegiatan'],
                'tanggal_pengembalian' => $data['tanggal_pengembalian'] ?? null,
                'kondisi_terima' => $data['kondisi_terima'],
                'deskripsi_kerusakan' => $data['deskripsi_kerusakan'],
                'kirim_dengan_foto' => $request->boolean('kirim_dengan_foto'),
            ]
        );

        return redirect()->route('siswa.laporan-kondisi', ['peminjaman_id' => $peminjaman->id])
            ->with('success', $laporanSebelumnya
                ? 'Laporan kondisi alat berhasil diperbarui.'
                : 'Laporan kondisi alat berhasil dikirim! Terima kasih.');
    }
}