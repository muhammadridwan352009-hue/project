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
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
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
            font-weight: 600;
            font-style: italic;
        }
        .typing-cursor {
            border-right: 2px solid currentColor;
            padding-right: 2px;
            animation: cursor-blink 0.75s steps(1) infinite;
        }
        @keyframes cursor-blink {
            50% { border-color: transparent; }
        }
        @media (prefers-reduced-motion: reduce) {
            .typing-cursor { animation: none; }
        }
        .panel-left p {
            font-size: 13px;
            color: #a0aec0;
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
            max-width: 420px;
        }
        .back-link {
            font-size: 12px;
            color: #718096;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 24px;
        }
        .back-link:hover { color: #1a202c; }
        .card-form {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .card-form h2 {
            font-size: 22px;
            color: #1a202c;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .card-form p {
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
            box-shadow: 0 0 0 3px rgba(0,137,123,0.1);
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
        }
        .form-row a { color: #00897b; text-decoration: none; }
        .form-row a:hover { text-decoration: underline; }
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
        @media (max-width: 900px) {
            .panel-left {
                padding: 40px 32px;
            }
            .panel-right {
                padding: 32px;
            }
        }
        @media (max-width: 680px) {
            .panel-left {
                display: none;
            }
            .panel-right {
                width: 100%;
                min-height: 100vh;
                padding: 28px 20px;
            }
            .card-form {
                padding: 26px 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Panel Kiri -->
        <div class="panel-left">
            <div>
                <div class="brand">SIMPATI</div>
            </div>
            <div>
                <span class="badge-sub">AKSES SISWA • SMK NEGERI 5 SURAKARTA</span>
                <h1 aria-label="Persiapan kegiatan lebih ringan saat semua alat jelas keberadaannya.">
                    <span id="login-quote" class="typing-cursor" aria-hidden="true">"Persiapan kegiatan lebih ringan saat semua alat jelas keberadaannya."</span>
                </h1>
            </div>
            <div class="footer-left">
                Portal Inventaris Sarpras & Prasarana
            </div>
        </div>

        <!-- Panel Kanan -->
        <div class="panel-right">
            <div class="form-wrapper">
                <a href="{{ url('/') }}" class="back-link">‹ Kembali pilih peran</a>

                <div class="card-form">
                    <h2>Masuk sebagai Siswa</h2>
                    <p>Gunakan akun sekolah untuk mulai meminjam alat.</p>

                    @if (session('status'))
                        <div role="status" style="color:#176b52; font-size:12px; margin-bottom:16px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.siswa.proses') }}">
                        @csrf

                        <div class="form-group">
                            <label for="login">NIS atau email sekolah</label>
                            <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Contoh: 33189 atau siswa@smkn5surakarta.id" class="form-control" required autofocus>
                            @error('login')
                                <div style="color:#c0392b; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                            <div style="font-size: 11px; color: #718096; margin-top: 6px;">
                                Akun demo: <strong>siswa@smkn5surakarta.id</strong> atau <strong>33189</strong> · sandi: <strong>password123</strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" id="nis" name="nis" value="{{ old('nis') }}" placeholder="Contoh: 33189" class="form-control">
                            @error('nis')
                                <div style="color:#c0392b; font-size:12px; margin-top:4px;">{{ $message }}</div>
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
                                <div id="tingkat-kelas-error" style="color:#c0392b; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
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
                                <div id="jurusan-error" style="color:#c0392b; font-size:12px; margin-top:4px;">{{ $message }}</div>
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

                        <button type="submit" class="btn-submit">🚀 Masuk ke SIMPATI</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <script>
        const quoteElement = document.getElementById('login-quote');
        const quote = quoteElement.textContent;
        const characters = [...quote];

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            let characterIndex = 0;
            let isDeleting = false;

            const typeQuote = () => {
                quoteElement.textContent = characters.slice(0, characterIndex).join('');

                if (!isDeleting && characterIndex === characters.length) {
                    isDeleting = true;
                    window.setTimeout(typeQuote, 1800);
                    return;
                }

                if (isDeleting && characterIndex === 0) {
                    isDeleting = false;
                    window.setTimeout(typeQuote, 500);
                    return;
                }

                characterIndex += isDeleting ? -1 : 1;
                window.setTimeout(typeQuote, isDeleting ? 35 : 70);
            };

            quoteElement.textContent = '';
            typeQuote();
        }
    </script>
</body>
</html>