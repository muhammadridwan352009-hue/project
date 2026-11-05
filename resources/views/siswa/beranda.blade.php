<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Siswa - SIMPATI</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f4f6f8;
            color: #333;
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        aside {
            width: 260px;
            background-color: #071b26;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px;
        }
        .brand {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            background: #fff;
            color: #071b26;
            padding: 8px 12px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 30px;
        }
        .menu-label {
            font-size: 11px;
            color: #8b9bb4;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }
        nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #b0c4de;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 6px;
            transition: 0.2s;
        }
        nav a.active {
            background-color: #00897b;
            color: #fff;
            font-weight: 600;
        }
        nav a:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05);
            color: #fff;
        }
        .sidebar-footer {
            font-size: 11px;
            color: #7a8b9e;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 16px;
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 30px 40px;
            overflow-y: auto;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        header .title-sub {
            font-size: 11px;
            color: #718096;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        header h1 {
            font-size: 20px;
            color: #1a202c;
            font-weight: bold;
        }
        .user-badge {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 6px 14px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #2d3748;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .btn-logout {
            background: #fff;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #b91c1c;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 14px;
            transition: 0.2s;
        }
        .btn-logout:hover {
            background: #fef2f2;
        }
        .dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
        }
        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
        }

        /* Banner */
        .banner {
            background-color: #071b26;
            color: #fff;
            border-radius: 16px;
            padding: 28px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .banner h2 {
            font-size: 22px;
            margin-bottom: 6px;
        }
        .banner p {
            font-size: 13px;
            color: #a0aec0;
        }
        .btn-banner {
            background-color: #00897b;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
        }
        .btn-banner:hover {
            background-color: #00796b;
        }

        /* Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .stat-card .label {
            font-size: 12px;
            color: #718096;
            font-weight: 500;
        }
        .stat-card .number {
            font-size: 28px;
            font-weight: bold;
            color: #1a202c;
            margin: 4px 0;
        }
        .stat-card .desc {
            font-size: 11px;
            font-weight: 500;
        }
        .stat-card .desc.orange { color: #d97706; }
        .stat-card .desc.blue { color: #2563eb; }
        .stat-card .desc.gray { color: #4b5563; }
        .stat-icon {
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
        }
        .bg-green-light { background-color: #e6f4ea; color: #00897b; }
        .bg-orange-light { background-color: #fef3c7; color: #d97706; }
        .bg-blue-light { background-color: #eff6ff; color: #2563eb; }

        /* Content Layout (Grid 2 Kolom) */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }
        .card {
            background: #fff;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .card-title {
            font-size: 15px;
            font-weight: bold;
            color: #1a202c;
        }
        .card-subtitle {
            font-size: 12px;
            color: #718096;
        }
        .link-all {
            font-size: 12px;
            color: #00897b;
            text-decoration: none;
            font-weight: 600;
        }

        /* Item Pinjaman */
        .loan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px;
            border: 1px solid #f1f5f9;
            background-color: #f8fafc;
            border-radius: 12px;
            margin-bottom: 12px;
        }
        .loan-info {
            display: flex;
            gap: 14px;
            align-items: center;
        }
        .item-thumb {
            width: 50px;
            height: 40px;
            background: #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            color: #4a5568;
        }
        .badge-code {
            font-size: 9px;
            background: #071b26;
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: monospace;
        }
        .badge-code.orange { background: #d97706; }
        .item-name {
            font-size: 13px;
            font-weight: bold;
            color: #1a202c;
            margin: 2px 0;
        }
        .item-date {
            font-size: 11px;
            color: #718096;
        }
        .status-badge {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
        }
        .status-badge.yellow { background: #fef3c7; color: #b45309; }
        .status-badge.green { background: #d1fae5; color: #047857; }
        .status-badge.menunggu { background: #fef3c7; color: #92400e; }
        .status-badge.disetujui { background: #dbeafe; color: #1e40af; }
        .status-badge.dipinjam { background: #d1fae5; color: #047857; }
        .status-badge.dikembalikan { background: #f1f5f9; color: #475569; }
        .status-badge.ditolak { background: #fee2e2; color: #dc2626; }
        .empty-loans {
            padding: 28px 16px;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            color: #718096;
            font-size: 13px;
            text-align: center;
        }

        .alert-box {
            background-color: #e6f4ea;
            color: #00695c;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
        }

        /* Kategori Grid */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .category-box {
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            display: block;
            transition: 0.2s;
        }
        .category-box:hover {
            border-color: #00897b;
        }
        .category-box .icon { font-size: 16px; margin-bottom: 6px; display: block; }
        .category-box .cat-name { font-size: 12px; font-weight: bold; color: #1a202c; }
        .category-box .cat-count { font-size: 10px; color: #718096; }

        .notification-card {
            background-color: #fffbeb;
            border: 1px solid #fde68a;
            padding: 14px;
            border-radius: 12px;
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }
        .notification-card.approved {
            background-color: #ecfdf5;
            border-color: #a7f3d0;
        }
        .notification-card .notif-title {
            font-size: 12px;
            font-weight: bold;
            color: #92400e;
            margin-bottom: 2px;
        }
        .notification-card.approved .notif-title { color: #047857; }
        .notification-card .notif-desc {
            font-size: 11px;
            color: #b45309;
        }
        .notification-card.approved .notif-desc { color: #065f46; }
        
        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .banner { flex-direction: column; align-items: flex-start; gap: 14px; padding: 20px; }
            .banner h2 { font-size: 18px; }
            .stats-grid { grid-template-columns: 1fr; gap: 12px; }
            .content-grid { grid-template-columns: 1fr; gap: 16px; }
            .loan-item { flex-direction: column; align-items: flex-start; gap: 10px; }
            .loan-info { flex-wrap: wrap; }
        }
        @media (max-width: 420px) {
            .category-grid { grid-template-columns: 1fr; }
            .stat-card .number { font-size: 24px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('siswa.partials.sidebar', ['active' => 'beranda'])


    <!-- Konten Utama Kanan -->
    <main>
        <header>
            <div style="display: flex; align-items: center; gap: 12px;">
            <button type="button" class="header-sidebar-toggle-btn" onclick="toggleSidebar()" title="Sembunyikan / Tampilkan Sidebar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <div>
                <div class="title-sub">SISTEM INVENTARIS SEKOLAH</div>
                <h1>Beranda siswa</h1>
            </div>
            </div>
            <div class="header-actions">
                <div class="user-badge">
                    <span class="dot"></span>
                    <span>{{ $siswa->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Keluar</button>
                </form>
            </div>
        </header>

        <div class="breadcrumb">Beranda / Ringkasan</div>

        <!-- Banner Sambutan -->
        <div class="banner">
            <div>
                <h2>Selamat siang, {{ \Illuminate\Support\Str::before($siswa->name, ' ') }}! 👋</h2>
                <p>Lihat status dan riwayat alat yang sudah Anda ajukan untuk dipinjam.</p>
            </div>
           <a href="{{ route('siswa.peminjaman.index') }}" class="btn-banner">Lihat pinjaman</a>
        </div>

        @forelse($peminjamanDisetujui as $peminjaman)
            <div class="notification-card approved">
                <span style="font-size: 16px;">✅</span>
                <div>
                    <div class="notif-title">Peminjaman disetujui petugas</div>
                    <div class="notif-desc">
                        {{ $peminjaman->alat->nama_alat ?? 'Alat' }}
                        @if($peminjaman->status === 'dipinjam')
                            sudah disetujui dan sedang dipinjam.
                        @else
                            sudah disetujui. Silakan ambil sesuai jadwal peminjaman.
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="notification-card">
                <span style="font-size: 16px;">⏳</span>
                <div>
                    <div class="notif-title">Belum ada peminjaman disetujui</div>
                    <div class="notif-desc">Pemberitahuan akan muncul di sini setelah petugas menyetujui pengajuan Anda.</div>
                </div>
            </div>
        @endforelse

        <!-- Kartu Statistik -->
        <div class="stats-grid">
            <div class="stat-card">
                <div>
                    <div class="label">Peminjaman disetujui</div>
                    <div class="number">{{ $statusCounts->get('disetujui', 0) + $statusCounts->get('dipinjam', 0) }}</div>
                    <div class="desc orange">Disetujui atau sedang dipinjam</div>
                </div>
                <div class="stat-icon bg-green-light"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="label">Menunggu persetujuan</div>
                    <div class="number">{{ $statusCounts->get('menunggu', 0) }}</div>
                    <div class="desc blue">Menunggu ditinjau petugas</div>
                </div>
                <div class="stat-icon bg-orange-light"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="label">Riwayat selesai</div>
                    <div class="number">{{ $statusCounts->get('dikembalikan', 0) }}</div>
                    <div class="desc gray">Alat yang sudah dikembalikan</div>
                </div>
                <div class="stat-icon bg-blue-light"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><polyline points="9 15 11 17 15 13"></polyline></svg></div>
            </div>
        </div>

        <!-- Grid Bawah -->
        <div class="content-grid">
            <!-- Peminjaman Terbaru -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Peminjaman terbaru</div>
                        <div class="card-subtitle">Status pengajuan dan alat yang Anda pinjam</div>
                    </div>
                   <a href="{{ route('siswa.peminjaman.index') }}" class="link-all">Lihat semua</a>
                </div>

                @forelse($peminjamans as $peminjaman)
                    <div class="loan-item">
                        <div class="loan-info">
                            <div class="item-thumb">{{ strtoupper(substr($peminjaman->alat->kode_alat ?? 'ALAT', 0, 3)) }}</div>
                            <div>
                                <span class="badge-code">{{ $peminjaman->alat->kode_alat ?? '-' }}</span>
                                <div class="item-name">{{ $peminjaman->alat->nama_alat ?? 'Alat tidak ditemukan' }}</div>
                                <div class="item-date">
                                    {{ $peminjaman->tanggal_pinjam->format('d M Y') }} - {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                                    · {{ $peminjaman->lokasi_penggunaan }}
                                </div>
                            </div>
                        </div>
                        <span class="status-badge {{ $peminjaman->status }}">
                            @switch($peminjaman->status)
                                @case('menunggu') Menunggu @break
                                @case('disetujui') Disetujui @break
                                @case('dipinjam') Dipinjam @break
                                @case('dikembalikan') Dikembalikan @break
                                @case('ditolak') Ditolak @break
                                @default {{ ucfirst($peminjaman->status) }}
                            @endswitch
                        </span>
                    </div>
                @empty
                    <div class="empty-loans">
                        Anda belum mengajukan peminjaman alat.
                        <a href="{{ route('siswa.peminjaman.create') }}" class="link-all">Ajukan peminjaman</a>
                    </div>
                @endforelse

                <div class="alert-box">
                    <span>💡</span> 
                    <span>Periksa status pengajuan Anda secara berkala di halaman Peminjaman saya.</span>
                </div>
            </div>

            <!-- Kanan: Kategori & Notifikasi -->
            <div>
                <div class="card" style="margin-bottom: 20px;">
                    <div class="card-title" style="margin-bottom: 2px;">Jelajahi kategori</div>
                    <div class="card-subtitle" style="margin-bottom: 16px;">Inventaris per unit institusi</div>

                    <div class="category-grid">
                        <a href="#" class="category-box">
                            <span class="icon">💻</span>
                            <div class="cat-name">Ratus</div>
                            <div class="cat-count">84 unit</div>
                        </a>
                        <a href="#" class="category-box">
                            <span class="icon">📷</span>
                            <div class="cat-name">Audio</div>
                            <div class="cat-count">48 unit</div>
                        </a>
                        <a href="#" class="category-box">
                            <span class="icon">🖨️</span>
                            <div class="cat-name">DLL</div>
                            <div class="cat-count">32 unit</div>
                        </a>
                        <a href="#" class="category-box">
                            <span class="icon">🎬</span>
                            <div class="cat-name">Multimedia</div>
                            <div class="cat-count">41 unit</div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>
    

</body>
</html>