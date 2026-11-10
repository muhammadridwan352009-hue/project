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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            color: #333;
            display: flex;
            min-height: 100vh;
        }

        main {
            flex: 1;
            padding: 32px 40px;
            min-width: 0;
        }

        .page-title {
            font-size: 22px;
            color: #1a202c;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .page-sub {
            font-size: 12px;
            color: #718096;
            margin-bottom: 24px;
        }

        .card-form {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            max-width: 620px;
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

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .form-group {
            flex: 1;
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

        .hint {
            font-size: 11px;
            color: #718096;
            margin-top: 4px;
        }

        .btn-submit {
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background-color: #00796b;
        }

        .status-msg {
            background: #d1fae5;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #a7f3d0;
        }

        @media (max-width: 900px) {
            main {
                padding: 24px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    @include('petugas.partials.sidebar', ['active' => 'persetujuan-siswa'])

    <main>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h1 class="page-title">Tambah Akun Siswa Resmi</h1>
                <p class="page-sub">Buat akun siswa langsung dari ruang petugas dengan status otomatis aktif/disetujui.</p>
            </div>
            <a href="{{ route('petugas.persetujuan-siswa') }}" style="color: #64748b; font-size: 13px; font-weight: 600; text-decoration: none; padding: 8px 14px; background: #fff; border: 1px solid #cbd5e1; border-radius: 8px;">
                ‹ Kembali ke Persetujuan Akun
            </a>
        </div>

        @if (session('status'))
        <div class="status-msg">{{ session('status') }}</div>
        @endif

        <div class="card-form">
            <form method="POST" action="{{ route('petugas.daftar-siswa.proses') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" autocomplete="name" maxlength="255" required>
                    @error('name') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" id="nis" name="nis" value="{{ old('nis') }}" class="form-control" inputmode="numeric" pattern="[0-9]{5,20}" minlength="5" maxlength="20" autocomplete="off" required>
                        <div class="hint">Minimal 5 digit angka.</div>
                        @error('nis') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="tingkat_kelas">Tingkat Kelas</label>
                        <select id="tingkat_kelas" name="tingkat_kelas" class="form-control" required>
                            <option value="">Pilih tingkat kelas</option>
                            @foreach (['X', 'XI', 'XII'] as $tingkat)
                            <option value="{{ $tingkat }}" @selected(old('tingkat_kelas')===$tingkat)>{{ $tingkat }}</option>
                            @endforeach
                        </select>
                        @error('tingkat_kelas') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select id="jurusan" name="jurusan" class="form-control" required>
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
                            <option value="{{ $kode }}" @selected(old('jurusan')===$kode)>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('jurusan') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Sekolah</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="email" maxlength="255" required>
                    @error('email') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" minlength="6" required>
                        <div class="hint">Kata sandi minimal 6 karakter.</div>
                        @error('password') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Simpan Akun Siswa</button>
            </form>
        </div>
    </main>
</body>

</html>