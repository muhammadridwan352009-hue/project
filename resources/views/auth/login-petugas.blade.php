<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas - SIMPATI</title>
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
        .panel-left::before {
            content: '';
            position: absolute;
            top: -100px;
            left: -100px;
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.18) 0%, transparent 70%);
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
            background: radial-gradient(circle, rgba(20, 184, 166, 0.18) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Brand Header */
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
            color: #fbbf24;
            margin-top: 2px;
        }

        /* Hero Content */
        .panel-left-content {
            position: relative;
            z-index: 2;
            margin: 36px 0;
        }
        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.35);
            color: #fbbf24;
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
            background: #fbbf24;
            box-shadow: 0 0 10px #fbbf24;
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
            background: linear-gradient(135deg, #fbbf24 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .panel-left-desc {
            font-size: 14px;
            line-height: 1.65;
            color: #94a3b8;
            margin-bottom: 24px;
            max-width: 520px;
        }

        /* Stats Showcase */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
            max-width: 520px;
        }
        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.09);
            border-radius: 14px;
            padding: 14px 14px;
            backdrop-filter: blur(10px);
            transition: all 0.25s ease;
        }
        .stat-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(245, 158, 11, 0.4);
            transform: translateY(-2px);
        }
        .stat-card strong {
            display: block;
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
        }
        .stat-card span {
            display: block;
            font-size: 11.5px;
            color: #94a3b8;
            margin-top: 4px;
            font-weight: 500;
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
            padding: 12px 14px;
            background: rgba(255, 255, 255, 0.035);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.25s ease;
        }
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(245, 158, 11, 0.35);
            transform: translateX(4px);
        }
        .feature-icon-wrap {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        .feature-text strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 2px;
        }
        .feature-text p {
            font-size: 11.5px;
            line-height: 1.45;
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
            color: #fbbf24;
            font-weight: 600;
        }

        /* ===== PANEL KANAN (FORM LOGIN PETUGAS) ===== */
        .panel-right {
            width: 54%;
            background-color: #f8fafc;
            padding: 40px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }
        .form-wrapper {
            width: 100%;
            max-width: 440px;
        }
        .back-link {
            font-size: 12.5px;
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
            font-weight: 600;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #00897b;
        }
        .card-form {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        }
        .restricted-badge {
            font-size: 10.5px;
            background: #fef3c7;
            color: #92400e;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            display: inline-block;
            border: 1px solid #fde68a;
        }
        .card-form h2 {
            font-size: 22px;
            color: #0f172a;
            margin: 12px 0 4px 0;
            font-weight: 800;
            letter-spacing: -0.3px;
        }
        .card-form p.intro-desc {
            font-size: 12.5px;
            color: #64748b;
            margin-bottom: 22px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 11px 14px;
            font-size: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            outline: none;
            transition: all 0.2s;
            background: #ffffff;
            color: #0f172a;
        }
        .form-control:focus {
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.12);
        }
        .form-row {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 20px;
        }
        .btn-submit {
            width: 100%;
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(0, 137, 123, 0.25);
        }
        .btn-submit:hover {
            background-color: #00796b;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 137, 123, 0.35);
        }
        .warning-box {
            margin-top: 16px;
            background-color: #fffbeb;
            border: 1px solid #fde68a;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 11.5px;
            color: #92400e;
            display: flex;
            align-items: center;
            gap: 10px;
            line-height: 1.4;
        }
        .error-msg {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            margin-bottom: 16px;
            border: 1px solid #fecaca;
        }
        .register-link {
            color: #00897b;
            font-weight: 700;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 980px) {
            .container {
                flex-direction: column;
                min-height: 100vh;
            }
            .panel-left {
                width: 100%;
                padding: 36px 28px;
            }
            .feature-list, .stats-grid {
                display: none;
            }
            .panel-right {
                width: 100%;
                padding: 36px 24px;
            }
            .panel-left h1 {
                font-size: 26px;
            }
        }

        @media (max-width: 640px) {
            .panel-left {
                padding: 24px 20px 20px;
            }
            .brand-header {
                gap: 12px;
            }
            .brand-logo-card {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                padding: 4px;
            }
            .brand-meta h2 {
                font-size: 19px;
                letter-spacing: 1px;
            }
            .brand-meta span {
                font-size: 10px;
            }
            .panel-left-content,
            .footer-left {
                display: none;
            }
            .panel-right {
                padding: 20px 16px 36px;
            }
            .card-form {
                padding: 24px 18px;
                border-radius: 14px;
            }
            .card-form h2 {
                font-size: 20px;
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

            <!-- Hero Content -->
            <div class="panel-left-content">
                <div class="badge-pill">
                    <span class="pulse-dot"></span>
                    Pusat Kendali Sarpras • Petugas & Admin
                </div>
                <h1>
                    Kendali Akurat Seluruh Aset & <span class="highlight">Sirkulasi Alat Sekolah.</span>
                </h1>
                <p class="panel-left-desc">
                    Otorisasi permohonan peminjaman siswa secara real-time, kontrol ketersediaan peralatan lab & bengkel, serta pertahankan kondisi aset sekolah selalu prima dan siap pakai.
                </p>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <strong>280+</strong>
                        <span>Aset Terdata</span>
                    </div>
                    <div class="stat-card">
                        <strong>Real-Time</strong>
                        <span>Verifikasi Izin</span>
                    </div>
                    <div class="stat-card">
                        <strong>100%</strong>
                        <span>Terdokumentasi</span>
                    </div>
                </div>

                <!-- Feature Highlights -->
                <div class="feature-list">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🛡️</div>
                        <div class="feature-text">
                            <strong>Validasi & Otorisasi Cepat</strong>
                            <p>Tinjau dan setujui permohonan peminjaman siswa langsung dari dashboard.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🔧</div>
                        <div class="feature-text">
                            <strong>Monitoring Kondisi & Servis</strong>
                            <p>Catat riwayat pemeliharaan dan kondisi fisik alat agar siap pakai setiap saat.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">📊</div>
                        <div class="feature-text">
                            <strong>Rekapitulasi Laporan Otomatis</strong>
                            <p>Pantau sirkulasi dan log serah terima barang siap ekspor serta arsip.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Left -->
            <div class="footer-left">
                <span class="school-tag">SMK Negeri 5 Surakarta • Panel Petugas</span>
                <span class="status-badge">● Otoritas Terverifikasi</span>
            </div>
        </div>

        <!-- Panel Kanan: Form Login Petugas -->
        <div class="panel-right">
            <div class="form-wrapper">
                <a href="{{ url('/') }}" class="back-link">‹ Kembali pilih peran</a>

                <div class="card-form">
                    <span class="restricted-badge">Akses Terbatas</span>
                    <h2>Masuk sebagai Petugas</h2>
                    <p class="intro-desc">Khusus petugas sarpras dan pengelola inventaris terdaftar.</p>

                    {{-- Tampilkan error jika login gagal --}}
                    @if ($errors->has('login'))
                        <div class="error-msg">
                            {{ $errors->first('login') }}
                        </div>
                    @endif

                    <form action="{{ route('login.petugas.proses') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="login">ID Petugas atau Email Resmi</label>
                            <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Contoh: PTO-006 atau petugas@smkn5surakarta.id" class="form-control" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="••••••••••••••" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                <input type="checkbox" name="remember" style="accent-color: #00897b;"> Tetap masuk di perangkat ini
                            </label>
                        </div>

                        <button type="submit" class="btn-submit">
                            <span>✓</span> Masuk ke Ruang Petugas
                        </button>
                    </form>

                    <div class="warning-box">
                        <span style="font-size: 16px;">⚠️</span>
                        <span>Belum punya akun petugas? Hubungi tim sarpras sekolah tingkat pusat untuk aktivasi akun.</span>
                    </div>

                    <div class="register-box" style="margin-top: 20px; text-align: center; font-size: 13px; color: #64748b;">
                        Belum punya akun?
                        <a href="{{ route('register.siswa') }}" class="register-link">Daftar sebagai Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
