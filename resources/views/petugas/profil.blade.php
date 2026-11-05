<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Petugas - SIMPATI</title>
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

        /* Sidebar Kiri - Ruang Petugas */
        aside {
            width: 260px;
            background-color: #071b26;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px;
            flex-shrink: 0;
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
            margin-bottom: 30px;
        }

        .menu-label {
            font-size: 11px;
            color: #8b9bb4;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #b0c4de;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 6px;
            transition: 0.2s;
        }

        nav a.active {
            background-color: #00897b;
            color: #fff;
            font-weight: 600;
        }

        nav a:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .sidebar-footer {
            font-size: 11px;
            color: #7a8b9e;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 16px;
        }

        .logout-form {
            margin-top: 12px;
        }

        .logout-button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 10px;
            color: #cfe3ea;
            background: none;
            border: 0;
            font: inherit;
            font-size: 13px;
            cursor: pointer;
        }

        .logout-button:hover {
            color: #fff;
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 30px 40px;
            overflow-y: auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        header .title-sub {
            font-size: 11px;
            color: #00897b;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        header h1 {
            font-size: 22px;
            color: #1a202c;
            font-weight: bold;
        }

        .user-badge {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 6px 14px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #2d3748;
        }

        .dot {
            width: 8px;
            height: 8px;
            background-color: #f59e0b;
            border-radius: 50%;
        }

        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
        }

        .breadcrumb a {
            color: #00897b;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Kartu profil */
        .profile-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .card h3 {
            font-size: 15px;
            color: #1a202c;
            margin-bottom: 4px;
        }

        .card .card-sub {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
        }

        .profile-identity {
            text-align: center;
        }

        .avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: #071b26;
            color: #fff;
            font-size: 36px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            position: relative;
            overflow: visible;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-actions {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn-foto {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-foto-primary {
            background: #00897b;
            color: #fff;
        }

        .btn-foto-primary:hover {
            background: #00796b;
        }

        .btn-foto-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-foto-danger:hover {
            background: #fecaca;
        }

        .btn-foto-upload {
            display: none;
        }

        .foto-error {
            color: #ef4444;
            font-size: 11px;
            margin-top: 8px;
        }

        .profile-name {
            font-size: 17px;
            font-weight: 700;
            color: #1a202c;
        }

        .profile-role {
            display: inline-block;
            background: #fef3c7;
            color: #b45309;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            margin-top: 6px;
        }

        .identity-list {
            margin-top: 22px;
            text-align: left;
            font-size: 13px;
            color: #4a5568;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .identity-list .row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 10px;
        }

        .identity-list .row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .identity-list .row span:first-child {
            color: #718096;
        }

        .identity-list .row span:last-child {
            font-weight: 600;
            color: #1a202c;
            text-align: right;
            word-break: break-all;
        }

        /* Form */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            background: #f8fafc;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #00897b;
            background: #fff;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: #00897b;
            color: #fff;
        }

        .btn-primary:hover {
            background: #00796b;
        }

        .alert-success {
            background: #d1fae5;
            color: #047857;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            gap: 8px;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            gap: 8px;
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        .error-text {
            font-size: 11px;
            color: #ef4444;
            margin-top: 4px;
        }

        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 20px 0;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #00897b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        @media (max-width: 900px) {
            .profile-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            aside {
                width: 190px;
                padding: 16px;
            }

            main {
                padding: 20px 16px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
    </style>
</head>

<body>

    <!-- Sidebar Kiri (Ruang Petugas) -->
    @include('petugas.partials.sidebar', ['active' => 'profil'])


    <!-- Main Area -->
    <main>
        <header>
            <div style="display: flex; align-items: center; gap: 12px;">
            <button type="button" class="header-sidebar-toggle-btn" onclick="toggleSidebar()" title="Sembunyikan / Tampilkan Sidebar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <div>
                <div class="title-sub">SISTEM INVENTARIS SEKOLAH</div>
                <h1>Profil petugas</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ $user->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">
            <a href="/petugas/dashboard">Dashboard</a> / <strong>Profil saya</strong>
        </div>

        @if(session('success'))
        <div class="alert-success"><span>✅</span> {{ session('success') }}</div>
        @endif

        <div class="profile-layout">
            <!-- Kartu identitas -->
            <div class="card profile-identity">
                <div class="avatar">
                    @if($user->foto && file_exists(storage_path('app/public/' . $user->foto)))
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto {{ $user->name }}">
                    @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>

                @error('foto')
                <div class="foto-error">{{ $message }}</div>
                @enderror

                <div class="avatar-actions">
                    <form method="POST" action="{{ route('petugas.profil.foto') }}" enctype="multipart/form-data" id="form-foto-profil">
                        @csrf
                        <input type="file" name="foto" id="input-foto-profil" accept="image/*" class="btn-foto-upload" onchange="document.getElementById('form-foto-profil').submit();">
                        <label for="input-foto-profil" class="btn-foto btn-foto-primary">📷 {{ $user->foto ? 'Ganti foto' : 'Tambah foto' }}</label>
                    </form>
                    @if($user->foto)
                    <form method="POST" action="{{ route('petugas.profil.foto.hapus') }}" onsubmit="return confirm('Hapus foto profil?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-foto btn-foto-danger">🗑️ Hapus foto</button>
                    </form>
                    @endif
                </div>

                <div class="profile-name">{{ $user->name }}</div>
                <span class="profile-role">🛠️ Petugas Sarpras</span>

                <div class="identity-list">
                    <div class="row">
                        <span>Email</span>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="row">
                        <span>Divisi</span>
                        <span>Sarana &amp; Prasarana</span>
                    </div>
                    <div class="row">
                        <span>Unit kerja</span>
                        <span>SMK Negeri 5 Surakarta</span>
                    </div>
                    <div class="row">
                        <span>Anggota sejak</span>
                        <span>{{ $user->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Form edit profil -->
            <div class="card">
                <h3>Edit informasi profil</h3>
                <p class="card-sub">Perbarui data akun dan kata sandi kamu.</p>

                @if($errors->any())
                <div class="alert-error"><span>⚠️</span> Terdapat kesalahan pada form, silakan periksa kembali.</div>
                @endif

                <form method="POST" action="{{ route('petugas.profil.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="{{ $errors->has('name') ? 'input-error' : '' }}" required>
                            @error('name')<div class="error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="{{ $errors->has('email') ? 'input-error' : '' }}" required>
                            @error('email')<div class="error-text">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="divider">

                    <div class="section-title">Ganti kata sandi</div>
                    <p class="card-sub">Kosongkan bagian ini jika tidak ingin mengganti kata sandi.</p>

                    <div class="form-group">
                        <label for="password_lama">Kata sandi lama</label>
                        <input type="password" id="password_lama" name="password_lama"
                            class="{{ $errors->has('password_lama') ? 'input-error' : '' }}"
                            placeholder="Masukkan kata sandi saat ini">
                        @error('password_lama')<div class="error-text">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Kata sandi baru</label>
                            <input type="password" id="password" name="password"
                                class="{{ $errors->has('password') ? 'input-error' : '' }}"
                                placeholder="Minimal 6 karakter">
                            @error('password')<div class="error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi kata sandi baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi kata sandi baru">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 Simpan perubahan</button>
                </form>
            </div>
        </div>
    </main>
    

</body>

</html>