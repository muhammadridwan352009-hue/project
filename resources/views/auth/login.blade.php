<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMPATI SMKN 5 Surakarta</title>
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
            width: 48%;
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
            margin: 36px 0;
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
            font-size: 32px;
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
            font-size: 13.5px;
            line-height: 1.65;
            color: #94a3b8;
            margin-bottom: 24px;
            max-width: 500px;
        }

        /* Feature Cards */
        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 500px;
        }
        .feature-card {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 12px 16px;
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
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: rgba(45, 212, 191, 0.15);
            color: #2dd4bf;
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
            padding-top: 18px;
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

        /* ===== PANEL KANAN (FORM LOGIN TUNGGAL) ===== */
        .panel-right {
            width: 52%;
            background-color: #f8fafc;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow-y: auto;
        }
        .form-wrapper {
            width: 100%;
            max-width: 420px;
        }
        .card-form {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 34px 32px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }
        .card-form h2 {
            font-size: 24px;
            color: #0f172a;
            margin-bottom: 6px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .card-form p.intro-desc {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        /* Alerts */
        .alert-box {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-success {
            color: #065f46;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
        }
        .alert-danger {
            color: #991b1b;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 12px 14px;
            font-size: 13.5px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            transition: all 0.2s;
            background: #ffffff;
            color: #0f172a;
        }
        .form-control:focus {
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.12);
        }
        .field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12.5px;
            color: #64748b;
            margin-bottom: 22px;
        }

        .btn-submit {
            width: 100%;
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(0, 137, 123, 0.25);
        }
        .btn-submit:hover {
            background-color: #00796b;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(0, 137, 123, 0.35);
        }
        .btn-submit:active {
            transform: translateY(0);
        }

        .register-footer {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
        .register-footer a {
            color: #00897b;
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
            transition: color 0.15s;
        }
        .register-footer a:hover {
            color: #00796b;
            text-decoration: underline;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 980px) {
            html, body {
                min-height: 100%;
                background-color: #f8fafc;
            }
            .container {
                flex-direction: column;
                min-height: 100vh;
                margin: 0;
                padding: 0;
            }
            .panel-left {
                width: 100%;
                padding: 28px 36px 22px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
                flex-shrink: 0;
                justify-content: flex-start;
            }
            .brand-header {
                gap: 12px;
                justify-content: flex-start;
                align-items: center;
            }
            .brand-logo-card {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                padding: 3px;
            }
            .brand-meta {
                text-align: left;
            }
            .brand-meta h2 {
                font-size: 18px;
                letter-spacing: 1px;
                line-height: 1.1;
            }
            .brand-meta span {
                font-size: 10px;
                letter-spacing: 0.5px;
            }
            .panel-left-content {
                margin: 28px 0;
            }
            .panel-left h1 {
                font-size: 28px;
            }
            .panel-left-desc {
                font-size: 13px;
            }
            .feature-list {
                width: 100%;
            }
            .footer-left {
                font-size: 11px;
            }
            .panel-right {
                width: 100%;
                flex: 1;
                min-height: 420px;
                padding: 40px 24px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background-color: #f8fafc;
            }
            .form-wrapper {
                width: 100%;
                max-width: 420px;
            }
            .card-form {
                width: 100%;
                padding: 28px 24px;
                border-radius: 18px;
                border: 1px solid #e2e8f0;
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
                box-sizing: border-box;
            }
        }

        @media (max-width: 640px) {
            .panel-left {
                padding: 20px 18px 18px;
            }
            .brand-logo-card {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                padding: 3px;
            }
            .brand-meta h2 {
                font-size: 16px;
            }
            .brand-meta span {
                font-size: 9px;
            }
            .panel-left-content {
                margin: 24px 0;
            }
            .badge-pill {
                padding: 6px 10px;
                font-size: 9px;
                margin-bottom: 14px;
            }
            .panel-left h1 {
                font-size: 24px;
            }
            .panel-left-desc {
                font-size: 12px;
                margin-bottom: 18px;
            }
            .feature-list {
                gap: 9px;
            }
            .feature-card {
                gap: 10px;
                padding: 10px 11px;
            }
            .feature-icon-wrap {
                width: 30px;
                height: 30px;
            }
            .feature-text strong {
                font-size: 12px;
            }
            .feature-text p {
                font-size: 10.5px;
            }
            .footer-left {
                gap: 10px;
                font-size: 9px;
            }
            .panel-right {
                min-height: 0;
                padding: 24px 14px;
            }
            .form-wrapper {
                max-width: 100%;
            }
            .card-form {
                padding: 22px 18px;
                border-radius: 16px;
            }
            .card-form h2 {
                font-size: 20px;
            }
            .card-form p.intro-desc {
                font-size: 12.5px;
                margin-bottom: 18px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-control {
                padding: 11px 13px;
                font-size: 13.5px;
            }
            .btn-submit {
                padding: 12px;
                font-size: 13.5px;
            }
        }

        @media (max-width: 360px) {
            .panel-left {
                padding-right: 14px;
                padding-left: 14px;
            }
            .panel-left h1 {
                font-size: 21px;
            }
            .footer-left {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Panel Kiri: Hero & Identitas SIMPATI -->
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
                    Platform terpadu untuk mempermudah siswa dan petugas SMK Negeri 5 Surakarta dalam mengakses alat kejuruan, memantau ketersediaan sarpras, dan mengelola inventaris secara akuntabel.
                </p>

                <!-- Fitur Unggulan -->
                <div class="feature-list">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">⚡</div>
                        <div class="feature-text">
                            <strong>Peminjaman Cepat & Mandiri</strong>
                            <p>Ajukan permohonan alat praktik online tanpa formulir kertas yang rumit.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🔍</div>
                        <div class="feature-text">
                            <strong>Monitoring Stok & Kesiapan Real-Time</strong>
                            <p>Pantau status ketersediaan peralatan lab dan bengkel sekolah kapan saja.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🛡️</div>
                        <div class="feature-text">
                            <strong>Pencatatan Tertib & Terverifikasi</strong>
                            <p>Validasi peminjaman oleh petugas serta riwayat inventaris yang transparan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Left -->
            <div class="footer-left">
                <span class="school-tag">SMK Negeri 5 Surakarta • Portal SIMPATI</span>
                <span class="status-badge">● Sistem Terhubung</span>
            </div>
        </div>

        <!-- Panel Kanan: Form Login Tunggal (Siswa & Petugas) -->
        <div class="panel-right">
            <div class="form-wrapper">
                <div class="card-form">
                    <h2>Masuk ke SIMPATI</h2>
                    <p class="intro-desc">Masukkan email dan kata sandi Anda untuk masuk ke sistem.</p>

                    {{-- Notifikasi Sukses / Status --}}
                    @if (session('status'))
                        <div class="alert-box alert-success" role="status">
                            <span>✓</span>
                            <div>{{ session('status') }}</div>
                        </div>
                    @endif

                    {{-- Notifikasi Error Status Akun (Pending / Rejected) --}}
                    @if (session('error'))
                        <div class="alert-box alert-danger" role="alert">
                            <span>⚠️</span>
                            <div>{{ session('error') }}</div>
                        </div>
                    @endif

                    {{-- Notifikasi Error Login Umum --}}
                    @if ($errors->has('email'))
                        <div class="alert-box alert-danger" role="alert">
                            <span>✕</span>
                            <div>{{ $errors->first('email') }}</div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.proses') }}">
                        @csrf

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="nama@smkn5surakarta.id" 
                                class="form-control" 
                                required 
                                autofocus
                            >
                        </div>

                        <!-- Kata Sandi -->
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••••••••" 
                                class="form-control" 
                                required
                            >
                            @error('password')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ingat Saya -->
                        <div class="form-row">
                            <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                <input type="checkbox" name="remember" style="accent-color: #00897b;"> Ingat saya
                            </label>
                        </div>

                        <!-- Tombol Masuk -->
                        <button type="submit" class="btn-submit">
                            <span>🚀</span> Masuk ke SIMPATI
                        </button>
                    </form>

                    <!-- Tautan Pendaftaran Siswa -->
                    <div class="register-footer">
                        Belum memiliki akun siswa?
                        <a href="{{ route('register.siswa') }}">Daftar Akun Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
