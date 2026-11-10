<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPATI - Portal Inventaris & Peminjaman Alat</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
        }
        body {
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
        }
        .container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* ===== PANEL KIRI (HERO & BRANDING) ===== */
        .panel-left {
            width: 46%;
            background: radial-gradient(135% 125% at 0% 0%, #0d2e40 0%, #071b26 50%, #030d13 100%);
            color: #fff;
            padding: 56px 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            box-shadow: 6px 0 30px rgba(0, 0, 0, 0.15);
        }
        /* Luminous ambient background lights */
        .panel-left::before {
            content: '';
            position: absolute;
            top: -100px;
            left: -100px;
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.22) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.18) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Header Brand Row */
        .brand-header {
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            z-index: 2;
        }
        .brand-logo-card {
            width: 58px;
            height: 58px;
            background: #ffffff;
            border-radius: 16px;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.4);
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .brand-logo-card img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .brand-meta h2 {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #ffffff;
            line-height: 1.2;
        }
        .brand-meta span {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #2dd4bf;
            margin-top: 2px;
        }

        /* Hero Content */
        .panel-left-content {
            position: relative;
            z-index: 2;
            margin: 40px 0;
        }
        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(45, 212, 191, 0.12);
            border: 1px solid rgba(45, 212, 191, 0.3);
            color: #2dd4bf;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .badge-pill .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #2dd4bf;
            box-shadow: 0 0 10px #2dd4bf;
            animation: pulse-dot 2s infinite ease-in-out;
        }
        @keyframes pulse-dot {
            0%, 100% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1.25); opacity: 1; }
        }

        .panel-left h1 {
            font-size: 34px;
            line-height: 1.25;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 14px;
            letter-spacing: -0.5px;
        }
        .panel-left h1 .highlight {
            background: linear-gradient(135deg, #2dd4bf 0%, #38bdf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .panel-left-desc {
            font-size: 14px;
            line-height: 1.65;
            color: #94a3b8;
            margin-bottom: 28px;
            max-width: 520px;
        }

        /* Feature Cards */
        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 520px;
        }
        .feature-card {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 14px;
            backdrop-filter: blur(10px);
            transition: all 0.25s ease;
        }
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(45, 212, 191, 0.35);
            transform: translateX(4px);
        }
        .feature-icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(45, 212, 191, 0.15);
            color: #2dd4bf;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        .feature-text strong {
            display: block;
            font-size: 13.5px;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 3px;
        }
        .feature-text p {
            font-size: 12px;
            line-height: 1.5;
            color: #94a3b8;
            margin: 0;
        }

        /* Footer Left */
        .footer-left {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 20px;
        }
        .footer-left .school-tag {
            color: #94a3b8;
            font-weight: 500;
        }
        .footer-left .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #2dd4bf;
            font-weight: 600;
        }

        /* ===== PANEL KANAN (PILIH PERAN) ===== */
        .panel-right {
            width: 54%;
            background-color: #f8fafc;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .role-wrapper {
            width: 100%;
            max-width: 440px;
        }
        .role-header {
            margin-bottom: 28px;
        }
        .role-header h2 {
            font-size: 26px;
            color: #0f172a;
            margin-bottom: 6px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .role-header p {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.5;
        }
        .role-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            padding: 22px 24px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            margin-bottom: 16px;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
        }
        .role-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #00897b;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .role-card:hover {
            border-color: #00897b;
            box-shadow: 0 10px 24px rgba(0, 137, 123, 0.12);
            transform: translateY(-2px);
        }
        .role-card:hover::before {
            opacity: 1;
        }
        .role-card.petugas::before {
            background: #d97706;
        }
        .role-card.petugas:hover {
            border-color: #d97706;
            box-shadow: 0 10px 24px rgba(217, 119, 6, 0.12);
        }
        .role-info h3 {
            font-size: 16px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .role-info span {
            font-size: 12.5px;
            color: #64748b;
            display: block;
            line-height: 1.4;
        }
        .role-icon {
            width: 50px;
            height: 50px;
            background: #e6f4ea;
            color: #00897b;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            margin-left: 16px;
            transition: transform 0.2s;
        }
        .role-card:hover .role-icon {
            transform: scale(1.08);
        }
        .role-card.petugas .role-icon {
            background: #fef3c7;
            color: #d97706;
        }
        .role-arrow {
            color: #94a3b8;
            font-size: 18px;
            margin-left: 10px;
            transition: transform 0.2s;
        }
        .role-card:hover .role-arrow {
            transform: translateX(3px);
            color: #00897b;
        }
        .role-card.petugas:hover .role-arrow {
            color: #d97706;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 980px) {
            .container {
                flex-direction: column;
            }
            .panel-left {
                width: 100%;
                padding: 40px 28px;
            }
            .feature-list {
                display: none;
            }
            .panel-right {
                width: 100%;
                padding: 40px 20px;
            }
            .panel-left h1 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Panel Kiri: Hero & Branding -->
        <div class="panel-left">
            <!-- Brand Header -->
            <div class="brand-header">
                <div class="brand-logo-card">
                    <img src="{{ asset('SIMPATI Inventory Equipment Logo.png') }}" alt="Logo SIMPATI">
                </div>
                <div class="brand-meta">
                    <h2>SIMPATI</h2>
                    <span>SMK NEGERI 5 SURAKARTA</span>
                </div>
            </div>

            <!-- Hero Text & Features -->
            <div class="panel-left-content">
                <div class="badge-pill">
                    <span class="pulse-dot"></span>
                    Portal Sarpras & Inventaris Digital
                </div>
                <h1>
                    Kelola Sarana & Peminjaman Alat Praktik <span class="highlight">Lebih Mudah.</span>
                </h1>
                <p class="panel-left-desc">
                    Platform terpadu untuk mempermudah siswa dan pengelola SMK Negeri 5 Surakarta dalam mengakses alat kejuruan, memantau ketersediaan sarpras, dan menjaga inventaris tetap tertata rapi.
                </p>

                <!-- Fitur Unggulan -->
                <div class="feature-list">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">⚡</div>
                        <div class="feature-text">
                            <strong>Peminjaman Cepat & Mandiri</strong>
                            <p>Ajukan permohonan alat praktik langsung secara online tanpa formulir kertas.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🔍</div>
                        <div class="feature-text">
                            <strong>Monitoring Stok & Kesiapan Real-Time</strong>
                            <p>Pantau status ketersediaan peralatan lab dan bengkel sekolah sebelum kegiatan.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🛡️</div>
                        <div class="feature-text">
                            <strong>Pencatatan Tertib & Akuntabel</strong>
                            <p>Riwayat serah terima dan pemeliharaan alat tercatat aman serta transparan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Left -->
            <div class="footer-left">
                <span class="school-tag">SMK Negeri 5 Surakarta • Portal Utama</span>
                <span class="status-badge">● Sistem Terhubung</span>
            </div>
        </div>

        <!-- Panel Kanan: Pilihan Peran -->
        <div class="panel-right">
            <div class="role-wrapper">
                <div class="role-header">
                    <h2>Selamat datang di SIMPATI</h2>
                    <p>Silakan tentukan jalur masuk sesuai peran Anda di sekolah.</p>
                </div>

                <!-- Pilihan Siswa -->
                <a href="{{ route('login.siswa') }}" class="role-card">
                    <div class="role-info">
                        <h3>Masuk sebagai Siswa</h3>
                        <span>Ajukan peminjaman, cek status & riwayat alat praktik</span>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <div class="role-icon">👨‍🎓</div>
                        <span class="role-arrow">›</span>
                    </div>
                </a>

                <!-- Pilihan Petugas -->
                <a href="{{ route('login.petugas') }}" class="role-card petugas">
                    <div class="role-info">
                        <h3>Masuk sebagai Petugas</h3>
                        <span>Kelola inventaris, verifikasi izin & laporan sarpras</span>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <div class="role-icon">🛡️</div>
                        <span class="role-arrow">›</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
