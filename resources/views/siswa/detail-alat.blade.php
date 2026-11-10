<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Alat - SIMPATI</title>
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

        /* Main Area */
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
            margin-bottom: 24px;
        }
        .breadcrumb a {
            color: #00897b;
            text-decoration: none;
        }

        /* Layout Detail Utama */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            align-items: start;
        }

        /* Section Kiri */
        .left-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Card Banner Atas */
        .item-main-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 24px;
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .img-container {
            position: relative;
            width: 100%;
            height: 220px;
            background: #2d3748;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-weight: bold;
        }
        .img-container > img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .badge-code {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: bold;
            color: #071b26;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .badge-code .cat { color: #7c3aed; font-size: 9px; text-transform: uppercase; }

        .info-header {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .status-pill {
            font-size: 11px;
            color: #059669;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 6px;
        }
        .status-pill.empty { color: #dc2626; }
        .item-title-large {
            font-size: 22px;
            font-weight: 800;
            color: #071b26;
            margin-bottom: 8px;
            line-height: 1.2;
        }
        .item-description {
            font-size: 12px;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .quick-specs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .spec-box {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            padding: 10px;
            font-size: 11px;
        }
        .spec-box .label { color: #94a3b8; margin-bottom: 2px; }
        .spec-box .value { font-weight: bold; color: #1e293b; }

        /* Grid Spesifikasi & Aturan */
        .bottom-cards-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .card-box {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .card-box-title {
            font-size: 14px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 16px;
        }

        /* Tabel Spesifikasi */
        .spec-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        .spec-table tr {
            border-bottom: 1px solid #f1f5f9;
        }
        .spec-table tr:last-child {
            border-bottom: none;
        }
        .spec-table td {
            padding: 8px 0;
            color: #64748b;
        }
        .spec-table td:last-child {
            text-align: right;
            font-weight: 600;
            color: #1e293b;
        }

        /* List Aturan */
        .rule-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .rule-list li {
            font-size: 12px;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .rule-list li span.check {
            color: #00897b;
            font-weight: bold;
        }

        /* Section Kanan Widget Form */
        .booking-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .booking-card h3 {
            font-size: 16px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 4px;
        }
        .booking-card p.sub {
            font-size: 11px;
            color: #718096;
            margin-bottom: 16px;
        }

        .status-alert-green {
            background-color: #e6f4ea;
            color: #00695c;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 16px;
        }

        .btn-submit-booking {
            width: 100%;
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: 0.2s;
        }
        .btn-submit-booking:hover { background-color: #00796b; }
        .btn-submit-booking.disabled {
            background-color: #cbd5e1;
            cursor: not-allowed;
            pointer-events: none;
        }

        .btn-fav-secondary {
            width: 100%;
            background: #fff;
            border: 1px solid #cbd5e1;
            padding: 10px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }
        
        @media (max-width: 960px) {
            .detail-grid { grid-template-columns: 1fr; }
            .item-main-card { grid-template-columns: 1fr; }
            .img-container { height: 180px; }
        }
        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .item-main-card, .booking-card, .card-box { padding: 16px; }
            .item-title-large { font-size: 18px; }
            .quick-specs { grid-template-columns: repeat(2, 1fr); }
            .bottom-cards-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 420px) {
            .quick-specs { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('siswa.partials.sidebar', ['active' => 'katalog'])


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
                <h1>Detail alat</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">
            <a href="{{ route('siswa.beranda') }}">Beranda</a> /
            <a href="{{ route('siswa.katalog') }}">Katalog alat</a> /
            <strong>{{ $alat->nama_alat }}</strong>
        </div>

        @if(session('error'))
            <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 12px; font-weight: bold;">
                {{ session('error') }}
            </div>
        @endif

        <div class="detail-grid">

            <!-- Kolom Kiri -->
            <div class="left-content">

                <!-- Main Product Display -->
                <div class="item-main-card">
                    <div class="img-container">
                        @if($alat->foto_katalog)
                            <img src="{{ $alat->foto_katalog }}" alt="Foto {{ $alat->nama_alat }}">
                        @else
                            <span>{{ $alat->nama_alat }}</span>
                        @endif
                        <div class="badge-code">
                            <span>{{ $alat->kode_alat ?? 'INV-'.$alat->id }}</span>
                            <span class="cat">{{ $alat->kategori ?? 'UMUM' }}</span>
                        </div>
                    </div>

                    <div class="info-header">
                        <div>
                            <div class="status-pill {{ ($alat->stok ?? 1) > 0 ? '' : 'empty' }}">
                                ● {{ ($alat->stok ?? 1) > 0 ? 'Tersedia' : 'Habis' }}
                            </div>
                            <div class="item-title-large">{{ $alat->nama_alat }}</div>
                            <div class="item-description-box" style="margin-bottom: 20px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #00897b; margin-bottom: 4px;">Deskripsi:</div>
                                <div class="item-description" style="margin-bottom: 0; font-size: 13px; color: #475569; line-height: 1.6; white-space: pre-line;">"{{ $alat->deskripsi_tampil }}"</div>
                            </div>
                        </div>

                        <div class="quick-specs">
                            <div class="spec-box">
                                <div class="label">Stok</div>
                                <div class="value">{{ $alat->stok ?? 1 }} unit</div>
                            </div>
                            <div class="spec-box">
                                <div class="label">Kondisi</div>
                                <div class="value">{{ $alat->kondisi ?? 'Baik' }}</div>
                            </div>
                            <div class="spec-box">
                                <div class="label">Lokasi</div>
                                <div class="value">{{ $alat->lokasi ?? 'Ruang Sarpras' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spesifikasi & Aturan -->
                <div class="bottom-cards-grid">

                    <!-- Tabel Spesifikasi -->
                    <div class="card-box">
                        <div class="card-box-title">Spesifikasi & kelengkapan</div>
                        <table class="spec-table">
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $alat->kategori ?? 'Umum' }}</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>{{ $alat->lokasi ?? 'Ruang Sarpras' }}</td>
                            </tr>
                            <tr>
                                <td>Kondisi</td>
                                <td>{{ $alat->kondisi ?? 'Baik' }}</td>
                            </tr>
                            <tr>
                                <td>Kelengkapan</td>
                                <td>Unit utama & aksesoris standar</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Aturan Peminjaman -->
                    <div class="card-box">
                        <div class="card-box-title">Aturan peminjaman</div>
                        <ul class="rule-list">
                            <li><span class="check">✓</span> Maksimal peminjaman 3 hari.</li>
                            <li><span class="check">✓</span> Wajib didampingi petugas atau pengurus.</li>
                            <li><span class="check">✓</span> Periksa kondisi fisik saat pengambilan.</li>
                            <li><span class="check">✓</span> Kerusakan wajib dilaporkan segera.</li>
                        </ul>
                    </div>

                </div>

            </div>

            <!-- Kolom Kanan: Aksi & Informasi Pengajuan -->
            <div class="booking-card">
                <h3>Form Peminjaman</h3>
                <p class="sub">Pastikan stok mencukupi sebelum mengajukan.</p>

                <div class="status-alert-green">
                    <span>✓</span> {{ $alat->stok ?? 1 }} unit tersedia untuk dipinjam.
                </div>

                @if(($alat->stok ?? 1) > 0)
                    <a href="{{ route('siswa.peminjaman.create') }}?alat_id={{ $alat->id }}&kategori={{ strtolower($alat->kategori ?? '') }}" class="btn-submit-booking">↗ Ajukan peminjaman</a>
                @else
                    <button class="btn-submit-booking disabled">Stok Habis</button>
                @endif
                
                <a href="{{ route('siswa.katalog') }}" class="btn-fav-secondary">‹ Kembali ke Katalog</a>
            </div>

        </div>
    </main>
    

</body>
</html>