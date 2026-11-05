<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas - SIMPATI</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f6f8; color: #333; min-height: 100vh; display: flex; }
        .container { display: flex; width: 100%; min-height: 100vh; }
        .panel-left { width: 45%; background-color: #071b26; color: #fff; padding: 60px; display: flex; flex-direction: column; justify-content: space-between; }
        .brand { font-size: 20px; font-weight: 800; letter-spacing: 1px; background: #fff; color: #071b26; padding: 8px 12px; border-radius: 8px; display: inline-block; }
        .badge-sub { background: rgba(217, 119, 6, 0.2); color: #f59e0b; font-size: 11px; padding: 4px 10px; border-radius: 6px; font-weight: 600; display: inline-block; margin-bottom: 16px; }
        .panel-left h1 { font-size: 28px; line-height: 1.3; margin-bottom: 16px; font-weight: bold; }
        .panel-left p { font-size: 13px; color: #a0aec0; line-height: 1.6; margin-bottom: 24px; }
        .stats-box { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 20px; }
        .stat-item strong { display: block; font-size: 20px; color: #fff; font-weight: bold; }
        .stat-item span { font-size: 11px; color: #a0aec0; }
        .footer-left { font-size: 12px; color: #718096; margin-top: 40px; }
        .panel-right { width: 55%; background-color: #f4f6f8; padding: 40px 60px; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .form-wrapper { width: 100%; max-width: 420px; }
        .back-link { font-size: 12px; color: #718096; text-decoration: none; display: inline-block; margin-bottom: 24px; }
        .card-form { background: #fff; border: 1px solid #e2e8f0; padding: 32px; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .restricted-badge { font-size: 10px; background: #fef3c7; color: #92400e; padding: 3px 8px; border-radius: 4px; font-weight: bold; text-transform: uppercase; display: inline-block; }
        .card-form h2 { font-size: 22px; color: #1a202c; margin: 10px 0 4px 0; font-weight: bold; }
        .card-form p { font-size: 12px; color: #718096; margin-bottom: 24px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #4a5568; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 12px 14px; font-size: 13px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; }
        .form-control:focus { border-color: #00897b; }
        .form-row { font-size: 12px; color: #718096; margin-bottom: 20px; }
        .btn-submit { width: 100%; background-color: #00897b; color: #fff; border: none; padding: 12px; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; }
        .btn-submit:hover { background-color: #00796b; }
        .warning-box { margin-top: 16px; background-color: #fffbeb; border: 1px solid #fde68a; padding: 10px 12px; border-radius: 8px; font-size: 11px; color: #92400e; display: flex; align-items: center; gap: 8px; }
        .error-msg { background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; font-size: 12px; margin-bottom: 16px; }

        @media (max-width: 900px) {
            .panel-left { display: none; }
            .panel-right { width: 100%; padding: 24px 16px; }
        }
        @media (max-width: 480px) {
            .card-form { padding: 20px 16px; }
            .card-form h2 { font-size: 19px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="panel-left">
            <div><div class="brand">SIMPATI</div></div>
            <div>
                <span class="badge-sub">AKSES-ADMIN • INVENTARIS</span>
                <h1>Kendali inventaris yang akurat, setiap hari.</h1>
                <p>Proses pemeliharaan, cek kondisi, dan juga saat sekolah tetap siap untuk kegiatan berikutnya.</p>
                <div class="stats-box">
                    <div class="stat-item"><strong>284</strong><span>Unit</span></div>
                    <div class="stat-item"><strong>8</strong><span>Permintaan</span></div>
                    <div class="stat-item"><strong>96%</strong><span>Siap</span></div>
                </div>
            </div>
            <div class="footer-left">Portal Inovasi Sarpras & Prasarana</div>
        </div>

        <div class="panel-right">
            <div class="form-wrapper">
                <a href="{{ url('/') }}" class="back-link">‹ Kembali pilih peran</a>

                <div class="card-form">
                    <span class="restricted-badge">Akses Terbatas</span>
                    <h2>Masuk sebagai Petugas</h2>
                    <p>Khusus petugas korporasi dan pembina yang terdaftar.</p>

                    {{-- Tampilkan error jika login gagal --}}
                    @if ($errors->has('login'))
                        <div class="error-msg">
                            {{ $errors->first('login') }}
                        </div>
                    @endif

                    <form action="{{ route('login.petugas.proses') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="login">ID petugas atau email</label>
                            <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Contoh: PTO-006 atau petugas@smkn5surakarta.id" class="form-control" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Kata sandi</label>
                            <input type="password" id="password" name="password" placeholder="••••••••••••••" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                <input type="checkbox" name="remember" style="accent-color: #00897b;"> Tetap masuk di perangkat ini
                            </label>
                        </div>

                        <button type="submit" class="btn-submit">✓ Masuk ke ruang petugas</button>
                    </form>

                    <div class="warning-box">
                        <span>⚠️</span>
                        <span>Belum punya akun petugas? Hubungi tim sarpras sekolah tingkat pusat.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>