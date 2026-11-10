<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - SIMPATI</title>
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

        /* ===== PANEL KANAN (FORM LOGIN SISWA) ===== */
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 20px;
        }
        .form-row a {
            color: #00897b;
            text-decoration: none;
            font-weight: 600;
        }
        .form-row a:hover {
            text-decoration: underline;
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
        .register-box {
            margin-top: 18px;
            text-align: center;
            font-size: 12.5px;
            color: #64748b;
        }
        .register-box a {
            color: #00897b;
            font-weight: 700;
            text-decoration: none;
        }
        .register-box a:hover {
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
                    Akses Siswa • Sarpras Praktik
                </div>
                <h1>
                    Siapkan Alat Praktik Lebih Cepat, <span class="highlight">Selalu Siap Pakai.</span>
                </h1>
                <p class="panel-left-desc">
                    Temukan peralatan kejuruan yang kamu butuhkan, ajukan permohonan pinjam secara mandiri, dan pantau status persetujuan tanpa perlu mondar-mandir ke ruang sarpras.
                </p>

                <!-- Fitur Unggulan Siswa -->
                <div class="feature-list">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">📦</div>
                        <div class="feature-text">
                            <strong>Katalog Alat Kejuruan Terbuka</strong>
                            <p>Cek ketersediaan kamera, proyektor, peralatan lab, hingga instrumen bengkel secara real-time.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">⚡</div>
                        <div class="feature-text">
                            <strong>Pengajuan Izin Sekali Klik</strong>
                            <p>Ajukan permohonan peminjaman langsung dari smartphone tanpa formulir kertas yang rumit.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrap">⏰</div>
                        <div class="feature-text">
                            <strong>Notifikasi & Jadwal Pengembalian</strong>
                            <p>Pantau tenggat waktu pengembalian agar rekam jejak peminjamanmu tetap tertib dan aman.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Left -->
            <div class="footer-left">
                <span class="school-tag">SMK Negeri 5 Surakarta • Portal Siswa</span>
                <span class="status-badge">● Layanan Aktif</span>
            </div>
        </div>

        <!-- Panel Kanan: Form Login Siswa -->
        <div class="panel-right">
            <div class="form-wrapper">
                <a href="{{ url('/') }}" class="back-link">‹ Kembali pilih peran</a>

                <div class="card-form">
                    <h2>Masuk sebagai Siswa</h2>
                    <p class="intro-desc">Gunakan akun sekolah untuk mulai meminjam alat praktik.</p>

                    @if (session('status'))
                        <div role="status" style="color:#0f766e; background:#f0fdfa; border:1px solid #ccfbf1; padding:12px 16px; border-radius:10px; font-size:13px; line-height: 1.5; margin-bottom:18px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div role="alert" style="color:#b91c1c; background:#fef2f2; border:1px solid #fecaca; padding:12px 16px; border-radius:10px; font-size:13px; line-height: 1.5; margin-bottom:18px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.siswa.proses') }}">
                        @csrf

                        <div class="form-group">
                            <label for="login">NIS atau email sekolah</label>
                            <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Contoh: 33189 atau siswa@smkn5surakarta.id" class="form-control" required autofocus>
                            @error('login')
                                <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                            <div style="font-size: 11px; color: #64748b; margin-top: 6px;">
                                Akun demo: <strong>siswa@smkn5surakarta.id</strong> atau <strong>33189</strong> · sandi: <strong>password123</strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nis">NIS (Nomor Induk Siswa)</label>
                            <input type="text" id="nis" name="nis" value="{{ old('nis') }}" placeholder="Contoh: 33189" class="form-control">
                            @error('nis')
                                <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tingkat_kelas">Tingkat Kelas</label>
                            <select id="tingkat_kelas" name="tingkat_kelas" class="form-control" aria-invalid="{{ $errors->has('tingkat_kelas') ? 'true' : 'false' }}" @if ($errors->has('tingkat_kelas')) aria-describedby="tingkat-kelas-error" @endif>
                                <option value="">Pilih tingkat kelas</option>
                                @foreach (['X', 'XI', 'XII'] as $tingkat)
                                    <option value="{{ $tingkat }}" @selected(old('tingkat_kelas') === $tingkat)>{{ $tingkat }}</option>
                                @endforeach
                            </select>
                            @error('tingkat_kelas')
                                <div id="tingkat-kelas-error" style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan Kejuruan</label>
                            <select id="jurusan" name="jurusan" class="form-control" aria-invalid="{{ $errors->has('jurusan') ? 'true' : 'false' }}" @if ($errors->has('jurusan')) aria-describedby="jurusan-error" @endif>
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
                            @error('jurusan')
                                <div id="jurusan-error" style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Kata sandi</label>
                            <input type="password" id="password" name="password" placeholder="••••••••••••••" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                <input type="checkbox" name="remember" style="accent-color: #00897b;"> Ingat saya
                            </label>
                            <a href="#">Lupa kata sandi?</a>
                        </div>

                        <button type="submit" class="btn-submit">
                            <span>🚀</span> Masuk ke SIMPATI
                        </button>
                    </form>

                    <div style="margin-top: 22px; padding-top: 18px; border-top: 1px solid #e2e8f0; text-align: center; font-size: 13px; color: #64748b;">
                        Belum memiliki akun siswa?
                        <a href="{{ route('register.siswa') }}" style="color: #00897b; font-weight: 700; text-decoration: none; margin-left: 4px;">Daftar Akun Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
