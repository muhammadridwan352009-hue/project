<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Peminjaman;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bagikan variabel jumlah pending ke sidebar petugas
        View::composer('petugas.partials.sidebar', function ($view) {
            try {
                $pendingSiswaCount = User::where('role', 'siswa')
                    ->where('status_akun', 'pending')
                    ->count();

                $menungguCount = Peminjaman::where('status', 'menunggu')->count();

                $view->with('pendingSiswaCount', $pendingSiswaCount);
                $view->with('menungguCount', $menungguCount);
            } catch (\Throwable $e) {
                // Abaikan jika database belum siap saat migrasi dsb
            }
        });
    }
}
