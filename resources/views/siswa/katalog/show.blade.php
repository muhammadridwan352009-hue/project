@extends('layouts.app') {{-- Sesuaikan dengan layout utama aplikasi Anda --}}

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-500 mb-4">
        <a href="{{ route('siswa.katalog') }}" class="hover:underline">Beranda</a> / 
        <a href="{{ route('siswa.katalog') }}" class="hover:underline">Katalog alat</a> / 
        <span class="text-gray-800 font-semibold">Detail Alat</span>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6 md:p-8">
        
        <!-- Header / Nama Alat & Kategori -->
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-gray-100 pb-6 mb-6">
            <div>
                <span class="inline-block px-3 py-1 text-xs font-semibold text-purple-700 bg-purple-50 rounded-md mb-2">
                    {{ $alat->kategori->nama ?? 'MULTIMEDIA' }}
                </span>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $alat->nama_alat ?? $alat->nama ?? 'Kamera Sony Alpha A6400' }}</h1>
                <p class="text-sm text-gray-500 mt-1">Kode Inventaris: {{ $alat->kode_inventaris ?? 'MM-CAM-014' }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-3 py-1.5 text-xs font-medium bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200">
                    Kondisi: {{ $alat->kondisi ?? 'Baik' }}
                </span>
            </div>
        </div>

        <!-- Grid Konten Detail -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri & Tengah: Deskripsi & Informasi -->
            <div class="md:col-span-2 space-y-6">
                <!-- Deskripsi Alat -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi alat</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        {{ $alat->deskripsi ?? 'Kamera digunakan untuk kegiatan fotografi, dokumentasi acara sekolah, dan praktik videografi siswa.' }}
                    </p>
                </div>

                <!-- Informasi Alat -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi penyimpanan</span>
                        <span class="text-sm font-semibold text-gray-800 mt-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $alat->lokasi ?? 'Ruang Multimedia' }}
                        </span>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Stok tersedia</span>
                        <span class="text-sm font-semibold text-emerald-600 mt-1 block">
                            {{ $alat->stok ?? '3' }} unit
                        </span>
                    </div>
                </div>

                <!-- Persyaratan Peminjaman -->
                <div class="bg-amber-50/50 border border-amber-200/60 p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-amber-900 mb-1">Persyaratan peminjaman</h4>
                    <p class="text-xs md:text-sm text-amber-800">
                        {{ $alat->persyaratan ?? 'Mengisi formulir peminjaman dan menunggu persetujuan petugas.' }}
                    </p>
                </div>
            </div>

            <!-- Kolom Kanan: Perlengkapan & Aksi -->
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 flex flex-col justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Perlengkapan yang tersedia</h3>
                    <ul class="space-y-2.5 text-sm text-gray-600">
                        @php
                            $perlengkapan = $alat->perlengkapan ?? ['Kamera', 'Baterai', 'Charger', 'Tali kamera'];
                            if(is_string($perlengkapan)) {
                                $perlengkapan = json_decode($perlengkapan, true) ?? explode(',', $perlengkapan);
                            }
                        @endphp
                        @foreach($perlengkapan as $item)
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>{{ trim($item) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-8 space-y-3">
                    <a href="{{ route('siswa.peminjaman.create', $alat->id) }}" 
                       class="w-full block text-center py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg text-sm transition shadow-sm">
                        Ajukan Peminjaman
                    </a>
                    <a href="{{ route('siswa.katalog') }}" 
                       class="w-full block text-center py-2.5 px-4 bg-white hover:bg-gray-100 text-gray-700 font-medium rounded-lg text-sm border border-gray-300 transition">
                        Kembali ke Katalog
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection