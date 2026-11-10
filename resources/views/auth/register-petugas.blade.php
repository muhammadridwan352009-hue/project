<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Petugas - SIMPATI</title>
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

        /* ===== PANEL KANAN (FORM DAFTAR PETUGAS) ===== */
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
        .card-form h2 {
            font-size: 22px;
            color: #0f172a;
            margin-bottom: 6px;
            font-weight: 800;
            letter-spacing: -0.3px;
        }
        .intro {
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
        .field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
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
            margin-top: 10px;
        }
        .btn-submit:hover {
            background-color: #00796b;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 137, 123, 0.35);
        }
        .login-note {
            margin-top: 20px;
            text-align: center;
            font-size: 12.5px;
            color: #64748b;
        }
        .login-link {
            color: #00897b;
            font-weight: 700;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
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
    <main class="container">
        <!-- Panel Kiri: Hero & Branding -->
        <aside class="panel-left">
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
                    Registrasi Petugas • Sarpras
                </div>
                <h1>
                    Bergabung Mengelola <span class="highlight">Sarpras Sekolah.</span>
                </h1>
                <p class="panel-left-desc">
                    Daftarkan akun petugas untuk memverifikasi permohonan peminjaman siswa, mengelola data ketersediaan alat di setiap lab & bengkel, serta menyusun laporan sarpras yang akurat.
                </p>

                <!-- Fitur Unggulan -->
                <div class="feature-list">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🛡️</div>
                        <div class="feature-text">
                            <strong>Otoritas Manajemen Terpusat</strong>
                            <p>Kelola sirkulasi sarpras di seluruh konsentrasi keahlian dan bengkel sekolah.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">⚡</div>
                        <div class="feature-text">
                            <strong>Validasi Cepat & Akurat</strong>
                            <p>Otorisasi permohonan siswa secara digital dengan catatan kondisi serah terima.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">📈</div>
                        <div class="feature-text">
                            <strong>Rekap & Laporan Terstruktur</strong>
                            <p>Akses data analitik penggunaan alat untuk kebutuhan audit dan pemeliharaan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Left -->
            <div class="footer-left">
                <span class="school-tag">SMK Negeri 5 Surakarta • Panel Petugas</span>
                <span class="status-badge">● Registrasi Petugas</span>
            </div>
        </aside>

        <!-- Panel Kanan: Form Pendaftaran Petugas -->
        <section class="panel-right">
            <div class="form-wrapper">
                <a href="{{ route('login.petugas') }}" class="back-link">‹ Kembali ke login petugas</a>

                <div class="card-form">
                    <h2>Daftar sebagai Petugas</h2>
                    <p class="intro">Lengkapi data berikut untuk mendaftar akun petugas SIMPATI.</p>

                    <form method="POST" action="{{ route('register.petugas.proses') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" autocomplete="name" maxlength="255" required autofocus>
                            @error('name') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Resmi Petugas</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="petugas@smkn5surakarta.id" class="form-control" autocomplete="email" maxlength="255" required>
                            @error('email') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" minlength="6" required>
                            <small style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;">Kata sandi minimal 6 karakter.</small>
                            @error('password') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" required>
                        </div>

                        <button type="submit" class="btn-submit">Daftar Akun Petugas</button>
                    </form>

                    <p class="login-note">
                        Sudah punya akun?
                        <a href="{{ route('login.petugas') }}" class="login-link">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
