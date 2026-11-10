<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - SIMPATI</title>
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

        /* Sidebar Kiri - Ruang Petugas */
        aside {
            width: 260px;
            background-color: #071b26;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px;
            flex-shrink: 0;
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
        .logout-form { margin-top: 12px; }
        .logout-button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 10px;
            color: #cfe3ea;
            background: none;
            border: 0;
            font: inherit;
            font-size: 13px;
            cursor: pointer;
        }
        .logout-button:hover { color: #fff; }

        

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
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        header .title-sub {
            font-size: 11px;
            color: #00897b;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        header h1 {
            font-size: 22px;
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
        }
        .dot {
            width: 8px;
            height: 8px;
            background-color: #f59e0b;
            border-radius: 50%;
        }
        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
        }

        /* Title Section */
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .title-section h2 {
            font-size: 22px;
            color: #071b26;
            font-weight: 800;
        }
        .title-section p {
            font-size: 12px;
            color: #718096;
            margin-top: 2px;
        }
        .btn-add {
            background-color: #00897b;
            color: #fff;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }
        .btn-add:hover { background-color: #00796b; }

        /* Stats Cards Bar */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            text-decoration: none;
            color: inherit;
            transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
        }
        a.stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.06);
            border-color: #cbd5e1;
        }
        .stat-icon.info { background-color: #f0fdf4; border-color: #bbf7d0; color: #16a34a; }
        .stat-icon.primary { background-color: #ecfeff; border-color: #a5f3fc; color: #0891b2; }
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
        }
        .stat-icon.warning { background-color: #fffbeb; border-color: #fef3c7; color: #d97706; }
        .stat-icon.danger { background-color: #fef2f2; border-color: #fee2e2; color: #ef4444; }
        .stat-label {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .stat-value {
            font-size: 22px;
            font-weight: 800;
            color: #071b26;
            line-height: 1;
        }
        .stat-sub {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* Layout Grid Konten */
        .dashboard-content-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 24px;
            align-items: start;
        }

        /* Table Card (Permintaan Terbaru) */
        .card-panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .panel-header h3 {
            font-size: 15px;
            font-weight: bold;
            color: #1e293b;
        }
        .panel-header a {
            font-size: 12px;
            color: #00897b;
            text-decoration: none;
            font-weight: 600;
        }

        /* Request Item List */
        .request-item {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .request-item:last-child { margin-bottom: 0; }

        .req-user {
            width: 140px;
        }
        .req-user strong { font-size: 13px; color: #1e293b; display: block; }
        .req-user span { font-size: 10px; color: #94a3b8; }

        .req-item-info {
            flex: 1;
            padding: 0 16px;
        }
        .req-item-title { font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px; }
        .badge-code {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 9px;
            font-weight: bold;
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 2px 6px;
            border-radius: 4px;
            color: #334155;
        }
        .badge-code .cat { color: #7c3aed; }
        .badge-code .cat.band { color: #ea580c; }
        .badge-code .cat.osis { color: #0284c7; }
        .badge-code .cat.rohis { color: #059669; }

        .req-date { font-size: 11px; color: #94a3b8; width: 90px; text-align: center; }

        .req-status-action {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .status-pill-orange {
            background: #ffedd5;
            color: #ea580c;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
        }
        .status-pill {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }
        .status-pill.menunggu { background: #fef3c7; color: #92400e; }
        .status-pill.disetujui { background: #dbeafe; color: #1e40af; }
        .status-pill.dipinjam { background: #d1fae5; color: #047857; }
        .status-pill.dikembalikan { background: #f1f5f9; color: #475569; }
        .status-pill.ditolak { background: #fee2e2; color: #dc2626; }
        .btn-review {
            background: #fff;
            border: 1px solid #cbd5e1;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn-review:hover { background: #f1f5f9; }

        /* Panel Kanan (Pemakaian Kategori & Alert Terlambat) */
        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Progress Bars Card */
        .category-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
        }
        .category-card h4 {
            font-size: 13px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 16px;
        }
        .cat-progress-item {
            margin-bottom: 12px;
        }
        .cat-progress-item:last-child { margin-bottom: 0; }
        .cat-info {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #64748b;
            margin-bottom: 4px;
        }
        .progress-bar-bg {
            width: 100%;
            height: 6px;
            background-color: #f1f5f9;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            border-radius: 10px;
        }

        /* Catalog Grid ala Siswa */
        .catalog-section { margin-top: 4px; }
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .item-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-img-wrapper {
            position: relative;
            width: 100%;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .card-img-wrapper img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            padding: 8px;
            object-fit: contain;
            z-index: 1;
        }
        .placeholder-text {
            position: relative;
            font-size: 14px;
            font-weight: bold;
            color: #64748b;
            z-index: 0;
        }
        .badge-code {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .badge-code .cat {
            color: #7c3aed;
            font-size: 9px;
            text-transform: uppercase;
        }
        .badge-code .cat.band { color: #ea580c; }
        .badge-code .cat.osis { color: #0284c7; }
        .badge-code .cat.rohis { color: #059669; }

        .card-body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .item-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .item-loc {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 12px;
        }
        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }
        .stock-badge {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
        }
        .stock-badge.ready { background: #d1fae5; color: #047857; }
        .stock-badge.busy { background: #fee2e2; color: #dc2626; }
        .condition {
            font-size: 10px;
            color: #94a3b8;
        }

        .btn-action {
            width: 100%;
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: 0.2s;
        }
        .btn-action:hover { background-color: #00796b; }
        .btn-action.disabled {
            background-color: #fff;
            color: #334155;
            border: 1px solid #cbd5e1;
        }

        /* Danger Alert Box Terlambat */
        .late-alert-card {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 16px;
            padding: 20px;
        }
        .late-title {
            font-size: 13px;
            font-weight: bold;
            color: #dc2626;
            margin-bottom: 10px;
        }
        .late-list {
            list-style: none;
            font-size: 11px;
            color: #7f1d1d;
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .btn-action-danger {
            width: 100%;
            background-color: #ef4444;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-action-danger:hover { background-color: #dc2626; }
        @media (max-width: 900px) {
            .dashboard-content-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .catalog-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .catalog-grid { grid-template-columns: 1fr; }
            aside { width: 190px; padding: 16px; }
            main { padding: 20px 16px; }
            .request-item { align-items: flex-start; flex-wrap: wrap; gap: 10px; }
            .req-user { width: auto; min-width: 120px; }
            .req-item-info { min-width: 160px; padding: 0; }
            .req-date { width: auto; text-align: left; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri (Ruang Petugas) -->
    @include('petugas.partials.sidebar', ['active' => 'dashboard'])


    <!-- Main Area -->
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
                <h1>Dashboard petugas</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">Dashboard / <strong>Ringkasan operasional</strong></div>

        <div class="title-section">
            <div>
                <h2>Ringkasan hari ini</h2>
                <p>{{ now()->translatedFormat('l, d F Y') }} • Diperbarui {{ now()->format('H.i') }} WIB</p>
            </div>
            <a href="{{ route('petugas.inventaris.create') }}" class="btn-add">
                <span>+</span> Tambah inventaris
            </a>
        </div>

        <!-- Metric Stat Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </div>
                <div>
                    <div class="stat-label">Total stok alat</div>
                    <div class="stat-value">{{ $totalStok }}</div>
                    <div class="stat-sub">Unit tersedia di inventaris</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                </div>
                <div>
                    <div class="stat-label">Sedang dipinjam</div>
                    <div class="stat-value">{{ $dipinjamCount }}</div>
                    <div class="stat-sub" style="color:#10b981;">Sedang digunakan siswa</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon warning">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div>
                    <div class="stat-label">Peminjaman</div>
                    <div class="stat-value">{{ $menungguCount }}</div>
                    <div class="stat-sub" style="color:#d97706;">Pengajuan alat menunggu</div>
                </div>
            </div>

            <a href="{{ route('petugas.persetujuan-siswa') }}" class="stat-card" title="Buka Halaman Persetujuan Akun Siswa">
                <div class="stat-icon primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <polyline points="16 11 18 13 22 9"></polyline>
                    </svg>
                </div>
                <div>
                    <div class="stat-label">Persetujuan Akun</div>
                    <div class="stat-value" style="color: {{ ($pendingSiswaCount ?? 0) > 0 ? '#0284c7' : '#071b26' }};">{{ $pendingSiswaCount ?? 0 }}</div>
                    <div class="stat-sub" style="color: {{ ($pendingSiswaCount ?? 0) > 0 ? '#0284c7' : '#94a3b8' }};">Akun siswa pending →</div>
                </div>
            </a>

            <div class="stat-card">
                <div class="stat-icon danger">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <div>
                    <div class="stat-label">Terlambat</div>
                    <div class="stat-value">{{ $terlambatCount }}</div>
                    <div class="stat-sub" style="color:#ef4444;">Perlu tindak lanjut</div>
                </div>
            </div>
        </div>

        <!-- Katalog Alat (gaya katalog siswa) -->
        <div class="catalog-section">
            <div class="title-section">
                <div>
                    <h2>Katalog alat</h2>
                    <p>Pratinjau inventaris yang dilihat siswa di katalog.</p>
                </div>
                <a href="/petugas/inventaris" class="btn-add">Lihat semua</a>
            </div>

            <div class="catalog-grid">
                @foreach($alats as $alat)
                    @php
                        $gambarAlat = null;
                        $pemetaanGambar = [
                            'printer' => 'printer.jpg',
                            'projector' => 'proyektor.jpg',
                            'proyektor' => 'proyektor.jpg',
                            'sajadah' => 'sajadah.jpg',
                            'sony' => 'sony1.jpg',
                            'tenda' => 'tenda.jpg',
                        ];
                        $namaAlat = strtolower($alat->nama_alat);

                        foreach ($pemetaanGambar as $kataKunci => $namaFile) {
                            if (str_contains($namaAlat, $kataKunci) && file_exists(public_path($namaFile))) {
                                $gambarAlat = $namaFile;
                                break;
                            }
                        }
                    @endphp

                    <div class="item-card">
                        <div class="card-img-wrapper">
                            @if($alat->foto && file_exists(storage_path('app/public/' . $alat->foto)))
                                <img src="{{ asset('storage/' . $alat->foto) }}" alt="Foto {{ $alat->nama_alat }}" loading="lazy">
                            @elseif($gambarAlat)
                                <img src="{{ asset($gambarAlat) }}" alt="Foto {{ $alat->nama_alat }}" loading="lazy">
                            @else
                                <div class="placeholder-text">{{ $alat->nama_alat }}</div>
                            @endif
                            <div class="badge-code">
                                <span>{{ $alat->kode_alat ?? '-' }}</span>
                                <span class="cat {{ strtolower($alat->kategori ?? '') }}">{{ strtoupper($alat->kategori ?? '-') }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="item-title">{{ $alat->nama_alat }}</div>
                                <div class="item-loc">📍 {{ $alat->lokasi ?? 'Belum ada lokasi' }}</div>
                            </div>
                            <div>
                                <div class="card-meta">
                                    <span class="stock-badge {{ $alat->stok > 0 ? 'ready' : 'busy' }}">
                                        • {{ $alat->stok }} tersedia
                                    </span>
                                    <span class="condition">{{ $alat->kondisi ?? 'Kondisi baik' }}</span>
                                </div>
                                <a href="/petugas/inventaris" class="btn-action">Kelola inventaris</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Dashboard Content Grid -->
        <div class="dashboard-content-grid">
            
            <!-- Permintaan Terbaru -->
            <div class="card-panel">
                <div class="panel-header">
                    <h3>Peminjaman terbaru dari siswa</h3>
                </div>

                @forelse($peminjamans as $peminjaman)
                    <div class="request-item">
                        <div class="req-user">
                            <strong>{{ $peminjaman->user->name ?? 'Siswa' }}</strong>
                            <span>Siswa • {{ ucfirst($peminjaman->kategori) }}</span>
                        </div>
                        <div class="req-item-info">
                            <div class="req-item-title">{{ $peminjaman->alat->nama_alat ?? 'Alat tidak ditemukan' }}</div>
                            <div class="badge-code">
                                <span>{{ $peminjaman->alat->kode_alat ?? '-' }}</span>
                                <span class="cat {{ $peminjaman->kategori }}">{{ strtoupper($peminjaman->kategori) }}</span>
                            </div>
                        </div>
                        <div class="req-date">
                            {{ $peminjaman->tanggal_pinjam->format('d M Y') }}<br>
                            s.d. {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                        </div>
                        <div class="req-status-action">
                            <span class="status-pill {{ $peminjaman->status }}">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="request-item">
                        <div class="req-item-title">Belum ada pengajuan peminjaman dari siswa.</div>
                    </div>
                @endforelse
            </div>

            <!-- Panel Kanan -->
            <div class="right-column">
                
                <!-- Pemakaian Kategori Bar -->
                <div class="category-card">
                    <h4>Pemakaian kategori</h4>
                    
                    @php
                        $maxCategoryCount = max(1, (int) $categoryCounts->max());
                    @endphp
                    @foreach(['multimedia' => 'Multimedia', 'band' => 'Band', 'osis' => 'OSIS', 'rohis' => 'Rohis'] as $category => $label)
                        @php
                            $count = (int) $categoryCounts->get($category, 0);
                            $width = (int) round(($count / $maxCategoryCount) * 100);
                            $color = ['multimedia' => '#8b5cf6', 'band' => '#f97316', 'osis' => '#0284c7', 'rohis' => '#10b981'][$category];
                        @endphp
                        <div class="cat-progress-item">
                            <div class="cat-info">
                                <span>{{ $label }}</span>
                                <strong>{{ $count }} peminjaman</strong>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: {{ $width }}%; background-color: {{ $color }};"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Warning Box Terlambat -->
                <div class="late-alert-card">
                    <div class="late-title">{{ $terlambatCount }} pengembalian terlambat</div>
                    <ul class="late-list">
                        @forelse($latePeminjamans as $latePeminjaman)
                            <li>
                                • {{ $latePeminjaman->user->name ?? 'Siswa' }}
                                • {{ $latePeminjaman->alat->nama_alat ?? 'Alat' }}
                                • {{ $latePeminjaman->tanggal_kembali->diffInDays(today()) }} hari
                            </li>
                        @empty
                            <li>Tidak ada peminjaman terlambat.</li>
                        @endforelse
                    </ul>
                    <a href="{{ route('petugas.pengembalian') }}" class="btn-action-danger" style="display:block; text-align:center; text-decoration:none;">Tindak lanjut</a>
                </div>

            </div>

        </div>
    </main>

    

</body>
</html>