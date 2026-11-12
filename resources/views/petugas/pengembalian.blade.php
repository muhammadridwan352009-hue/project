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
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        header .title-sub {
            font-size: 11px;
            color: #2563eb;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        header h1 {
            font-size: 24px;
            color: #071b26;
            margin-top: 4px;
        }
        .user-badge {
            background: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
        }
        .user-badge .dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
        }

        .breadcrumb {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 16px;
        }
        .breadcrumb strong { color: #1e293b; }

        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
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
            flex-wrap: wrap;
        }
        .pill-count-orange {
            background-color: #ffedd5;
            color: #ea580c;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #fed7aa;
        }
        .pill-count-blue {
            background-color: #dbeafe;
            color: #1d4ed8;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #bfdbfe;
        }
        .pill-count-green {
            background-color: #d1fae5;
            color: #047857;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #a7f3d0;
        }

        /* Tab Switcher */
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
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            cursor: pointer;
            border: none;
            background: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .tab-btn:hover {
            color: #2563eb;
            background-color: #f8fafc;
        }
        .tab-btn.active {
            background-color: #2563eb;
            color: #fff;
        }
        .tab-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            background: rgba(0,0,0,0.08);
        }
        .tab-btn.active .tab-badge {
            background: rgba(255,255,255,0.25);
            color: #fff;
        }

        .tab-view {
            display: none;
        }
        .tab-view.active-view {
            display: block;
        }

        /* Search & Filter Toolbar */
        .search-toolbar {
            display: flex;
            gap: 12px;
            margin-bottom: 18px;
        }
        .search-input-wrap {
            flex: 1;
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .search-input-wrap input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 13px;
            color: #1e293b;
        }

        /* Table Card Container */
        .table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            overflow: hidden;
            margin-bottom: 24px;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        table.simpati-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13px;
        }
        table.simpati-table thead {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        table.simpati-table th {
            padding: 14px 16px;
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        table.simpati-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: middle;
        }
        table.simpati-table tr:hover {
            background-color: #fbfcfe;
        }

        /* Badges */
        .badge-cat {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #475569;
            text-transform: uppercase;
        }
        .badge-cat.osis { background: #e0f2fe; color: #0284c7; }
        .badge-cat.rohis { background: #d1fae5; color: #059669; }
        .badge-cat.multimedia { background: #ede9fe; color: #7c3aed; }
        .badge-cat.band { background: #fee2e2; color: #dc2626; }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }
        .badge-status.menunggu_konfirmasi {
            background-color: #ffedd5;
            color: #c2410c;
            border: 1px solid #fed7aa;
        }
        .badge-status.dipinjam, .badge-status.disetujui {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }
        .badge-status.dikembalikan {
            background-color: #d1fae5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .badge-late-danger {
            display: inline-block;
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid #fca5a5;
            white-space: nowrap;
        }
        .badge-ontime-success {
            display: inline-block;
            background-color: #ecfdf5;
            color: #047857;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid #a7f3d0;
            white-space: nowrap;
        }

        /* Buttons */
        .btn-confirm-action {
            background-color: #2563eb;
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
            white-space: nowrap;
        }
        .btn-confirm-action:hover {
            background-color: #1d4ed8;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(7, 27, 38, 0.6);
            backdrop-filter: blur(2px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-container {
            background: #fff;
            width: 100%;
            max-width: 580px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            animation: modalFadeIn 0.2s ease-out;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(12px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-header {
            padding: 20px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .modal-header h3 {
            font-size: 17px;
            font-weight: 700;
            color: #071b26;
        }
        .modal-close-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #64748b;
            cursor: pointer;
            padding: 4px;
        }
        .modal-body {
            padding: 24px;
        }
        .modal-info-box {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 20px;
            font-size: 12.5px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .modal-info-box .info-label {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
        }
        .modal-info-box .info-val {
            color: #0f172a;
            font-weight: 700;
            margin-top: 2px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }
        .condition-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .condition-option-card {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
            user-select: none;
        }
        .condition-option-card input {
            display: none;
        }
        .condition-option-card:hover {
            border-color: #93c5fd;
        }
        .condition-option-card.selected-baik {
            border-color: #10b981;
            background-color: #ecfdf5;
            color: #065f46;
        }
        .condition-option-card.selected-rusak_ringan {
            border-color: #f59e0b;
            background-color: #fffbeb;
            color: #92400e;
        }
        .condition-option-card.selected-rusak_berat {
            border-color: #ef4444;
            background-color: #fef2f2;
            color: #991b1b;
        }
        .condition-option-title {
            font-size: 13px;
            font-weight: 700;
            display: block;
            margin-top: 4px;
        }
        .condition-option-desc {
            font-size: 10.5px;
            color: #64748b;
            margin-top: 4px;
            line-height: 1.3;
        }
        .condition-option-card.selected-baik .condition-option-desc,
        .condition-option-card.selected-rusak_ringan .condition-option-desc,
        .condition-option-card.selected-rusak_berat .condition-option-desc {
            color: inherit;
            opacity: 0.9;
        }
        textarea.form-textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 13px;
            outline: none;
            resize: vertical;
            min-height: 70px;
        }
        textarea.form-textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        .modal-notice {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 11.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .modal-notice.notice-warning {
            background-color: #fffbeb;
            border-color: #fef3c7;
            color: #92400e;
        }
        .modal-footer {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .btn-modal-cancel {
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #475569;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-modal-submit {
            background: #2563eb;
            border: none;
            color: #fff;
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-modal-submit:hover {
            background: #1d4ed8;
        }

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

        .empty-placeholder {
            text-align: center;
            padding: 45px 20px;
            color: #64748b;
        }
        .empty-placeholder .icon {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .empty-placeholder h4 {
            font-size: 15px;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .empty-placeholder p {
            font-size: 12px;
        }

        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            .tab-switcher { flex-direction: column; }
            .condition-options { grid-template-columns: 1fr; }
            .modal-info-box { grid-template-columns: 1fr; }
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
                    <div class="title-sub">SISTEM INVENTARIS SEKOLAH (SIMPATI)</div>
                    <h1>Pengembalian Alat</h1>
                </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">Dashboard / <strong>Pengembalian Alat</strong></div>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert-success">
                <span>✅</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="title-section">
            <div>
                <h2>Manajemen Pengembalian Alat</h2>
                <p>Periksa kondisi fisik alat, hitung otomatis keterlambatan, dan konfirmasi pengembalian.</p>
            </div>
            <div class="badge-status-group">
                <span class="pill-count-orange">⏳ {{ count($konfirmasiRecords) }} Menunggu Konfirmasi</span>
                <span class="pill-count-blue">📦 {{ count($belumRecords) }} Belum Dikembalikan</span>
                <span class="pill-count-green">✅ {{ count($sudahRecords) }} Riwayat Selesai</span>
            </div>
        </div>

        <!-- 3 TAB SWITCHER SESUAI KETENTUAN -->
        <div class="tab-switcher">
            <button type="button" class="tab-btn {{ $activeTab === 'belum' ? 'active' : '' }}" onclick="switchTab('belum')">
                <span>1. Belum Dikembalikan</span>
                <span class="tab-badge">{{ count($belumRecords) }}</span>
            </button>
            <button type="button" class="tab-btn {{ $activeTab === 'konfirmasi' ? 'active' : '' }}" onclick="switchTab('konfirmasi')">
                <span>2. Menunggu Konfirmasi</span>
                <span class="tab-badge">{{ count($konfirmasiRecords) }}</span>
            </button>
            <button type="button" class="tab-btn {{ $activeTab === 'sudah' ? 'active' : '' }}" onclick="switchTab('sudah')">
                <span>3. Riwayat Pengembalian</span>
                <span class="tab-badge">{{ count($sudahRecords) }}</span>
            </button>
        </div>

        <!-- ========================================== -->
        <!-- TAB 1: BELUM DIKEMBALIKAN -->
        <!-- ========================================== -->
        <div id="tab-content-belum" class="tab-view {{ $activeTab === 'belum' ? 'active-view' : '' }}">
            <div class="search-toolbar">
                <div class="search-input-wrap">
                    <span>🔍</span>
                    <input type="text" id="search-belum" placeholder="Cari nama siswa atau nama alat yang sedang dipinjam..." onkeyup="filterTable('belum')">
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="simpati-table" id="table-belum">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa & Kelas</th>
                                <th>Alat & Kategori</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Pengembalian</th>
                                <th>Keterlambatan</th>
                                <th>Status</th>
                                <th style="text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($belumRecords as $index => $row)
                                <tr class="item-row" data-search="{{ strtolower($row['name'] . ' ' . $row['item'] . ' ' . $row['code'] . ' ' . $row['className']) }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: #071b26;">{{ $row['name'] }}</div>
                                        <div style="font-size: 11px; color: #64748b;">{{ $row['className'] }} &bull; NIS: {{ $row['nis'] }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #1e293b;">{{ $row['item'] }}</div>
                                        <div style="display: flex; gap: 6px; margin-top: 4px;">
                                            <span style="font-family: monospace; font-size: 10px; background: #e2e8f0; padding: 2px 6px; border-radius: 4px;">{{ $row['code'] }}</span>
                                            <span class="badge-cat {{ strtolower($row['category']) }}">{{ $row['category'] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $row['borrowDate'] }}</td>
                                    <td style="font-weight: 600;">{{ $row['dueDate'] }}</td>
                                    <td>
                                        @if($row['lateDays'] > 0)
                                            <span class="badge-late-danger">⚠️ Terlambat {{ $row['lateDays'] }} hari</span>
                                        @else
                                            <span class="badge-ontime-success">✓ Belum jatuh tempo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-status dipinjam">📦 Sedang Dipinjam</span>
                                    </td>
                                    <td style="text-align: right;">
                                        <button type="button" class="btn-confirm-action" onclick='openConfirmModal(@json($row))'>
                                            🔍 Periksa & Kembalikan
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-placeholder">
                                            <div class="icon">📦</div>
                                            <h4>Tidak ada alat yang belum dikembalikan</h4>
                                            <p>Semua alat yang dipinjam telah dikembalikan atau belum ada peminjaman aktif.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 2: MENUNGGU KONFIRMASI -->
        <!-- ========================================== -->
        <div id="tab-content-konfirmasi" class="tab-view {{ $activeTab === 'konfirmasi' ? 'active-view' : '' }}">
            <div class="search-toolbar">
                <div class="search-input-wrap">
                    <span>🔍</span>
                    <input type="text" id="search-konfirmasi" placeholder="Cari nama siswa atau nama alat pengajuan..." onkeyup="filterTable('konfirmasi')">
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="simpati-table" id="table-konfirmasi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa & Kelas</th>
                                <th>Alat Diajukan</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Pengembalian</th>
                                <th>Keterlambatan</th>
                                <th>Status</th>
                                <th style="text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($konfirmasiRecords as $index => $row)
                                <tr class="item-row" data-search="{{ strtolower($row['name'] . ' ' . $row['item'] . ' ' . $row['code'] . ' ' . $row['className']) }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: #071b26;">{{ $row['name'] }}</div>
                                        <div style="font-size: 11px; color: #64748b;">{{ $row['className'] }} &bull; NIS: {{ $row['nis'] }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #1e293b;">{{ $row['item'] }}</div>
                                        <div style="display: flex; gap: 6px; margin-top: 4px;">
                                            <span style="font-family: monospace; font-size: 10px; background: #e2e8f0; padding: 2px 6px; border-radius: 4px;">{{ $row['code'] }}</span>
                                            <span class="badge-cat {{ strtolower($row['category']) }}">{{ $row['category'] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $row['borrowDate'] }}</td>
                                    <td style="font-weight: 600;">{{ $row['dueDate'] }}</td>
                                    <td>
                                        @if($row['lateDays'] > 0)
                                            <span class="badge-late-danger">⚠️ Terlambat {{ $row['lateDays'] }} hari</span>
                                        @else
                                            <span class="badge-ontime-success">✓ Tepat waktu (0 hari)</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-status menunggu_konfirmasi">⏳ Menunggu Konfirmasi</span>
                                    </td>
                                    <td style="text-align: right;">
                                        <button type="button" class="btn-confirm-action" onclick='openConfirmModal(@json($row))'>
                                            ✓ Konfirmasi Pengembalian
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-placeholder">
                                            <div class="icon">⏳</div>
                                            <h4>Tidak ada pengajuan menunggu konfirmasi</h4>
                                            <p>Saat siswa menekan "Ajukan Pengembalian", daftarnya akan otomatis muncul di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 3: RIWAYAT PENGEMBALIAN -->
        <!-- ========================================== -->
        <div id="tab-content-sudah" class="tab-view {{ $activeTab === 'sudah' ? 'active-view' : '' }}">
            <div class="search-toolbar">
                <div class="search-input-wrap">
                    <span>🔍</span>
                    <input type="text" id="search-sudah" placeholder="Cari riwayat berdasarkan nama siswa atau alat..." onkeyup="filterTable('sudah')">
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="simpati-table" id="table-sudah">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa & NIS</th>
                                <th>Alat & Kategori</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Tgl Pengembalian</th>
                                <th>Keterlambatan</th>
                                <th>Kondisi Diterima</th>
                                <th>Catatan Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sudahRecords as $index => $row)
                                <tr class="item-row" data-search="{{ strtolower($row['name'] . ' ' . $row['item'] . ' ' . $row['code'] . ' ' . $row['className'] . ' ' . $row['condition']) }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: #071b26;">{{ $row['name'] }}</div>
                                        <div style="font-size: 11px; color: #64748b;">{{ $row['className'] }} &bull; NIS: {{ $row['nis'] }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #1e293b;">{{ $row['item'] }}</div>
                                        <div style="display: flex; gap: 6px; margin-top: 4px;">
                                            <span style="font-family: monospace; font-size: 10px; background: #e2e8f0; padding: 2px 6px; border-radius: 4px;">{{ $row['code'] }}</span>
                                            <span class="badge-cat {{ strtolower($row['category']) }}">{{ $row['category'] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $row['borrowDate'] }}</td>
                                    <td>{{ $row['dueDate'] }}</td>
                                    <td style="font-weight: 700; color: #047857;">{{ $row['returnDate'] }}</td>
                                    <td>
                                        @if($row['lateDays'] > 0)
                                            <span class="badge-late-danger">Terlambat {{ $row['lateDays'] }} hari</span>
                                        @else
                                            <span class="badge-ontime-success">Tepat waktu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row['condition'] === 'baik')
                                            <span style="color: #047857; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                                <span>✓</span> Baik (Stok +1)
                                            </span>
                                        @elseif($row['condition'] === 'rusak_ringan')
                                            <span style="color: #d97706; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                                <span>⚠️</span> Rusak Ringan
                                            </span>
                                        @else
                                            <span style="color: #dc2626; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                                <span>✖</span> Rusak Berat
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="font-size: 12px; color: #475569;">
                                            {{ $row['damageNote'] ?: '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="empty-placeholder">
                                            <div class="icon">📋</div>
                                            <h4>Belum ada riwayat pengembalian</h4>
                                            <p>Data pengembalian yang telah dikonfirmasi akan tercatat di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- ========================================== -->
    <!-- MODAL PEMERIKSAAN & KONFIRMASI PENGEMBALIAN -->
    <!-- ========================================== -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Pemeriksaan & Konfirmasi Pengembalian</h3>
                <button type="button" class="modal-close-btn" onclick="closeConfirmModal()">&times;</button>
            </div>
            <form id="modalForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <!-- Ringkasan Peminjaman -->
                    <div class="modal-info-box">
                        <div>
                            <div class="info-label">Nama Siswa</div>
                            <div class="info-val" id="modalStudentName">-</div>
                        </div>
                        <div>
                            <div class="info-label">Kelas / NIS</div>
                            <div class="info-val" id="modalStudentClass">-</div>
                        </div>
                        <div>
                            <div class="info-label">Nama Alat & Kode</div>
                            <div class="info-val" id="modalItemName">-</div>
                        </div>
                        <div>
                            <div class="info-label">Keterlambatan</div>
                            <div class="info-val" id="modalLateDays">-</div>
                        </div>
                    </div>

                    <!-- Pilihan Kondisi Barang -->
                    <div class="form-group">
                        <label>Pilihan Kondisi Barang <span style="color: #ef4444;">*</span></label>
                        <div class="condition-options">
                            <label class="condition-option-card selected-baik" id="card-baik" onclick="selectCondition('baik')">
                                <input type="radio" name="kondisi_kembali" value="baik" checked>
                                <span style="font-size: 20px;">✅</span>
                                <span class="condition-option-title">Baik</span>
                                <span class="condition-option-desc">Layak pakai, stok bertambah otomatis</span>
                            </label>
                            <label class="condition-option-card" id="card-rusak_ringan" onclick="selectCondition('rusak_ringan')">
                                <input type="radio" name="kondisi_kembali" value="rusak_ringan">
                                <span style="font-size: 20px;">⚠️</span>
                                <span class="condition-option-title">Rusak Ringan</span>
                                <span class="condition-option-desc">Butuh perbaikan, stok tidak bertambah</span>
                            </label>
                            <label class="condition-option-card" id="card-rusak_berat" onclick="selectCondition('rusak_berat')">
                                <input type="radio" name="kondisi_kembali" value="rusak_berat">
                                <span style="font-size: 20px;">❌</span>
                                <span class="condition-option-title">Rusak Berat</span>
                                <span class="condition-option-desc">Tidak layak, stok tidak bertambah</span>
                            </label>
                        </div>
                    </div>

                    <!-- Catatan Pemeriksaan Barang -->
                    <div class="form-group">
                        <label for="modalCatatan">Catatan Pemeriksaan Barang</label>
                        <textarea class="form-textarea" name="catatan_kondisi" id="modalCatatan" placeholder="Tuliskan catatan kelengkapan, goresan, atau detail pemeriksaan lainnya (opsional)..."></textarea>
                    </div>

                    <!-- Notice Informasional -->
                    <div class="modal-notice" id="modalNoticeBox">
                        <span>ℹ️</span>
                        <span id="modalNoticeText">Barang dalam kondisi <strong>Baik</strong>: Stok barang akan otomatis bertambah +1 dan status menjadi Dikembalikan.</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeConfirmModal()">Batal</button>
                    <button type="submit" class="btn-modal-submit" id="btnSubmitModal">✓ Konfirmasi Pengembalian</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-view').forEach(view => view.classList.remove('active-view'));

            event?.currentTarget?.classList.add('active');
            const targetView = document.getElementById('tab-content-' + tabName);
            if (targetView) {
                targetView.classList.add('active-view');
            }
        }

        function filterTable(tabName) {
            const input = document.getElementById('search-' + tabName);
            const filter = input.value.toLowerCase().trim();
            const table = document.getElementById('table-' + tabName);
            const rows = table.querySelectorAll('tbody tr.item-row');

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search') || '';
                if (searchData.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function selectCondition(kondisi) {
            ['baik', 'rusak_ringan', 'rusak_berat'].forEach(k => {
                const card = document.getElementById('card-' + k);
                if (card) {
                    card.classList.remove('selected-baik', 'selected-rusak_ringan', 'selected-rusak_berat');
                }
            });

            const targetCard = document.getElementById('card-' + kondisi);
            if (targetCard) {
                targetCard.classList.add('selected-' + kondisi);
                const radio = targetCard.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
            }

            const noticeBox = document.getElementById('modalNoticeBox');
            const noticeText = document.getElementById('modalNoticeText');

            if (kondisi === 'baik') {
                noticeBox.className = 'modal-notice';
                noticeText.innerHTML = 'Barang dalam kondisi <strong>Baik</strong>: Stok alat akan otomatis bertambah +1 dan status menjadi Dikembalikan.';
            } else {
                noticeBox.className = 'modal-notice notice-warning';
                noticeText.innerHTML = 'Barang berstatus <strong>' + (kondisi === 'rusak_ringan' ? 'Rusak Ringan' : 'Rusak Berat') + '</strong>: Stok alat <strong>TIDAK AKAN</strong> bertambah secara otomatis sebelum dinyatakan layak digunakan.';
            }
        }

        function openConfirmModal(data) {
            const form = document.getElementById('modalForm');
            form.action = "{{ url('petugas/pengembalian') }}/" + data.id + "/konfirmasi";

            document.getElementById('modalStudentName').textContent = data.name;
            document.getElementById('modalStudentClass').textContent = data.className + ' (NIS: ' + data.nis + ')';
            document.getElementById('modalItemName').textContent = data.item + ' [' + data.code + ']';

            const lateText = data.lateDays > 0 ? (data.lateDays + ' hari terlambat') : 'Tepat waktu (0 hari)';
            document.getElementById('modalLateDays').textContent = lateText;
            document.getElementById('modalLateDays').style.color = data.lateDays > 0 ? '#ef4444' : '#10b981';

            document.getElementById('modalCatatan').value = data.damageNote || '';
            selectCondition(data.condition || 'baik');

            document.getElementById('confirmModal').classList.add('active');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.remove('active');
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeConfirmModal();
            }
        });
    </script>
</body>
</html>
