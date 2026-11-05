<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris - SIMPATI</title>
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
            border: 0;
            background: transparent;
            font-weight: 600;
            transition: 0.2s;
            cursor: pointer;
        }
        .tab-btn.active {
            background-color: #071b26;
            color: #fff;
        }
        .tab-btn:focus-visible,
        .queue-item:focus-visible,
        button:focus-visible,
        input:focus-visible {
            outline: 2px solid #00897b;
            outline-offset: 2px;
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
            display: block;
            width: 100%;
            text-align: left;
            font: inherit;
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
        .queue-date {
            font-size: 10px;
            font-weight: 700;
            color: #00897b;
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
        .status-pill-orange {
            background-color: #ffedd5;
            color: #ea580c;
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
            color: #10b981;
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
            color: #059669;
            background-color: #d1fae5;
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

        /* Notes Box */
        .note-alert-box {
            background-color: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 10px;
            padding: 14px;
            font-size: 11px;
            color: #92400e;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .note-alert-box strong { display: block; font-size: 10px; text-transform: uppercase; margin-bottom: 4px; color: #d97706; }

        /* Verification List */
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

        /* Action Footer Buttons - Khusus Laporan (Export) */
        .action-footer-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            margin-bottom: 20px;
        }
        .btn-reject {
            background-color: #ef4444;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-export {
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* Return Bar Bottom */
        .return-bar {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .return-text {
            font-size: 11px;
            color: #64748b;
        }
        .btn-return-confirm {
            background-color: #fff;
            border: 1px solid #cbd5e1;
            color: #071b26;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }
        button:disabled {
            cursor: not-allowed;
            opacity: 0.55;
        }
        .demo-notice {
            margin: -10px 0 18px;
            padding: 10px 14px;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            background: #eff6ff;
            color: #1e40af;
            font-size: 12px;
        }
        .empty-state {
            padding: 18px 10px;
            color: #64748b;
            font-size: 12px;
            text-align: center;
        }
        .status-message {
            margin: 0 0 16px;
            padding: 10px 14px;
            border-radius: 8px;
            background: #ecfdf5;
            color: #166534;
            font-size: 12px;
        }
        .condition-report-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            margin-bottom: 28px;
            overflow: hidden;
        }
        .condition-report-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
        }
        .condition-report-heading h2 { color: #071b26; font-size: 18px; }
        .condition-report-heading p { color: #64748b; font-size: 12px; margin-top: 4px; }
        .condition-report-summary {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
            padding: 16px 24px;
        }
        .condition-summary-card {
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }
        .condition-summary-card span { display: block; color: #64748b; font-size: 11px; }
        .condition-summary-card strong { display: block; color: #071b26; font-size: 22px; margin-top: 4px; }
        .condition-report-table-wrap { overflow-x: auto; }
        .condition-report-table { width: 100%; border-collapse: collapse; min-width: 900px; }
        .condition-report-table th,
        .condition-report-table td {
            padding: 12px 16px;
            border-top: 1px solid #e2e8f0;
            color: #334155;
            font-size: 12px;
            text-align: left;
            vertical-align: top;
        }
        .condition-report-table th { background: #f8fafc; color: #64748b; font-size: 10px; text-transform: uppercase; }
        .condition-report-table td.description { min-width: 220px; white-space: pre-wrap; }
        .condition-report-empty { padding: 28px; text-align: center; color: #64748b; font-size: 13px; }
        .btn-view-report {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #00897b;
            background: #e6f4f2;
            color: #00897b;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn-view-report:hover { background: #00897b; color: #fff; }
        .report-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(7, 27, 38, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 100;
        }
        .report-modal-backdrop.open { display: flex; }
        .report-modal {
            background: #fff;
            border-radius: 16px;
            max-width: 620px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }
        .report-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            background: #fff;
        }
        .report-modal-header h3 { color: #071b26; font-size: 16px; }
        .report-modal-close {
            border: none;
            background: #f1f5f9;
            color: #334155;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
        }
        .report-modal-close:hover { background: #e2e8f0; }
        .report-modal-body { padding: 20px 24px; }
        .report-modal-body dl { display: grid; grid-template-columns: 150px 1fr; gap: 10px 16px; margin: 0; }
        .report-modal-body dt { color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .report-modal-body dd { color: #1e293b; font-size: 13px; margin: 0; }
        .report-modal-body dd.description { white-space: pre-wrap; }
        @media (max-width: 680px) {
            .report-modal-body dl { grid-template-columns: 1fr; gap: 4px; }
            .report-modal-body dd { margin-bottom: 10px; }
        }
        .condition-export-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 9px;
            padding: 10px 14px;
            background: #00897b;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }
        @media (max-width: 900px) {
            aside { width: 210px; padding: 18px; }
            main { padding: 24px; }
            .content-grid { grid-template-columns: 1fr; gap: 16px; }
            .detail-panel { padding: 18px; }
            .verify-list { flex-direction: column; }
        }
        @media (max-width: 680px) {
            body { display: block; }
            aside { width: 100%; padding: 14px; }
            aside > div:first-child { display: flex; align-items: center; gap: 14px; }
            .brand { margin: 0; }
            .menu-label, .sidebar-footer { display: none; }
            nav { display: flex; flex-wrap: wrap; gap: 4px; }
            nav a { padding: 8px; margin: 0; }
            main { padding: 18px 14px; }
            .content-grid { grid-template-columns: 1fr; }
            .summary-box-grid, .meta-info-grid { grid-template-columns: 1fr; }
            .action-footer-grid { grid-template-columns: 1fr 1fr; }
            .btn-export { grid-column: 1 / -1; }
            .title-section { align-items: flex-start; gap: 12px; }
            .badge-status-group { flex-direction: column; }
            .condition-report-summary { grid-template-columns: repeat(2, minmax(0, 1fr)); padding: 14px; }
            .condition-report-heading { align-items: flex-start; flex-direction: column; padding: 16px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri - Ruang Petugas (Menu Laporan Aktif) -->
    <?php echo $__env->make('petugas.partials.sidebar', ['active' => 'laporan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


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
                <h1>Laporan inventaris</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>Rizky Maulana</span>
            </div>
        </header>

        <div class="breadcrumb">Dashboard / <strong>Laporan inventaris</strong></div>

        <section class="condition-report-section">
            <div class="condition-report-heading">
                <div>
                    <h2>Laporan kondisi alat dari siswa</h2>
                    <p>Data laporan tersimpan dari formulir siswa, termasuk kondisi dan deskripsi kerusakan.</p>
                </div>
                <a class="condition-export-link" href="<?php echo e(route('petugas.laporan.kondisi.export')); ?>">⬇ Export laporan kondisi (CSV)</a>
            </div>
            <div class="condition-report-summary">
                <div class="condition-summary-card">
                    <span>Total laporan</span>
                    <strong><?php echo e($laporanKondisis->count()); ?></strong>
                </div>
                <div class="condition-summary-card">
                    <span>Baik / normal</span>
                    <strong><?php echo e($rekapKondisi['baik'] ?? 0); ?></strong>
                </div>
                <div class="condition-summary-card">
                    <span>Rusak ringan</span>
                    <strong><?php echo e($rekapKondisi['rusak_ringan'] ?? 0); ?></strong>
                </div>
                <div class="condition-summary-card">
                    <span>Rusak berat</span>
                    <strong><?php echo e($rekapKondisi['rusak_berat'] ?? 0); ?></strong>
                </div>
                <div class="condition-summary-card">
                    <span>Belum dipakai</span>
                    <strong><?php echo e($rekapKondisi['belum_dipakai'] ?? 0); ?></strong>
                </div>
            </div>
            <?php if($laporanKondisis->isEmpty()): ?>
                <div class="condition-report-empty">Belum ada laporan kondisi alat dari siswa.</div>
            <?php else: ?>
                <div class="condition-report-table-wrap">
                    <table class="condition-report-table">
                        <thead>
                            <tr>
                                <th>Tanggal laporan</th>
                                <th>Siswa</th>
                                <th>Alat</th>
                                <th>Lokasi / tanggal kembali</th>
                                <th>Kondisi</th>
                                <th>Deskripsi laporan siswa</th>
                                <th>Bukti foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $laporanKondisis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporanKondisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($laporanKondisi->created_at?->format('d M Y H:i')); ?></td>
                                    <td>
                                        <strong><?php echo e($laporanKondisi->peminjaman?->user?->name ?? $laporanKondisi->nama_peminjam); ?></strong><br>
                                        <?php echo e($laporanKondisi->peminjaman?->user?->email ?? ''); ?>

                                    </td>
                                    <td>
                                        <strong><?php echo e($laporanKondisi->peminjaman?->alat?->nama_alat ?? 'Alat'); ?></strong><br>
                                        <?php echo e($laporanKondisi->kode_inventaris); ?> · <?php echo e(ucfirst($laporanKondisi->kategori)); ?>

                                    </td>
                                    <td>
                                        <?php echo e($laporanKondisi->lokasi_kegiatan); ?><br>
                                        <?php echo e($laporanKondisi->tanggal_pengembalian ?: '-'); ?>

                                    </td>
                                    <td><?php echo e(str_replace('_', ' ', ucfirst($laporanKondisi->kondisi_terima))); ?></td>
                                    <td class="description"><?php echo e($laporanKondisi->deskripsi_kerusakan ?: '-'); ?></td>
                                    <td><?php echo e($laporanKondisi->kirim_dengan_foto ? 'Terlampir' : 'Tidak'); ?></td>
                                    <td>
                                        <button type="button" class="btn-view-report" data-view-report
                                            data-tanggal="<?php echo e($laporanKondisi->created_at?->format('d M Y H:i') ?? '-'); ?>"
                                            data-siswa="<?php echo e($laporanKondisi->peminjaman?->user?->name ?? $laporanKondisi->nama_peminjam); ?>"
                                            data-email="<?php echo e($laporanKondisi->peminjaman?->user?->email ?? '-'); ?>"
                                            data-alat="<?php echo e($laporanKondisi->peminjaman?->alat?->nama_alat ?? 'Alat'); ?>"
                                            data-kode="<?php echo e($laporanKondisi->kode_inventaris); ?>"
                                            data-kategori="<?php echo e(ucfirst($laporanKondisi->kategori)); ?>"
                                            data-lokasi="<?php echo e($laporanKondisi->lokasi_kegiatan); ?>"
                                            data-kembali="<?php echo e($laporanKondisi->tanggal_pengembalian ?: '-'); ?>"
                                            data-kondisi="<?php echo e(str_replace('_', ' ', ucfirst($laporanKondisi->kondisi_terima))); ?>"
                                            data-deskripsi="<?php echo e($laporanKondisi->deskripsi_kerusakan ?: '-'); ?>"
                                            data-foto="<?php echo e($laporanKondisi->kirim_dengan_foto ? 'Terlampir (siswa melampirkan bukti foto)' : 'Tidak ada bukti foto'); ?>">
                                            👁 Lihat laporan
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <!-- Modal Detail Laporan Siswa -->
    <div class="report-modal-backdrop" id="report-modal-backdrop">
        <div class="report-modal" role="dialog" aria-modal="true" aria-labelledby="report-modal-title">
            <div class="report-modal-header">
                <h3 id="report-modal-title">Detail laporan kondisi alat</h3>
                <button type="button" class="report-modal-close" data-close-report aria-label="Tutup">✕</button>
            </div>
            <div class="report-modal-body">
                <dl>
                    <dt>Tanggal laporan</dt><dd data-field="tanggal">-</dd>
                    <dt>Siswa</dt><dd data-field="siswa">-</dd>
                    <dt>Email siswa</dt><dd data-field="email">-</dd>
                    <dt>Alat</dt><dd data-field="alat">-</dd>
                    <dt>Kode inventaris</dt><dd data-field="kode">-</dd>
                    <dt>Kategori</dt><dd data-field="kategori">-</dd>
                    <dt>Lokasi kegiatan</dt><dd data-field="lokasi">-</dd>
                    <dt>Tanggal pengembalian</dt><dd data-field="kembali">-</dd>
                    <dt>Kondisi alat</dt><dd data-field="kondisi">-</dd>
                    <dt>Bukti foto</dt><dd data-field="foto">-</dd>
                    <dt>Deskripsi laporan siswa</dt><dd class="description" data-field="deskripsi">-</dd>
                </dl>
            </div>
        </div>
    </div>

<script>
    const reportModal = document.getElementById('report-modal-backdrop');

    document.querySelectorAll('[data-view-report]').forEach((button) => {
        button.addEventListener('click', () => {
            reportModal.querySelectorAll('[data-field]').forEach((field) => {
                field.textContent = button.dataset[field.dataset.field] || '-';
            });
            reportModal.classList.add('open');
        });
    });

    reportModal.addEventListener('click', (event) => {
        if (event.target === reportModal || event.target.closest('[data-close-report]')) {
            reportModal.classList.remove('open');
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') reportModal.classList.remove('open');
    });
</script>
    

</body>
</html><?php /**PATH C:\xampp7\htdocs\simpati\resources\views/petugas/laporan.blade.php ENDPATH**/ ?>