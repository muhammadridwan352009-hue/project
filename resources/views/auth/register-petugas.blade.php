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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            color: #333;
            min-height: 100vh;
            display: flex;
        }

        .container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .panel-left {
            width: 45%;
            background-color: #071b26;
            color: #fff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
        }

        .badge-sub {
            background: rgba(217, 119, 6, 0.2);
            color: #f59e0b;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 16px;
        }

        .panel-left h1 {
            font-size: 28px;
            line-height: 1.3;
            margin-bottom: 16px;
            font-weight: bold;
        }

        .panel-left p {
            font-size: 13px;
            color: #a0aec0;
            line-height: 1.6;
        }

        .footer-left {
            font-size: 12px;
            color: #718096;
        }

        .panel-right {
            width: 55%;
            background-color: #f4f6f8;
            padding: 40px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .back-link {
            font-size: 12px;
            color: #718096;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 24px;
        }

        .back-link:hover {
            color: #1a202c;
        }

        .card-form {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .card-form h2 {
            font-size: 22px;
            color: #1a202c;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .intro {
            font-size: 12px;
            color: #718096;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            font-size: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.1);
        }

        .field-error {
            color: #c0392b;
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
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background-color: #00796b;
        }

        .btn-submit:focus-visible,
        .back-link:focus-visible,
        .login-link:focus-visible {
            outline: 3px solid rgba(0, 137, 123, 0.35);
            outline-offset: 3px;
        }

        .login-note {
            margin-top: 18px;
            text-align: center;
            font-size: 12px;
            color: #718096;
        }

        .login-link {
            color: #00897b;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .panel-left {
                display: none;
            }

            .panel-right {
                width: 100%;
                padding: 32px;
            }
        }

        @media (max-width: 480px) {
            .card-form {
                padding: 20px 16px;
            }

            .card-form h2 {
                font-size: 19px;
            }
        }
    </style>
</head>

<body>
    <main class="container">
        <aside class="panel-left">
            <div>
                <div class="brand">SIMPATI</div>
            </div>
            <div>
                <span class="badge-sub">AKSES-ADMIN • INVENTARIS</span>
                <h1>Kelola inventaris sekolah dari satu tempat.</h1>
                <p>Daftarkan akun petugas untuk mengelola alat, persetujuan peminjaman, dan laporan.</p>
            </div>
            <div class="footer-left">Portal Inovasi Sarpras &amp; Prasarana</div>
        </aside>

        <section class="panel-right">
            <div class="form-wrapper">
                <a href="{{ route('login.petugas') }}" class="back-link">‹ Kembali ke login petugas</a>

                <div class="card-form">
                    <h2>Daftar sebagai Petugas</h2>
                    <p class="intro">Isi data berikut untuk membuat akun petugas SIMPATI.</p>

                    <form method="POST" action="{{ route('register.petugas.proses') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" autocomplete="name" maxlength="255" required autofocus>
                            @error('name') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Petugas</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="email" maxlength="255" required>
                            @error('email') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" minlength="6" required>
                            <small style="font-size: 11px; color: #718096;">Kata sandi minimal 6 karakter.</small>
                            @error('password') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" required>
                        </div>

                        <button type="submit" class="btn-submit">Daftar</button>
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