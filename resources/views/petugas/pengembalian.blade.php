<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Inventaris - SIMPATI</title>
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
        


        /* Area Utama */
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

        /* Title & Badge Header */
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
        .badge-status-group {
            display: flex;
            gap: 8px;
        }
        .pill-count-orange {
            background-color: #ffedd5;
            color: #ea580c;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }
        .pill-count-red {
            background-color: #fef2f2;
            color: #ef4444;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        /* Tab Switcher Bar */
        .tab-switcher {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 6px;
            display: flex;
            gap: 6px;
            margin-bottom: 24px;
        }
        .tab-btn {
            flex: 1;
            text-align: center;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 12px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }
        .tab-btn.active {
            background-color: #00897b;
            color: #fff;
        }

        /* Main Content Layout Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* Left Queue Card */
        .queue-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .queue-header {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 14px;
        }
        .search-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 12px;
        }

        /* Queue List Items */
        .queue-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.2s;
            background: #fff;
        }
        .queue-item.active {
            border-color: #10b981;
            background-color: #e6f4ea;
        }
        .queue-item:hover:not(.active) {
            background-color: #f8fafc;
        }
        .queue-user-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }
        .queue-user-name {
            font-size: 13px;
            font-weight: 700;
            color: #071b26;
        }
        .queue-date-danger {
            font-size: 10px;
            font-weight: 700;
            color: #ef4444;
        }
        .queue-date-muted {
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
        }
        .queue-item-desc {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 8px;
        }

        /* Badge Code */
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
        .badge-code .cat.osis { color: #0284c7; }
        .badge-code .cat.rohis { color: #059669; }

        /* Right Detail Card */
        .detail-panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .detail-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }
        .req-id {
            font-size: 11px;
            font-weight: bold;
            color: #00897b;
            letter-spacing: 0.5px;
        }
        .status-pill-red {
            background-color: #fef2f2;
            color: #ef4444;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
        }
        .detail-title {
            font-size: 18px;
            font-weight: 800;
            color: #071b26;
            margin-bottom: 20px;
        }

        /* Profile & Item Summary Grid */
        .summary-box-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }
        .summary-card-inner {
            background-color: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 16px;
        }
        .inner-label {
            font-size: 10px;
            color: #94a3b8;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .borrower-name {
            font-size: 14px;
            font-weight: 800;
            color: #071b26;
        }
        .borrower-sub {
            font-size: 11px;
            color: #64748b;
            margin-top: 2px;
        }
        .borrower-stat {
            font-size: 10px;
            color: #ef4444;
            margin-top: 6px;
            font-weight: 600;
        }

        .item-name-large {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 6px;
            margin-bottom: 8px;
        }
        .stock-available-tag {
            font-size: 10px;
            color: #00897b;
            background-color: #e6f4ea;
            padding: 3px 8px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
        }

        /* Metadata Info Cards 3 Columns */
        .meta-info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        .meta-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px;
        }
        .meta-card .label { font-size: 10px; color: #94a3b8; margin-bottom: 4px; }
        .meta-card .val { font-size: 11px; font-weight: 700; color: #1e293b; }

        /* Notes & Penalty Box */
        .note-penalty-box {
            background-color: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 10px;
            padding: 14px;
            font-size: 11px;
            color: #92400e;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .note-penalty-box strong { display: block; font-size: 10px; text-transform: uppercase; margin-bottom: 4px; color: #d97706; }

        /* Condition Checklist */
        .verify-list {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }
        .verify-item {
            flex: 1;
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 11px;
            color: #166534;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Action Footer Buttons */
        .action-footer-grid {
            display: grid;
            grid-template-columns: 140px 140px 1fr;
            gap: 12px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            margin-bottom: 20px;
        }
        .btn-damage {
            background-color: #ef4444;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-note-damage {
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #334155;
            padding: 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-confirm-return {
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        /* Fine Calculator Bar Bottom */
        .fine-bar {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .fine-text {
            font-size: 11px;
            color: #64748b;
        }
        .btn-fine-calc {
            background-color: #fff;
            border: 1px solid #cbd5e1;
            color: #071b26;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }
        .tab-view {
            display: none;
        }
        .tab-view.active-view {
            display: block;
        }
        .queue-item:focus-visible,
        .tab-btn:focus-visible,
        button:focus-visible,
        input:focus-visible {
            outline: 3px solid #38bdf8;
            outline-offset: 2px;
        }
        .interaction-message {
            display: none;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            color: #065f46;
            font-size: 12px;
            margin-bottom: 16px;
            padding: 10px 14px;
        }
        .interaction-message.visible {
            display: block;
        }
        .returned-toolbar {
            align-items: center;
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .returned-toolbar h3 {
            color: #071b26;
            font-size: 18px;
            margin-bottom: 4px;
        }
        .returned-toolbar p {
            color: #718096;
            font-size: 12px;
        }
        .returned-count-pill,
        .returned-status-pill {
            background: #e6f4ea;
            border-radius: 20px;
            color: #047857;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 10px;
        }
        .returned-search-wrap {
            align-items: center;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            padding: 10px 12px;
        }
        .returned-search-wrap input {
            border: 0;
            flex: 1;
            font-size: 12px;
            outline: 0;
        }
        .returned-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }
        .returned-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
        }
        .returned-card-top,
        .returned-dates {
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }
        .returned-card-user {
            color: #071b26;
            font-size: 13px;
            font-weight: 700;
        }
        .returned-card-class,
        .returned-date-box .lbl {
            color: #64748b;
            font-size: 10px;
            margin-top: 3px;
        }
        .returned-item-name {
            color: #1e293b;
            font-size: 13px;
            font-weight: 700;
            margin: 12px 0 8px;
        }
        .returned-dates {
            margin-top: 14px;
        }
        .returned-date-box .val {
            color: #334155;
            font-size: 11px;
            font-weight: 600;
            margin-top: 3px;
        }
        .returned-detail-status {
            background: #e6f4ea;
            color: #047857;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 20px;
        }
        .returned-fine {
            border-top: 1px solid #f1f5f9;
            color: #64748b;
            font-size: 11px;
            margin-top: 12px;
            padding-top: 10px;
        }
        .returned-fine.has-fine {
            color: #b45309;
            font-weight: 700;
        }
        .returned-service-confirm {
            background: #00897b;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            border: 0;
            cursor: pointer;
            margin-top: 12px;
            width: 100%;
        }
        .verify-item.is-damaged {
            background: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }
        .empty-state {
            color: #64748b;
            font-size: 12px;
            padding: 16px 4px;
            text-align: center;
        }
        @media (max-width: 900px) {
            aside {
                padding: 18px 12px;
                width: 210px;
            }
            main {
                padding: 24px 20px;
            }
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 600px) {
            body {
                display: block;
            }
            aside {
                width: 100%;
            }
            aside nav {
                display: flex;
                flex-wrap: wrap;
            }
            main {
                padding: 18px 12px;
            }
            .summary-box-grid,
            .meta-info-grid {
                grid-template-columns: 1fr;
            }
            .action-footer-grid {
                grid-template-columns: 1fr;
            }
            .verify-list,
            .fine-bar,
            .title-section {
                align-items: stretch;
                flex-direction: column;
            }
            .tab-switcher {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('petugas.partials.sidebar', ['active' => 'pengembalian'])


    <!-- Area Utama -->
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
                <h1>Pengembalian inventaris</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>Rizky Maulana</span>
            </div>
        </header>

        <div class="breadcrumb">Dashboard / <strong>Pengembalian inventaris</strong></div>

        <div class="title-section">
            <div>
                <h2>Pengembalian inventaris</h2>
                <p>Catat barang kembali, kondisi, dan denda keterlambatan.</p>
            </div>
            <div class="badge-status-group">
                <span class="pill-count-orange">• <span id="waiting-badge-count">0</span> menunggu</span>
                <span class="pill-count-red">• <span id="late-badge-count">0</span> terlambat</span>
            </div>
        </div>

        <!-- Tab Switcher -->
        <div class="tab-switcher">
            <a href="#view-belum" class="tab-btn {{ $activeTab === 'belum' ? 'active' : '' }}" data-tab="belum" aria-current="{{ $activeTab === 'belum' ? 'page' : 'false' }}">Belum dikembalikan - <span id="pending-count">0</span></a>
            <a href="#view-sudah" class="tab-btn {{ $activeTab === 'sudah' ? 'active' : '' }}" data-tab="sudah" aria-current="{{ $activeTab === 'sudah' ? 'page' : 'false' }}">Sudah dikembalikan - <span id="returned-count">0</span></a>
        </div>
        <div id="interaction-message" class="interaction-message" role="status" aria-live="polite"></div>
        <div id="view-belum" class="tab-view {{ $activeTab === 'belum' ? 'active-view' : '' }}">
        <!-- Main Content Grid -->
        <div class="content-grid">
            
            <!-- Antrean Pengembalian (Kiri) -->
            <div class="queue-card">
                <div class="queue-header">Antrean pengembalian</div>
                <div class="search-box">
                    <span>🔍</span>
                    <input id="queue-search" type="search" placeholder="Cari peminjam atau alat..." aria-label="Cari antrean pengembalian">
                </div>
                <div id="queue-list"></div>
            </div>

            <!-- Detail Pengembalian (Kanan) -->
            <div id="detail-panel" class="detail-panel">
                <div class="detail-top-bar">
                    <span id="detail-id" class="req-id"></span>
                    <span id="detail-status" class="status-pill-red"></span>
                </div>
                <div class="detail-title">Detail pengembalian</div>

                <!-- Profile & Item Summary Grid -->
                <div class="summary-box-grid">
                    <div class="summary-card-inner">
                        <div class="inner-label">Peminjam</div>
                        <div id="detail-borrower" class="borrower-name"></div>
                        <div id="detail-student" class="borrower-sub"></div>
                        <div id="detail-role" class="borrower-sub" style="font-weight: 600;"></div>
                        <div id="detail-stat" class="borrower-stat"></div>
                    </div>

                    <div class="summary-card-inner">
                        <div class="inner-label">Barang Dikembalikan</div>
                        <div class="badge-code">
                            <span id="detail-code"></span>
                            <span id="detail-category" class="cat"></span>
                        </div>
                        <div id="detail-item" class="item-name-large"></div>
                        <div class="stock-available-tag">• Menunggu pemeriksaan</div>
                    </div>
                </div>

                <!-- Metadata Grid -->
                <div class="meta-info-grid">
                    <div class="meta-card">
                        <div class="label">Tanggal Pinjam</div>
                        <div id="detail-borrow-date" class="val"></div>
                    </div>
                    <div class="meta-card">
                        <div class="label">Batas Kembali</div>
                        <div id="detail-due-date" class="val"></div>
                    </div>
                    <div class="meta-card">
                        <div class="label">Tanggal Kembali</div>
                        <div id="detail-return-date" class="val"></div>
                    </div>
                </div>

                <!-- Notes & Penalty Box -->
                <div class="note-penalty-box">
                    <strong>Catatan & Denda Keterlambatan</strong>
                    <span id="detail-note"></span>
                </div>

                <!-- Condition Checklist -->
                <div class="verify-list">
                    <div id="condition-physical" class="verify-item">
                        <span>✓</span> Kondisi fisik baik
                    </div>
                    <div id="condition-accessories" class="verify-item">
                        <span>✓</span> Aksesori lengkap
                    </div>
                    <div id="condition-cleanliness" class="verify-item">
                        <span>✓</span> Kebersihan baik
                    </div>
                </div>

                <!-- Action Footer Buttons -->
                <form method="POST" action="{{ route('petugas.pengembalian.konfirmasi', ['id' => '__ID__']) }}" id="return-form">
                    @csrf
                    <input type="hidden" name="kondisi_kembali" id="form-kondisi" value="baik">
                    <input type="hidden" name="catatan_kondisi" id="form-catatan" value="">
                    <div class="action-footer-grid">
                        <button type="button" class="btn-damage">✖ Tandai rusak</button>
                        <button type="button" class="btn-note-damage">Catat kerusakan</button>
                        <button type="submit" class="btn-confirm-return">✓ Konfirmasi pengembalian</button>
                    </div>
                </form>

                <div class="fine-bar">
                    <div class="fine-text" id="fine-text-el">
                        Data diambil langsung dari database peminjaman.
                    </div>
                </div>

            </div>

        </div>
        </div> <!-- /view-belum -->

        <!-- ============ VIEW: SUDAH DIKEMBALIKAN ============ -->
        <div id="view-sudah" class="tab-view {{ $activeTab === 'sudah' ? 'active-view' : '' }}">
            <div class="returned-toolbar">
                <div>
                    <h3>Riwayat pengembalian — <span id="returned-heading-count">0</span> barang</h3>
                    <p>Daftar peminjaman yang sudah dikembalikan.</p>
                </div>
                <span class="returned-count-pill">✓ Data tersimpan</span>
            </div>
            <div class="returned-search-wrap">
                <span class="icon">🔍</span>
                <input id="returned-search" type="search" placeholder="Cari nama peminjam, kode barang, atau kategori..." aria-label="Cari riwayat pengembalian">
            </div>
            <div id="returned-grid" class="returned-grid">
            </div>
        </div> <!-- /view-sudah -->

    </main>

<script>
(function(){
    var pendingReturns = @js($pendingReturns);
    var returnedRecords = @js($returnedRecords);
    var selectedId = pendingReturns.length ? pendingReturns[0].id : null;
    var dailyFine = 5000;
    var queueList = document.getElementById('queue-list');
    var returnedGrid = document.getElementById('returned-grid');
    var detailPanel = document.getElementById('detail-panel');
    var messageBox = document.getElementById('interaction-message');
    var queueSearch = document.getElementById('queue-search');
    var returnedSearch = document.getElementById('returned-search');

    function makeElement(tag, className, text) {
        var element = document.createElement(tag);
        if (className) element.className = className;
        if (text !== undefined) element.textContent = text;
        return element;
    }

    function showMessage(message) {
        messageBox.textContent = message;
        messageBox.classList.add('visible');
    }

    function money(amount) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
    }

    function categoryClass(categoryClassName) {
        return categoryClassName ? 'cat ' + categoryClassName : 'cat';
    }

    function getSelected() {
        return pendingReturns.find(function(item) {
            return item.id === selectedId;
        }) || null;
    }

    function renderCounts() {
        document.getElementById('pending-count').textContent = pendingReturns.length;
        document.getElementById('waiting-badge-count').textContent = pendingReturns.length;
        document.getElementById('late-badge-count').textContent = pendingReturns.filter(function(item) {
            return item.lateDays > 0;
        }).length;
        document.getElementById('returned-count').textContent = returnedRecords.length;
        document.getElementById('returned-heading-count').textContent = returnedRecords.length;
    }

    function renderQueue() {
        var query = queueSearch.value.trim().toLocaleLowerCase('id-ID');
        queueList.replaceChildren();

        var visibleItems = pendingReturns.filter(function(item) {
            return [item.name, item.item, item.code, item.category].join(' ').toLocaleLowerCase('id-ID').includes(query);
        });
        if (!visibleItems.length) {
            queueList.appendChild(makeElement('div', 'empty-state', pendingReturns.length ? 'Tidak ada antrean yang cocok.' : 'Tidak ada peminjaman yang menunggu pengembalian.'));
            return;
        }

        visibleItems.forEach(function(item) {
            var card = makeElement('div', 'queue-item' + (item.id === selectedId ? ' active' : ''));
            card.setAttribute('role', 'button');
            card.setAttribute('tabindex', '0');
            card.setAttribute('aria-pressed', item.id === selectedId ? 'true' : 'false');
            card.dataset.returnId = item.id;

            var top = makeElement('div', 'queue-user-top');
            top.appendChild(makeElement('span', 'queue-user-name', item.name));
            top.appendChild(makeElement('span', item.lateDays > 0 ? 'queue-date-danger' : 'queue-date-muted', '• ' + item.dueLabel));
            card.appendChild(top);
            card.appendChild(makeElement('div', 'queue-item-desc', item.item));

            var badge = makeElement('div', 'badge-code');
            badge.appendChild(makeElement('span', '', item.code));
            badge.appendChild(makeElement('span', categoryClass(item.categoryClass), item.category));
            card.appendChild(badge);
            queueList.appendChild(card);
        });
    }

    function updateDetail() {
        var item = getSelected();
        detailPanel.hidden = !item;
        if (!item) return;

        document.getElementById('detail-id').textContent = item.id;
        var status = document.getElementById('detail-status');
        status.textContent = '• ' + item.dueLabel;
        status.hidden = item.lateDays <= 0;
        document.getElementById('detail-borrower').textContent = item.name;
        document.getElementById('detail-student').textContent = item.className + ' • NIS ' + item.nis;
        document.getElementById('detail-role').textContent = item.role;
        document.getElementById('detail-stat').textContent = item.stat;
        document.getElementById('detail-code').textContent = item.code;
        var category = document.getElementById('detail-category');
        category.textContent = item.category;
        category.className = categoryClass(item.categoryClass);
        document.getElementById('detail-item').textContent = item.item;
        document.getElementById('detail-borrow-date').textContent = item.borrowDate;
        document.getElementById('detail-due-date').textContent = item.dueDate;
        document.getElementById('detail-return-date').textContent = item.returnDate;
        document.getElementById('form-kondisi').value = item.damaged ? 'rusak_ringan' : 'baik';
        document.getElementById('form-catatan').value = item.damageNote;

        var note = 'Barang diterima kembali. ';
        note += item.lateDays > 0
            ? 'Terlambat ' + item.lateDays + ' hari — denda ' + money(item.lateDays * dailyFine) + '. '
            : 'Tidak terlambat — tanpa denda. ';
        note += item.damageNote
            ? 'Catatan kerusakan: ' + item.damageNote + ' '
            : (item.damaged ? 'Barang ditandai rusak. ' : 'Kondisi barang belum ditandai rusak. ');
        note += 'Data pengembalian akan tersimpan ke database saat dikonfirmasi.';
        document.getElementById('detail-note').textContent = note;

        var physical = document.getElementById('condition-physical');
        physical.classList.toggle('is-damaged', item.damaged);
        physical.querySelector('span').textContent = item.damaged ? '✖' : '✓';
        physical.lastChild.textContent = item.damaged ? ' Kondisi fisik rusak' : ' Kondisi fisik baik';
        document.querySelector('.btn-damage').textContent = item.damaged ? '✓ Tandai kondisi baik' : '✖ Tandai rusak';
    }

    function renderReturned() {
        var query = returnedSearch.value.trim().toLocaleLowerCase('id-ID');
        returnedGrid.replaceChildren();

        var visibleItems = returnedRecords.filter(function(item) {
            return [item.name, item.nis, item.item, item.code, item.category].join(' ').toLocaleLowerCase('id-ID').includes(query);
        });
        if (!visibleItems.length) {
            returnedGrid.appendChild(makeElement(
                'div',
                'empty-state',
                returnedRecords.length ? 'Tidak ada riwayat yang cocok.' : 'Belum ada peminjaman yang dikembalikan.'
            ));
            return;
        }

        visibleItems.forEach(function(item) {
            var card = makeElement('div', 'returned-card');
            var top = makeElement('div', 'returned-card-top');
            var student = makeElement('div');
            student.appendChild(makeElement('div', 'returned-card-user', item.name));
            student.appendChild(makeElement('div', 'returned-card-class', item.className + ' • NIS ' + item.nis));
            top.appendChild(student);
            top.appendChild(makeElement('span', 'returned-status-pill', '✓ Dikembalikan'));
            card.appendChild(top);
            card.appendChild(makeElement('div', 'returned-item-name', item.item));

            var badge = makeElement('div', 'badge-code');
            badge.appendChild(makeElement('span', '', item.code));
            badge.appendChild(makeElement('span', categoryClass(item.categoryClass), item.category));
            card.appendChild(badge);

            var dates = makeElement('div', 'returned-dates');
            [['Pinjam', item.borrowDate], ['Kembali', item.returnDate]].forEach(function(date) {
                var dateBox = makeElement('div', 'returned-date-box');
                dateBox.appendChild(makeElement('div', 'lbl', date[0]));
                dateBox.appendChild(makeElement('div', 'val', date[1]));
                dates.appendChild(dateBox);
            });
            card.appendChild(dates);
            var fine = item.fine > 0 ? 'Denda keterlambatan: ' + money(item.fine) : 'Tanpa denda';
            card.appendChild(makeElement('div', 'returned-fine' + (item.fine > 0 ? ' has-fine' : ''), fine));
            returnedGrid.appendChild(card);
        });
    }

    function activateTab(name) {
        document.querySelectorAll('.tab-view').forEach(function(view) {
            view.classList.toggle('active-view', view.id === 'view-' + name);
        });
        document.querySelectorAll('.tab-switcher .tab-btn').forEach(function(tab) {
            var active = tab.dataset.tab === name;
            tab.classList.toggle('active', active);
            tab.setAttribute('aria-current', active ? 'page' : 'false');
        });
    }

    document.querySelectorAll('.tab-switcher .tab-btn').forEach(function(tab) {
        tab.addEventListener('click', function(event) {
            event.preventDefault();
            activateTab(tab.dataset.tab);
        });
    });

    queueList.addEventListener('click', function(event) {
        var card = event.target.closest('.queue-item');
        if (!card) return;
        selectedId = card.dataset.returnId;
        renderQueue();
        updateDetail();
    });
    queueList.addEventListener('keydown', function(event) {
        if ((event.key === 'Enter' || event.key === ' ') && event.target.matches('.queue-item')) {
            event.preventDefault();
            event.target.click();
        }
    });
    queueSearch.addEventListener('input', renderQueue);
    returnedSearch.addEventListener('input', renderReturned);

    document.querySelector('.btn-damage').addEventListener('click', function() {
        var item = getSelected();
        if (!item) return;
        item.damaged = !item.damaged;
        if (!item.damaged) item.damageNote = '';
        document.getElementById('form-kondisi').value = item.damaged ? 'rusak_ringan' : 'baik';
        document.getElementById('form-catatan').value = item.damageNote;
        updateDetail();
        showMessage(item.damaged ? 'Barang ditandai rusak.' : 'Kondisi barang ditandai baik.');
    });

    document.querySelector('.btn-note-damage').addEventListener('click', function() {
        var item = getSelected();
        if (!item) return;
        var note = window.prompt('Catat kerusakan barang:', item.damageNote);
        if (note === null) return;
        item.damageNote = note.trim();
        item.damaged = Boolean(item.damageNote);
        document.getElementById('form-kondisi').value = item.damaged ? 'rusak_ringan' : 'baik';
        document.getElementById('form-catatan').value = item.damageNote;
        updateDetail();
        showMessage(item.damageNote ? 'Catatan kerusakan disimpan.' : 'Catatan kerusakan dihapus.');
    });

    document.getElementById('return-form').addEventListener('submit', function(event) {
        var item = getSelected();
        if (!item) {
            event.preventDefault();
            return;
        }
        if (!window.confirm('Konfirmasi pengembalian atas nama ' + item.name + '?')) {
            event.preventDefault();
            return;
        }

        this.action = this.action.replace('__ID__', encodeURIComponent(item.id));
    });

    function renderAll() {
        renderCounts();
        renderQueue();
        renderReturned();
        updateDetail();
    }

    activateTab(@js($activeTab));
    renderAll();
})();
</script>
    

</body>
</html>