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
            background-color: #10b981;
            border-radius: 50%;
        }
        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 16px;
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
            font-size: 13px;
            color: #718096;
            margin-top: 2px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            transition: 0.2s;
        }
        .stat-card:hover {
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .stat-card .number {
            font-size: 28px;
            font-weight: 800;
            color: #071b26;
            margin-bottom: 4px;
        }
        .stat-card .label {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-card.active {
            background: #00897b;
            border-color: #00897b;
        }
        .stat-card.active .number,
        .stat-card.active .label {
            color: #fff;
        }

        /* Borrowing List */
        .borrowing-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .borrowing-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }
        .borrowing-info {
            flex: 1;
        }
        .borrowing-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
        }
        .badge-code {
            background: #f1f5f9;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            color: #071b26;
            font-family: monospace;
        }
        .badge-category {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 4px;
            letter-spacing: 0.5px;
        }
        .badge-category.multimedia { background: #ede9fe; color: #7c3aed; }
        .badge-category.rohis { background: #d1fae5; color: #059669; }
        .badge-category.band { background: #ffedd5; color: #ea580c; }
        .badge-category.osis { background: #dbeafe; color: #0284c7; }

        .borrowing-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .borrowing-date {
            font-size: 12px;
            color: #64748b;
        }
        .borrowing-date strong {
            color: #334155;
        }

        /* Status Badge */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-width: 120px;
            justify-content: center;
        }
        .status-badge.menunggu {
            background: #fef3c7;
            color: #92400e;
        }
        .status-badge.disetujui {
            background: #dbeafe;
            color: #1e40af;
        }
        .status-badge.dipinjam {
            background: #d1fae5;
            color: #047857;
        }
        .status-badge.dikembalikan {
            background: #f1f5f9;
            color: #475569;
        }
        .status-badge.ditolak {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Empty State */
        .empty-state {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 60px 40px;
            text-align: center;
        }
        .empty-icon {
            width: 80px;
            height: 80px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }
        .empty-state h3 {
            font-size: 18px;
            font-weight: 700;
            color: #071b26;
            margin-bottom: 8px;
        }
        .empty-state p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 24px;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
            border: none;
        }
        .btn-primary {
            background: #00897b;
            color: #fff;
        }
        .btn-primary:hover {
            background: #00796b;
        }

        /* Alert */
        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #047857;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .filter-tab {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s;
        }
        .filter-tab:hover {
            border-color: #00897b;
            color: #00897b;
        }
        .filter-tab.active {
            background: #00897b;
            color: #fff;
            border-color: #00897b;
        }
        /* Sidebar Collapse */
        .sidebar-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 10px;
            padding: 8px 10px;
            background: rgba(255,255,255,0.06);
            color: #b0c4de;
            border: 0;
            border-radius: 10px;
            font: inherit;
            font-size: 12px;
            cursor: pointer;
            transition: 0.2s;
        }
        .sidebar-toggle:hover { background: rgba(255,255,255,0.12); color: #fff; }
        .sidebar-toggle .chevron { transition: transform 0.25s; }
        aside.collapsed {
            width: 68px !important;
            padding: 24px 10px !important;
            align-items: center;
        }
        aside.collapsed .brand,
        aside.collapsed .menu-label,
        aside.collapsed .sidebar-footer,
        aside.collapsed nav a span,
        aside.collapsed .logout-button span,
        aside.collapsed .sidebar-toggle .toggle-label { display: none; }
        aside.collapsed .brand-mini {
            display: inline-block;
            background: #fff;
            color: #071b26;
            font-weight: 800;
            font-size: 13px;
            padding: 6px 7px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        aside.collapsed nav a { justify-content: center; padding: 12px 8px; }
        aside.collapsed .sidebar-toggle { width: auto; }
        aside.collapsed .sidebar-toggle .chevron { transform: rotate(180deg); }

        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            main { padding: 18px 14px; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
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

        <div class="breadcrumb">
            <a href="/siswa/beranda" style="color:#00897b; text-decoration:none;">Beranda</a> / 
            <span style="color:#718096;">Peminjaman saya</span>
        </div>

        <div class="title-section">
            <div>
                <h2>Status & riwayat peminjaman</h2>
                <p>Lacak proses dari pengajuan hingga pengembalian.</p>
            </div>
            <a href="{{ route('siswa.peminjaman.create') }}" class="btn btn-primary">
                + Ajukan peminjaman
            </a>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
        <div class="alert-success">
            <span>✅</span>
            {{ session('success') }}
        </div>
        @endif

        {{-- Stats Cards --}}
        @php
            $total = $peminjamans->count();
            $menunggu = $peminjamans->where('status', 'menunggu')->count();
            $disetujui = $peminjamans->where('status', 'disetujui')->count();
            $dipinjam = $peminjamans->where('status', 'dipinjam')->count();
            $dikembalikan = $peminjamans->where('status', 'dikembalikan')->count();
        @endphp

        <div class="stats-grid">
            <div class="stat-card active">
                <div class="number">{{ $total }}</div>
                <div class="label">Semua</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $menunggu }}</div>
                <div class="label">Menunggu</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $disetujui }}</div>
                <div class="label">Disetujui</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $dipinjam }}</div>
                <div class="label">Dipinjam</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $dikembalikan }}</div>
                <div class="label">Dikembalikan</div>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <div class="filter-tabs">
            <a href="#" class="filter-tab active">Semua {{ $total }}</a>
            <a href="#" class="filter-tab">Menunggu {{ $menunggu }}</a>
            <a href="#" class="filter-tab">Disetujui {{ $disetujui }}</a>
            <a href="#" class="filter-tab">Dipinjam {{ $dipinjam }}</a>
            <a href="#" class="filter-tab">Dikembalikan {{ $dikembalikan }}</a>
            <a href="#" class="filter-tab">Ditolak {{ $peminjamans->where('status', 'ditolak')->count() }}</a>
        </div>

        {{-- Daftar Peminjaman --}}
        @if($peminjamans->count() > 0)
            @foreach($peminjamans as $peminjaman)
            <div class="borrowing-card">
                <div class="borrowing-info">
                    <div class="borrowing-meta">
                        <span class="badge-code">{{ $peminjaman->alat->kode_alat ?? '-' }}</span>
                        <span class="badge-category {{ $peminjaman->kategori }}">
                            {{ strtoupper($peminjaman->kategori) }}
                        </span>
                    </div>
                    <div class="borrowing-title">
                        {{ $peminjaman->alat->nama_alat ?? 'Alat tidak ditemukan' }}
                    </div>
                    <div class="borrowing-date">
                        <strong>{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</strong> - 
                        {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                    </div>
                </div>
                <div>
                    <span class="status-badge {{ $peminjaman->status }}">
                        @if($peminjaman->status == 'menunggu')
                             Menunggu
                        @elseif($peminjaman->status == 'disetujui')
                            ✓ Disetujui
                        @elseif($peminjaman->status == 'dipinjam')
                            📦 Dipinjam
                        @elseif($peminjaman->status == 'dikembalikan')
                            ✅ Dikembalikan
                        @elseif($peminjaman->status == 'ditolak')
                            ✕ Ditolak
                        @endif
                    </span>
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h3>Belum ada peminjaman</h3>
                <p>Anda belum mengajukan peminjaman alat. Mulai pinjam alat untuk kegiatan ekskulmu!</p>
                <a href="{{ route('siswa.peminjaman.create') }}" class="btn btn-primary">
                    + Ajukan peminjaman pertama
                </a>
            </div>
        @endif
    </main>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            const label = sidebar.querySelector('.toggle-label');
            if (label) label.textContent = sidebar.classList.contains('collapsed') ? '' : 'Ciutkan';
        }
    </script>

</body>
</html>