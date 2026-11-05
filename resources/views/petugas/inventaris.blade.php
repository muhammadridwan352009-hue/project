<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Inventaris - SIMPATI</title>
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
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 16px;
        }
        .logout-form { margin-top: 12px; }
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
        .logout-button:hover { color: #fff; }
        


        /* Main Area */
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

        /* Title & Action Section */
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
            font-size: 13px;
            color: #718096;
            margin-top: 2px;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .btn-secondary {
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #334155;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }
        .btn-secondary:hover { background: #f8fafc; }
        .btn-primary {
            background-color: #00897b;
            color: #fff;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }
        .btn-primary:hover { background-color: #00796b; }

        /* Filter Bar */
        .filter-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .search-box {
            flex: 1;
            display: flex;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 14px;
            gap: 8px;
        }
        .search-box input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            font-size: 13px;
            color: #333;
        }
        .select-filter {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            color: #475569;
            outline: none;
            cursor: pointer;
        }

        /* Table Container */
        .table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        thead {
            background-color: #071b26;
            color: #fff;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        th, td {
            padding: 16px 20px;
            vertical-align: middle;
        }
        tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: 0.2s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background-color: #f8fafc; }

        /* Table Components */
        .item-details strong {
            display: block;
            font-size: 13px;
            color: #071b26;
            margin-bottom: 4px;
        }
        .badge-code {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 9px;
            font-weight: bold;
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 2px 6px;
            border-radius: 4px;
            color: #334155;
        }
        .badge-code .cat { color: #7c3aed; }
        .badge-code .cat.band { color: #ea580c; }
        .badge-code .cat.osis { color: #0284c7; }
        .badge-code .cat.rohis { color: #059669; }

        .stock-text {
            font-size: 13px;
            font-weight: bold;
            color: #1e293b;
        }

        .status-pill {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .status-pill.baik { background-color: #d1fae5; color: #059669; }
        .status-pill.cek { background-color: #fef3c7; color: #d97706; }
        .status-pill.dipakai { background-color: #ffedd5; color: #ea580c; }

        .location-text {
            font-size: 12px;
            color: #64748b;
        }

        .action-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }
        .btn-edit {
            background: none;
            border: none;
            font-size: 12px;
            color: #64748b;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }
        .btn-edit:hover { color: #00897b; }
        .btn-delete {
            background: none;
            border: none;
            font-size: 12px;
            color: #64748b;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-delete:hover { color: #dc2626; }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .alert-empty {
            background: #fff;
            border: 1px dashed #cbd5e1;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            color: #718096;
            font-size: 13px;
        }
        .more-opt {
            font-size: 14px;
            color: #94a3b8;
            cursor: pointer;
            border: none;
            background: none;
        }

        /* Footer Pagination */
        .table-footer {
            padding: 16px 20px;
            background-color: #fff;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #64748b;
        }
        .pagination {
            display: flex;
            gap: 6px;
            align-items: center;
        }
        .page-link {
            padding: 4px 8px;
            border-radius: 6px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
        }
        .page-link.active {
            background-color: #071b26;
            color: #fff;
        }

        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .title-section { flex-direction: column; align-items: flex-start; gap: 12px; }
            .title-section h2 { font-size: 18px; }
            .filter-card { flex-direction: column; }
            .search-box input { font-size: 16px; }
            .table-card { overflow-x: auto; }
            table { min-width: 640px; }
            th, td { padding: 12px 12px; }
            .table-footer { flex-direction: column; gap: 8px; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('petugas.partials.sidebar', ['active' => 'inventaris'])


    <!-- Konten Utama -->
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
                <h1>Manajemen inventaris</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>Rizky Maulana</span>
            </div>
        </header>

        <div class="breadcrumb">Dashboard / <strong>Inventaris</strong></div>

        <div class="title-section">
            <div>
                <h2>Manajemen inventaris</h2>
                <p>Kelola {{ $items->count() }} unit alat dari seluruh organisasi siswa.</p>
            </div>
            <div class="action-buttons">
                <a href="{{ route('petugas.inventaris.create') }}" class="btn-primary">
                    <span>+</span> Tambah alat
                </a>
            </div>
        </div>

        @if (session('success'))
        <div class="alert-success">✔️ {{ session('success') }}</div>
        @endif

        <!-- Filter Search Bar -->
        <div class="filter-card">
            <div class="search-box">
                <span>🔍</span>
                <input type="text" id="searchInput" placeholder="Cari nama atau kode inventaris...">
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th style="width: 40px; padding-left: 20px;">
                            <input type="checkbox" style="accent-color: #00897b;">
                        </th>
                        <th>Inventaris</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                        <th style="text-align: right; padding-right: 20px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    @php
                        $kategoriKey = strtolower(optional($item->category)->nama_kategori ?? '');
                        $catClass = match(true) {
                            str_contains($kategoriKey, 'multimedia') || str_contains($kategoriKey, 'multi') => '',
                            str_contains($kategoriKey, 'band') => 'band',
                            str_contains($kategoriKey, 'osis') => 'osis',
                            str_contains($kategoriKey, 'rohis') => 'rohis',
                            default => '',
                        };
                    @endphp
                    <tr>
                        <td style="padding-left: 20px;">
                            <input type="checkbox" style="accent-color: #00897b;">
                        </td>
                        <td>
                            <div class="item-details">
                                <div style="display:flex; align-items:center; gap:10px;">
                                    @if($item->foto && file_exists(storage_path('app/public/' . $item->foto)))
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama_barang }}"
                                        style="width:42px; height:42px; object-fit:cover; border-radius:8px; border:1px solid #e2e8f0; flex-shrink:0;">
                                    @else
                                    <div style="width:42px; height:42px; border-radius:8px; border:1px solid #e2e8f0; background:#f1f5f9; color:#94a3b8; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                                    @endif
                                    <div>
                                        <strong>{{ $item->nama_barang }}</strong>
                                        <div class="badge-code">
                                            <span>{{ $item->kode_barang }}</span>
                                            <span class="cat {{ $catClass }}">{{ strtoupper(optional($item->category)->nama_kategori ?? '-') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="stock-text">{{ $item->stok }}</span></td>
                        <td>
                            <span class="status-pill {{ $item->kondisi === 'baik' ? 'baik' : ($item->kondisi === 'rusak_ringan' ? 'cek' : 'rusak') }}">
                                • {{ str_replace('_', ' ', ucfirst($item->kondisi)) }}
                            </span>
                        </td>
                        <td><span class="location-text">{{ optional($item->category)->nama_kategori ?? '-' }}</span></td>
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('petugas.inventaris.edit', $item) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('petugas.inventaris.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus barang ini?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-edit" style="background:none; border:none; cursor:pointer; color:#dc2626;">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px; color:#94a3b8; font-size:13px;">
                            Belum ada data inventaris. Klik "Tambah alat" untuk mendaftarkan barang baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Footer Pagination -->
            <div class="table-footer">
                <div>Menampilkan {{ $items->count() }} inventaris</div>
            </div>
        </div>
    </main>
    

</body>
</html>