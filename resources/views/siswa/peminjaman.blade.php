<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya - SIMPATI</title>
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
            flex-shrink: 0;
            transition: transform 0.3s ease;
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
            width: 100%;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
            flex-wrap: wrap;
            gap: 12px;
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
            background-color: #10b981;
            border-radius: 50%;
        }
        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 16px;
        }

        /* Banner Section (Judul & Tombol Ajukan Peminjaman) */
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            gap: 16px;
            flex-wrap: wrap; /* Membuat tombol turun ke bawah jika layar sempit */
        }
        .title-section h2 {
            font-size: 22px;
            color: #071b26;
            font-weight: 800;
        }
        .title-section p {
            font-size: 13px;
            color: #718096;
            margin-top: 2px;
        }
        .btn-add {
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
            white-space: nowrap; /* Mencegah teks tombol terpotong */
        }
        .btn-add:hover {
            background-color: #00796b;
        }

        /* Tabs Status Filter */
        .status-tabs {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 10px;
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            overflow-x: auto; /* Bisa digeser horizontal di layar kecil */
            white-space: nowrap;
        }
        .tab-btn {
            background: transparent;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            text-align: center;
            transition: 0.2s;
            flex-shrink: 0;
        }
        .tab-btn.active {
            background-color: #071b26;
            color: #fff;
        }
        .tab-btn:hover:not(.active) {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        /* Layout Grid for Content & Sidebar Detail */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        /* Main List Section */
        .card-container {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .section-title {
            font-size: 16px;
            font-weight: 800;
            color: #071b26;
            margin-bottom: 16px;
        }
        .loan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 12px;
            transition: 0.2s;
            background: #fff;
            flex-wrap: wrap;
            gap: 10px;
        }
        .loan-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .loan-info-top {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .loan-code {
            font-size: 10px;
            font-weight: 700;
            color: #071b26;
            background: #f1f5f9;
            padding: 3px 8px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        .loan-cat {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            color: #7c3aed;
        }
        .loan-name {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .loan-date {
            font-size: 11px;
            color: #718096;
        }
        .loan-status-right {
            text-align: right;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .status-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
        }
        .status-badge.dipinjam { background: #ffedd5; color: #c2410c; }
        .status-badge.disetujui { background: #d1fae5; color: #047857; }
        .status-badge.menunggu { background: #fef3c7; color: #b45309; }
        .status-badge.dikembalikan { background: #e0f2fe; color: #0369a1; }
        
        .status-note {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 4px;
        }
        .arrow-icon {
            color: #cbd5e1;
            font-size: 14px;
        }

        /* Right Side: Timeline Panel */
        .timeline-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            height: fit-content;
        }
        .timeline-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
            border: 1px solid #e2e8f0;
        }
        .timeline-item.done {
            background: #d1fae5;
            color: #047857;
            border-color: #a7f3d0;
        }
        .timeline-item.pending {
            background: #f8fafc;
            color: #64748b;
        }
        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            margin-top: 16px;
        }
        .info-box-title {
            font-size: 12px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .info-box-desc {
            font-size: 11px;
            color: #64748b;
        }

        /* --- MEDIA QUERIES (Responsif untuk layar kecil / HP / Tablet) --- */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr; /* Mengubah grid jadi 1 kolom (menumpuk ke bawah) */
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column; /* Sidebar berpindah ke atas atau disembunyikan */
            }
            aside {
                width: 100%;
                flex-direction: row;
                align-items: center;
                padding: 16px;
                overflow-x: auto;
            }
            aside nav {
                display: flex;
                gap: 8px;
                margin-bottom: 0;
            }
            aside .brand, aside .sidebar-footer, aside .menu-label {
                display: none; /* Sembunyikan elemen tidak penting di mobile kecil */
            }
            main {
                padding: 20px 16px;
            }
            .title-section {
                flex-direction: column;
                align-items: stretch;
            }
            .btn-add {
                width: 100%;
                justify-content: center; /* Tombol jadi melebar penuh (full width) agar mudah ditekan di HP */
            }
        }
        
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('siswa.partials.sidebar', ['active' => 'peminjaman'])


    <!-- Konten Utama -->
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
                <h1>Peminjaman saya</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">Beranda / Peminjaman saya</div>

        <!-- Bagian Judul dan Tombol Ajukan Peminjaman yang Responsif -->
        <div class="title-section">
            <div>
                <h2>Status & riwayat peminjaman</h2>
                <p>Lacak proses dari pengajuan hingga pengembalian.</p>
            </div>
          <a href="{{ route('siswa.katalog') }}" class="btn-add">
    <span>+</span> Ajukan peminjaman
</a>
        </div>

        <!-- Filter Status Tabs (Bisa digeser horizontal jika di HP) -->
        <div class="status-tabs">
            <button class="tab-btn active">Semua 14</button>
            <button class="tab-btn">Menunggu 1</button>
            <button class="tab-btn">Disetujui 1</button>
            <button class="tab-btn">Dipinjam 1</button>
            <button class="tab-btn">Dikembalikan 11</button>
            <button class="tab-btn">Ditolak 0</button>
        </div>

        <!-- Grid Layout for List and Active Detail -->
        <div class="content-grid">
            
            <!-- Daftar Peminjaman -->
            <div class="card-container">
                <div class="section-title">Semua peminjaman</div>

                <div class="loan-item">
                    <div>
                        <div class="loan-info-top">
                            <span class="loan-code">MM-CAM-014</span>
                            <span class="loan-cat">MULTIMEDIA</span>
                        </div>
                        <div class="loan-name">Kamera Sony Alpha A6400</div>
                        <div class="loan-date">24-26 Sep 2026</div>
                    </div>
                    <div class="loan-status-right">
                        <div>
                            <span class="status-badge dipinjam">• Dipinjam</span>
                            <div class="status-note">Besok, 15:00</div>
                        </div>
                        <span class="arrow-icon">›</span>
                    </div>
                </div>

                <div class="loan-item">
                    <div>
                        <div class="loan-info-top">
                            <span class="loan-code">BND-MIC-082</span>
                            <span class="loan-cat" style="color: #ea580c;">BAND</span>
                        </div>
                        <div class="loan-name">Mikrofon Wireless Shure</div>
                        <div class="loan-date">25-28 Sep 2026</div>
                    </div>
                    <div class="loan-status-right">
                        <div>
                            <span class="status-badge disetujui">• Disetujui</span>
                            <div class="status-note">Ambil Jumat, 08:30</div>
                        </div>
                        <span class="arrow-icon">›</span>
                    </div>
                </div>

            </div>

            <!-- Panel Proses Terbaru -->
            <div class="timeline-card">
                <div class="section-title">Proses terbaru</div>
                <div style="margin-bottom: 14px;">
                    <span class="loan-code">MM-TRP-021</span>
                    <span class="loan-cat" style="font-size: 10px; margin-left: 4px;">MULTIMEDIA</span>
                </div>

                <div class="timeline-item done"><span>✓</span> Pengajuan dibuat</div>
                <div class="timeline-item pending"><span>○</span> Verifikasi petugas</div>
                <div class="timeline-item pending"><span>○</span> Persetujuan pembina</div>
                <div class="timeline-item pending"><span>○</span> Siap diambil</div>

                <div class="info-box">
                    <div class="info-box-title"><span style="color: #10b981;">✓</span> Tidak ada masalah aktif</div>
                    <div class="info-box-desc">Semua catatan Anda dalam kondisi baik.</div>
                </div>
            </div>

        </div>
    </main>
    

</body>
</html>