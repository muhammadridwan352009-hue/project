<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - SIMPATI</title>
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

        main {
            flex: 1;
            padding: 30px 40px;
            overflow-y: auto;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .title-sub {
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        header h1 {
            font-size: 24px;
            color: #071b26;
            font-weight: 800;
        }

        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 32px;
            width: 100%;
            max-width: 580px;
            height: fit-content;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        h2 {
            font-size: 20px;
            color: #071b26;
            font-weight: 800;
            margin-bottom: 4px;
        }

        p.sub {
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
        }

        .form-control:focus {
            border-color: #00897b;
        }

        .error {
            border-color: #ef4444;
        }

        .error-msg {
            color: #dc2626;
            font-size: 11px;
            margin-top: 4px;
        }

        .btn-row {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #00897b;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #00796b;
        }

        .btn-secondary {
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 16px;
        }

        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            .card { padding: 20px 16px; max-width: 100%; }
            header h1 { font-size: 20px; }
            .btn-row { flex-wrap: wrap; }
            .btn { flex: 1; min-width: 140px; }
        }
    </style>
</head>

<body>
    <!-- Sidebar Kiri (Ruang Petugas) -->
    @include('petugas.partials.sidebar', ['active' => 'inventaris'])

    <!-- Main Content -->
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
                    <h1>Edit data barang</h1>
                </div>
            </div>
        </header>

        <div class="card">
            <h2>Edit Barang Inventaris</h2>
            <p class="sub">Perbarui data barang <strong>{{ $item->kode_barang ?? '-' }}</strong></p>

            @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('petugas.inventaris.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih kategori --</option>
                        @foreach ($categories as $c)
                        <option value="{{ $c->id }}" {{ $item->category_id == $c->id ? 'selected' : '' }}>{{ $c->nama }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Kode barang</label>
                    <input type="text" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang) }}" class="form-control" required>
                    @error('kode_barang') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Nama barang</label>
                    <input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" class="form-control" required>
                    @error('nama_barang') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $item->stok) }}" min="0" class="form-control" required>
                    @error('stok') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Kondisi</label>
                    <select name="kondisi" class="form-control" required>
                        @foreach (['baik', 'rusak_ringan', 'rusak_berat'] as $k)
                        <option value="{{ $k }}" {{ $item->kondisi == $k ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $k)) }}</option>
                        @endforeach
                    </select>
                    @error('kondisi') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                    <a href="{{ route('petugas.inventaris.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
