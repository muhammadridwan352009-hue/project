<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang - SIMPATI</title>
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

        /* Title Section */
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .title-section h2 {
            font-size: 22px;
            color: #071b26;
            font-weight: 800;
        }

        .title-section p {
            font-size: 12px;
            color: #718096;
            margin-top: 2px;
        }

        .btn-back {
            background-color: #fff;
            color: #2d3748;
            border: 1px solid #cbd5e1;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }

        .btn-back:hover {
            background-color: #f1f5f9;
        }

        /* Form Card */
        .form-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 24px;
            align-items: start;
        }

        .card-panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .panel-header {
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f1f5f9;
        }

        .panel-header h3 {
            font-size: 15px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .panel-header p {
            font-size: 12px;
            color: #718096;
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

        .form-group label .required {
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            font-size: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            background: #fff;
            transition: 0.2s;
            color: #1a202c;
        }

        .form-control:focus {
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.1);
        }

        .form-control.input-error {
            border-color: #ef4444;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        select.form-control {
            cursor: pointer;
        }

        .error-text {
            color: #ef4444;
            font-size: 11px;
            margin-top: 4px;
        }

        .hint {
            font-size: 11px;
            color: #94a3b8;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background-color: #00796b;
        }

        /* Preview foto */
        .foto-drop {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
            background: #f8fafc;
        }

        .foto-drop:hover {
            border-color: #00897b;
            background: #f0fdfc;
        }

        .foto-drop .icon {
            font-size: 32px;
            margin-bottom: 6px;
        }

        .foto-drop .label {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
        }

        .foto-drop .sub {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 2px;
        }

        #foto_preview {
            display: none;
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-top: 12px;
            border: 1px solid #e2e8f0;
        }

        /* Info card */
        .info-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
        }

        .info-card h4 {
            font-size: 13px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .info-list {
            list-style: none;
            font-size: 12px;
            color: #64748b;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .info-list li {
            display: flex;
            gap: 8px;
            align-items: flex-start;
            line-height: 1.5;
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

        @media (max-width: 900px) {
            .form-layout {
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

            .title-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
        
    </style>
</head>

<body>

    <!-- Sidebar Kiri (Ruang Petugas) -->
    @include('petugas.partials.sidebar', ['active' => 'inventaris'])


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
                <h1>Tambah data barang</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">
            <a href="/petugas/dashboard">Dashboard</a> /
            <a href="{{ route('petugas.inventaris.index') }}">Inventaris</a> /
            <strong>Tambah barang</strong>
        </div>

        <div class="title-section">
            <div>
                <h2>Tambah data barang baru</h2>
                <p>Daftarkan alat atau benda baru ke dalam sistem inventaris sekolah.</p>
            </div>
            <a href="{{ route('petugas.inventaris.index') }}" class="btn-back">‹ Kembali ke daftar inventaris</a>
        </div>

        @if(session('success'))
        <div class="alert-success"><span>✅</span> {{ session('success') }}</div>
        @endif

        <div class="form-layout">

            <!-- Form Utama -->
            <div class="card-panel">
                <div class="panel-header">
                    <h3>Detail barang</h3>
                    <p>Lengkapi seluruh kolom di bawah ini. Kolom bertanda <span style="color:#ef4444;">*</span> wajib diisi.</p>
                </div>

                <form action="{{ route('petugas.inventaris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category_id">Kategori Barang: <span class="required">*</span></label>
                        <select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? 'input-error' : '' }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_barang">Kode Barang: <span class="required">*</span></label>
                        <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang') }}"
                            placeholder="Contoh: ALAT-001" class="form-control {{ $errors->has('kode_barang') ? 'input-error' : '' }}" required>
                        @error('kode_barang')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang: <span class="required">*</span></label>
                        <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}"
                            placeholder="Contoh: Kamera Sony A6000" class="form-control {{ $errors->has('nama_barang') ? 'input-error' : '' }}" required>
                        @error('nama_barang')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok: <span class="required">*</span></label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok') }}" min="0"
                            placeholder="Contoh: 5" class="form-control {{ $errors->has('stok') ? 'input-error' : '' }}" required>
                        @error('stok')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kondisi">Kondisi: <span class="required">*</span></label>
                        <select name="kondisi" id="kondisi" class="form-control {{ $errors->has('kondisi') ? 'input-error' : '' }}" required>
                            <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                        @error('kondisi')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Barang</label>
                        <label for="foto" class="foto-drop">
                            <div class="icon">📷</div>
                            <div class="label">Klik untuk memilih foto barang</div>
                            <div class="sub">Format: JPG, PNG, WEBP • Maksimal 2 MB</div>
                        </label>
                        <input type="file" name="foto" id="foto" accept="image/*" class="form-control" style="display:none;">
                        <img src="#" id="foto_preview" alt="Preview foto barang">
                        <div class="hint">Foto bersifat opsional, namun sangat disarankan agar siswa mudah mengenali alat.</div>
                        @error('foto')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">💾 Simpan Data</button>
                </form>
            </div>

            <!-- Panel Info Kanan -->
            <div class="info-card">
                <h4>📌 Panduan pengisian</h4>
                <ul class="info-list">
                    <li><span>🏷️</span><span><strong>Kode barang</strong> harus unik — tidak boleh sama dengan barang yang sudah terdaftar.</span></li>
                    <li><span>🔢</span><span><strong>Stok</strong> diisi jumlah unit yang tersedia, minimal 0.</span></li>
                    <li><span>🩺</span><span><strong>Kondisi</strong> diisi berdasarkan pemeriksaan terakhir alat.</span></li>
                    <li><span>📷</span><span><strong>Foto</strong> akan muncul di katalog yang dilihat siswa saat meminjam.</span></li>
                    <li><span>✅</span><span>Setelah disimpan, barang langsung muncul di daftar inventaris.</span></li>
                </ul>
            </div>

        </div>
    </main>

    <script>
        // Preview foto sebelum disimpan
        const fotoInput = document.getElementById('foto');
        const fotoPreview = document.getElementById('foto_preview');

        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fotoPreview.src = e.target.result;
                    fotoPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                fotoPreview.src = '#';
                fotoPreview.style.display = 'none';
            }
        });
    </script>
    

</body>

</html>