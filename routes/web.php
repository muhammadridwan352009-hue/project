<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\ItemController;
use App\Http\Controllers\Petugas\ApprovalController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Siswa\KatalogController;
use App\Http\Controllers\Siswa\NotifikasiController;
use App\Http\Controllers\PeminjamanController; // <-- TAMBAHKAN INI
use App\Http\Controllers\ProfilController;

// Halaman Utama / Login Bersama (Siswa & Petugas)
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return $user->role === 'petugas' 
            ? redirect()->route('petugas.dashboard')
            : redirect()->route('siswa.beranda');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// Fallback rute lama agar kompatibel
Route::get('/login/siswa', function () {
    return redirect()->route('login');
})->name('login.siswa');

Route::view('/register/siswa', 'auth.register-siswa')->name('register.siswa');
Route::post('/register/siswa', [AuthController::class, 'registerSiswa'])->name('register.siswa.proses');

Route::get('/login/petugas', function () {
    return redirect()->route('login');
})->name('login.petugas');

// --- RUTE DAFTAR SISWA DI AREA PETUGAS ---
Route::get('/petugas/daftar-siswa', [AuthController::class, 'createSiswaPetugas'])
    ->middleware(['auth', 'role:petugas'])->name('petugas.daftar-siswa');
Route::post('/petugas/daftar-siswa', [AuthController::class, 'storeSiswaPetugas'])
    ->middleware(['auth', 'role:petugas'])->name('petugas.daftar-siswa.proses');


// ==========================================
// AREA SISWA (Dilindungi middleware auth dan role:siswa)
// ==========================================
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/beranda', [PeminjamanController::class, 'beranda'])->name('beranda');

    // Rute Katalog & Detail Alat
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
    Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

    // --- RUTE PEMINJAMAN (Diperbarui ke PeminjamanController) ---
    // 1. Halaman daftar riwayat peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

    // 2. Halaman form ajukan peminjaman
    Route::get('/peminjaman/ajukan', [PeminjamanController::class, 'create'])->name('peminjaman.create');

    // 3. Proses simpan data peminjaman
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('/peminjaman/{id}/perpanjangan', [PeminjamanController::class, 'requestPerpanjangan'])
        ->name('peminjaman.perpanjangan');

    // 4. Route AJAX untuk mengambil daftar alat berdasarkan kategori (PENTING untuk dropdown)
    Route::get('/peminjaman/alats/{kategori}', [PeminjamanController::class, 'getAlatsByKategori'])->name('peminjaman.alats');

    // --- RUTE LAPORAN KONDISI ALAT ---
    Route::get('/laporan-kondisi', [PeminjamanController::class, 'laporanKondisi'])->name('laporan-kondisi');
    Route::post('/laporan-kondisi', [PeminjamanController::class, 'storeLaporanKondisi'])->name('laporan-kondisi.store');

    // --- RUTE NOTIFIKASI SISWA ---
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::post('/notifikasi/{id}/dibaca', [NotifikasiController::class, 'tandaiDibaca'])->name('notifikasi.dibaca');
    Route::post('/notifikasi/tandai-semua', [NotifikasiController::class, 'tandaiSemuaDibaca'])->name('notifikasi.semua-dibaca');

    // --- RUTE PROFIL SISWA ---
    Route::get('/profil', [ProfilController::class, 'siswa'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/foto', [ProfilController::class, 'updateFoto'])->name('profil.foto');
    Route::delete('/profil/foto', [ProfilController::class, 'hapusFoto'])->name('profil.foto.hapus');
});


// ==========================================
// AREA PETUGAS
// ==========================================
Route::get('/petugas/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:petugas'])
    ->name('petugas.dashboard');

// --- RUTE CRUD INVENTARIS (Khusus petugas) ---
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/inventaris', [ItemController::class, 'index'])->name('petugas.inventaris.index');
    Route::get('/petugas/inventaris/create', [ItemController::class, 'create'])->name('petugas.inventaris.create');
    Route::post('/petugas/inventaris', [ItemController::class, 'store'])->name('petugas.inventaris.store');
    Route::get('/petugas/inventaris/{item}/edit', [ItemController::class, 'edit'])->name('petugas.inventaris.edit');
    Route::put('/petugas/inventaris/{item}', [ItemController::class, 'update'])->name('petugas.inventaris.update');
    Route::delete('/petugas/inventaris/{item}', [ItemController::class, 'destroy'])->name('petugas.inventaris.destroy');
});

// --- RUTE APPROVAL PETUGAS ---
Route::middleware(['auth', 'role:petugas'])->group(function () {
    // Persetujuan Akun Siswa Baru
    Route::get('/petugas/persetujuan-siswa', [\App\Http\Controllers\Petugas\StudentApprovalController::class, 'index'])
        ->name('petugas.persetujuan-siswa');
    Route::put('/petugas/persetujuan-siswa/{id}/approve', [\App\Http\Controllers\Petugas\StudentApprovalController::class, 'approve'])
        ->name('petugas.persetujuan-siswa.approve');
    Route::put('/petugas/persetujuan-siswa/{id}/reject', [\App\Http\Controllers\Petugas\StudentApprovalController::class, 'reject'])
        ->name('petugas.persetujuan-siswa.reject');
    Route::delete('/petugas/persetujuan-siswa/{id}', [\App\Http\Controllers\Petugas\StudentApprovalController::class, 'destroy'])
        ->name('petugas.persetujuan-siswa.destroy');

    // Persetujuan Peminjaman Alat
    Route::get('/petugas/persetujuan', [ApprovalController::class, 'index'])->name('petugas.persetujuan');
    Route::put('/petugas/persetujuan/{id}', [ApprovalController::class, 'updateStatus'])->name('petugas.persetujuan.update');
    Route::put('/petugas/perpanjangan/{id}', [ApprovalController::class, 'updatePerpanjangan'])
        ->name('petugas.perpanjangan.update');
    Route::get('/petugas/laporan', [LaporanController::class, 'index'])->name('petugas.laporan');
    Route::get('/petugas/laporan/kondisi/export', [LaporanController::class, 'exportKondisi'])
        ->name('petugas.laporan.kondisi.export');

    // --- RUTE PROFIL PETUGAS ---
    Route::get('/petugas/profil', [ProfilController::class, 'petugas'])->name('petugas.profil');
    Route::put('/petugas/profil', [ProfilController::class, 'update'])->name('petugas.profil.update');
    Route::post('/petugas/profil/foto', [ProfilController::class, 'updateFoto'])->name('petugas.profil.foto');
    Route::delete('/petugas/profil/foto', [ProfilController::class, 'hapusFoto'])->name('petugas.profil.foto.hapus');
});

use App\Http\Controllers\Petugas\PengembalianController;

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/pengembalian', [PengembalianController::class, 'index'])
        ->name('petugas.pengembalian');
    Route::post('/petugas/pengembalian/{id}/konfirmasi', [PengembalianController::class, 'konfirmasi'])
        ->name('petugas.pengembalian.konfirmasi');
});

// ==========================================
// RUTE PROSES LOGIN & LOGOUT
// ==========================================
Route::post('/login/siswa', [AuthController::class, 'loginSiswa'])->name('login.siswa.proses');
Route::post('/login/petugas', [AuthController::class, 'loginPetugas'])->name('login.petugas.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');