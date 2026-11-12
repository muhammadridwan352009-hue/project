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

        // Kategori yang dipilih siswa harus sesuai dengan kategori alat yang dipinjam.
        if (strtolower($alat->kategori ?? '') !== strtolower($data['kategori'])) {
            throw ValidationException::withMessages([
                'kategori' => 'Kategori yang dipilih tidak sesuai dengan kategori alat (' . ucfirst($alat->kategori) . ').',
            ]);
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

    public function ajukanPengembalian($id)
    {
        DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::query()
                ->where('user_id', Auth::id())
                ->lockForUpdate()
                ->findOrFail($id);

            // Siswa tidak boleh mengajukan jika status bukan disetujui / dipinjam
            if (!in_array($peminjaman->status, ['disetujui', 'dipinjam'], true)) {
                if ($peminjaman->status === 'menunggu_konfirmasi') {
                    throw ValidationException::withMessages([
                        'pengembalian' => 'Pengajuan pengembalian untuk alat ini sedang menunggu konfirmasi petugas.',
                    ]);
                }

                if ($peminjaman->status === 'dikembalikan') {
                    throw ValidationException::withMessages([
                        'pengembalian' => 'Alat ini sudah dikembalikan.',
                    ]);
                }

                throw ValidationException::withMessages([
                    'pengembalian' => 'Pengajuan pengembalian hanya dapat dilakukan untuk alat yang sedang dipinjam atau telah disetujui.',
                ]);
            }

            // Update status menjadi menunggu_konfirmasi
            $peminjaman->update([
                'status' => 'menunggu_konfirmasi',
                'tanggal_pengajuan_kembali' => now(),
            ]);
        });

        return redirect()->route('siswa.peminjaman.index')
            ->with('success', 'Pengajuan pengembalian alat berhasil dikirim! Menunggu konfirmasi dan pemeriksaan petugas.');
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
     * Halaman Form & Riwayat Laporan Kondisi Alat Siswa
     */
    public function laporanKondisi(Request $request)
    {
        $userId = $request->user()->id;

        // Ambil peminjaman siswa untuk pilihan alat (yang pernah / sedang disetujui, dipinjam, menunggu_konfirmasi, dikembalikan)
        $peminjamans = Peminjaman::query()
            ->where('user_id', $userId)
            ->whereIn('status', ['disetujui', 'dipinjam', 'menunggu_konfirmasi', 'dikembalikan'])
            ->with('alat')
            ->latest()
            ->get();

        // Ambil riwayat laporan kondisi alat yang pernah dikirim oleh siswa ini
        $riwayatLaporan = LaporanKondisiAlat::query()
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereHas('peminjaman', function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    });
            })
            ->with(['alat', 'peminjaman'])
            ->latest()
            ->get();

        // Daftar peminjaman yang masih punya laporan aktif (menunggu/diproses)
        // agar dropdown form bisa menandai "sudah dilaporkan".
        $peminjamanLaporanAktif = LaporanKondisiAlat::query()
            ->whereIn('status', ['menunggu', 'sedang_diproses'])
            ->pluck('peminjaman_id')
            ->filter()
            ->unique();

        return view('siswa.laporan-kondisi', [
            'peminjamans'            => $peminjamans,
            'riwayatLaporan'         => $riwayatLaporan,
            'peminjamanLaporanAktif' => $peminjamanLaporanAktif,
        ]);
    }

    /**
     * Simpan Laporan Kondisi Alat dari Siswa
     */
    public function storeLaporanKondisi(Request $request)
    {
        $data = $request->validate([
            'peminjaman_id'       => 'required|exists:peminjamans,id',
            'kondisi_terima'      => 'required|in:rusak_ringan,rusak_berat,tidak_berfungsi,kehilangan',
            'deskripsi_kerusakan' => 'required|string|max:1500',
            'foto'                => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $peminjaman = Peminjaman::query()
            ->where('user_id', $request->user()->id)
            ->with('alat')
            ->findOrFail($data['peminjaman_id']);

        // Cegah laporan ganda: satu peminjaman hanya boleh memiliki
        // satu laporan yang masih menunggu / sedang diproses.
        $laporanAktif = LaporanKondisiAlat::query()
            ->where('peminjaman_id', $peminjaman->id)
            ->whereIn('status', ['menunggu', 'sedang_diproses'])
            ->exists();

        if ($laporanAktif) {
            throw ValidationException::withMessages([
                'peminjaman_id' => 'Alat ini sudah memiliki laporan yang masih diproses petugas. Mohon tunggu tanggapan sebelum membuat laporan baru.',
            ]);
        }

        $fotoPath = null;
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoPath = $request->file('foto')->store('laporan-kondisi', 'public');
        }

        LaporanKondisiAlat::create([
            'user_id'             => $request->user()->id,
            'peminjaman_id'       => $peminjaman->id,
            'alat_id'             => $peminjaman->alat_id,
            'nama_peminjam'       => $request->user()->name,
            'kode_inventaris'     => $peminjaman->alat?->kode_alat ?? 'KODE-ALAT',
            'kategori'            => $peminjaman->kategori ?? $peminjaman->alat?->kategori ?? '-',
            'lokasi_kegiatan'     => $peminjaman->lokasi_penggunaan ?? '-',
            'tanggal_pengembalian'=> $peminjaman->tanggal_kembali,
            'kondisi_terima'      => $data['kondisi_terima'],
            'deskripsi_kerusakan' => $data['deskripsi_kerusakan'],
            'kirim_dengan_foto'   => (bool) $fotoPath,
            'foto'                => $fotoPath,
            'status'              => 'menunggu',
        ]);

        return redirect()->route('siswa.laporan-kondisi')
            ->with('success', 'Laporan kondisi alat berhasil dikirim! Status saat ini: Menunggu konfirmasi/tanggapan dari petugas.');
    }
}