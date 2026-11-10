<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - SIMPATI</title>
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

        /* ===== PANEL KANAN (FORM DAFTAR SISWA) ===== */
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
            max-width: 460px;
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
        small {
            display: block;
            font-size: 11px;
            color: #64748b;
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
                min-height: 100vh;
            }
            .panel-left {
                width: 100%;
                padding: 36px 28px;
            }
            .feature-list {
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
                    Registrasi Siswa • SMK Negeri 5 Surakarta
                </div>
                <h1>
                    Mulai Gunakan Layanan Sarpras <span class="highlight">dengan Akun Siswa.</span>
                </h1>
                <p class="panel-left-desc">
                    Daftarkan akun resmimu untuk mempermudah permohonan peminjaman alat kejuruan, cek ketersediaan peralatan lab & bengkel, serta pantau riwayat sarpras sekolah.
                </p>

                <!-- Fitur Unggulan -->
                <div class="feature-list">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🎓</div>
                        <div class="feature-text">
                            <strong>Akun Resmi & Terintegrasi</strong>
                            <p>Terhubung langsung dengan data NIS dan jurusan kejuruan Anda di sekolah.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">⚡</div>
                        <div class="feature-text">
                            <strong>Akses Peminjaman Mandiri</strong>
                            <p>Ajukan alat praktik kapan pun tanpa birokrasi manual dan kertas antrean.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">🔒</div>
                        <div class="feature-text">
                            <strong>Data Aman & Transparan</strong>
                            <p>Seluruh riwayat peminjaman dan bukti serah terima tercatat rapi secara digital.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Left -->
            <div class="footer-left">
                <span class="school-tag">SMK Negeri 5 Surakarta • Registrasi Siswa</span>
                <span class="status-badge">● Sistem Terbuka</span>
            </div>
        </aside>

        <!-- Panel Kanan: Form Pendaftaran Siswa -->
        <section class="panel-right">
            <div class="form-wrapper">
                <a href="{{ route('login') }}" class="back-link">‹ Kembali ke login</a>

                <div class="card-form">
                    <h2>Daftar sebagai Siswa</h2>
                    <p class="intro">Lengkapi data diri berikut untuk membuat akun SIMPATI.</p>

                    <form method="POST" action="{{ route('register.siswa.proses') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" autocomplete="name" maxlength="255" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" @if ($errors->has('name')) aria-describedby="name-error" @endif required autofocus>
                            @error('name') <div id="name-error" class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="nis">NIS (Nomor Induk Siswa)</label>
                            <input type="text" id="nis" name="nis" value="{{ old('nis') }}" class="form-control" inputmode="numeric" pattern="[0-9]{5,20}" minlength="5" maxlength="20" autocomplete="off" aria-describedby="nis-hint @if ($errors->has('nis')) nis-error @endif" aria-invalid="{{ $errors->has('nis') ? 'true' : 'false' }}" required>
                            <small id="nis-hint">Masukkan minimal 5 digit angka NIS Anda.</small>
                            @error('nis') <div id="nis-error" class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="tingkat_kelas">Tingkat Kelas</label>
                            <select id="tingkat_kelas" name="tingkat_kelas" class="form-control" aria-invalid="{{ $errors->has('tingkat_kelas') ? 'true' : 'false' }}" @if ($errors->has('tingkat_kelas')) aria-describedby="tingkat-kelas-error" @endif required>
                                <option value="">Pilih tingkat kelas</option>
                                @foreach (['X', 'XI', 'XII'] as $tingkat)
                                    <option value="{{ $tingkat }}" @selected(old('tingkat_kelas') === $tingkat)>{{ $tingkat }}</option>
                                @endforeach
                            </select>
                            @error('tingkat_kelas') <div id="tingkat-kelas-error" class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan Kejuruan</label>
                            <select id="jurusan" name="jurusan" class="form-control" aria-invalid="{{ $errors->has('jurusan') ? 'true' : 'false' }}" @if ($errors->has('jurusan')) aria-describedby="jurusan-error" @endif required>
                                <option value="">Pilih jurusan</option>
                                @foreach ([
                                    'DPIB' => '(DPIB) Desain Pemodelan dan Informasi Bangunan',
                                    'BKP' => '(BKP) Bisnis Konstruksi dan Properti',
                                    'TOI' => '(TOI) Teknik Otomasi Industri',
                                    'TITL' => '(TITL) Teknik Instalasi Tenaga Listrik',
                                    'TEI' => '(TEI) Teknik Elektronika Industri',
                                    'TP' => '(TP) Teknik Pemesinan',
                                    'TKRO' => '(TKRO) Teknik Kendaraan Ringan Otomotif',
                                    'TBSM' => '(TBSM) Teknik dan Bisnis Sepeda Motor',
                                    'RPL' => '(RPL) Rekayasa Perangkat Lunak',
                                ] as $kode => $nama)
                                    <option value="{{ $kode }}" @selected(old('jurusan') === $kode)>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('jurusan') <div id="jurusan-error" class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Sekolah</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="siswa@smkn5surakarta.id" class="form-control" autocomplete="email" maxlength="255" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" @if ($errors->has('email')) aria-describedby="email-error" @endif required>
                            @error('email') <div id="email-error" class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" minlength="6" aria-describedby="password-hint @if ($errors->has('password')) password-error @endif" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" required>
                            <small id="password-hint">Kata sandi minimal 6 karakter.</small>
                            @error('password') <div id="password-error" class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" @if ($errors->has('password')) aria-describedby="password-error" @endif required>
                        </div>

                        <button type="submit" class="btn-submit">Daftar Akun Siswa</button>
                    </form>

                    <p class="login-note">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="login-link">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
