<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kondisi Alat - SIMPATI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            padding: 30px 40px;
            overflow-y: auto;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        header .title-sub {
            font-size: 11px;
            color: #2563eb;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        header h1 {
            font-size: 24px;
            color: #071b26;
            margin-top: 4px;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-export {
            background: #fff;
            color: #059669;
            border: 1px solid #10b981;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-export:hover {
            background: #ecfdf5;
        }
        .user-badge {
            background: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: #2563eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Alert */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-success {
            background-color: #eff6ff;
            color: #1d4ed8;
            border-left: 4px solid #2563eb;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 16px 20px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .stat-info .num {
            font-size: 24px;
            font-weight: 800;
            color: #071b26;
        }
        .stat-info .label {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
            margin-top: 2px;
        }
        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .icon-blue { background: #eff6ff; color: #2563eb; }
        .icon-yellow { background: #fffbeb; color: #d97706; }
        .icon-orange { background: #fff7ed; color: #ea580c; }
        .icon-green { background: #ecfdf5; color: #059669; }

        /* Filter & Search Bar */
        .filter-section {
            background: #fff;
            border-radius: 12px;
            padding: 16px 20px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .search-form {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 600px;
        }
        .search-input {
            flex: 1;
            padding: 9px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            outline: none;
        }
        .search-input:focus {
            border-color: #2563eb;
        }
        .filter-select {
            padding: 9px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            background: #fff;
        }
        .btn-filter {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-reset {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 9px 14px;
            border-radius: 8px;
            font-size: 13px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Tabs Navigation */
        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 2px;
        }
        .tab-btn {
            background: none;
            border: none;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -4px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .tab-btn:hover {
            color: #2563eb;
        }
        .tab-btn.active {
            color: #2563eb;
            border-bottom-color: #2563eb;
        }
        .tab-count {
            background: #e2e8f0;
            color: #475569;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 12px;
        }
        .tab-btn.active .tab-count {
            background: #eff6ff;
            color: #1d4ed8;
        }

        /* Table Card */
        .table-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            color: #1e293b;
            vertical-align: middle;
        }
        tr:hover td {
            background: #f8fafc;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid transparent;
        }
        .badge-menunggu {
            background-color: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }
        .badge-proses {
            background-color: #fffbeb;
            color: #b45309;
            border-color: #fde68a;
        }
        .badge-selesai {
            background-color: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0;
        }

        .badge-kondisi-rusak_ringan { background: #fef9c3; color: #854d0e; }
        .badge-kondisi-rusak_berat { background: #fee2e2; color: #991b1b; }
        .badge-kondisi-tidak_berfungsi { background: #ffedd5; color: #9a3412; }
        .badge-kondisi-kehilangan { background: #f3e8ff; color: #6b21a8; }

        /* Action Buttons */
        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            transition: all 0.15s;
        }
        .btn-detail {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }
        .btn-detail:hover {
            background: #dbeafe;
        }
        .btn-quick-process {
            background: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        .btn-quick-process:hover {
            background: #fef3c7;
        }
        .btn-quick-complete {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
        .btn-quick-complete:hover {
            background: #d1fae5;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }
        .empty-state i {
            font-size: 42px;
            margin-bottom: 12px;
            color: #cbd5e1;
        }

        /* Modal Detail */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(2px);
        }
        .modal-content {
            background: #fff;
            border-radius: 14px;
            width: 100%;
            max-width: 650px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.2s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }
        .modal-header {
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h3 {
            font-size: 18px;
            color: #071b26;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-close {
            background: none;
            border: none;
            font-size: 20px;
            color: #94a3b8;
            cursor: pointer;
        }
        .modal-body {
            padding: 24px;
        }
        .info-row {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 13px;
        }
        .info-label {
            color: #64748b;
            font-weight: 600;
        }
        .info-value {
            color: #0f172a;
        }
        .modal-photo {
            margin: 14px 0;
            text-align: center;
        }
        .modal-photo img {
            max-width: 100%;
            max-height: 250px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        .modal-footer {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            border-bottom-left-radius: 14px;
            border-bottom-right-radius: 14px;
        }
    </style>
</head>
<body>

    {{-- Sidebar Petugas --}}
    @include('petugas.partials.sidebar', ['active' => 'laporan'])

    <main>
        <header>
            <div>
                <div class="title-sub">Pusat Kelola Petugas</div>
                <h1>Laporan Kondisi Alat</h1>
            </div>
            <div class="header-actions">
                <a href="{{ route('petugas.laporan.kondisi.export') }}" class="btn-export">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>Ekspor CSV</span>
                </a>
                <div class="user-badge">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Statistik Rekap --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <div class="num">{{ $counts['total'] }}</div>
                    <div class="label">Total Laporan Masuk</div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <div class="num">{{ $counts['stat_menunggu'] }}</div>
                    <div class="label">Menunggu Diproses</div>
                </div>
                <div class="stat-icon icon-yellow">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <div class="num">{{ $counts['stat_proses'] }}</div>
                    <div class="label">Sedang Ditangani</div>
                </div>
                <div class="stat-icon icon-orange">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <div class="num">{{ $counts['stat_selesai'] }}</div>
                    <div class="label">Laporan Selesai</div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="filter-section">
            <form action="{{ route('petugas.laporan') }}" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Cari nama siswa atau nama alat..." value="{{ $search }}">
                <select name="kondisi" class="filter-select">
                    <option value="all">-- Semua Kondisi --</option>
                    <option value="rusak_ringan" {{ $kondisi == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak_berat" {{ $kondisi == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                    <option value="tidak_berfungsi" {{ $kondisi == 'tidak_berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                    <option value="kehilangan" {{ $kondisi == 'kehilangan' ? 'selected' : '' }}>Kehilangan</option>
                </select>
                <button type="submit" class="btn-filter">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Cari</span>
                </button>
                @if(!empty($search) || (!empty($kondisi) && $kondisi !== 'all'))
                    <a href="{{ route('petugas.laporan') }}" class="btn-reset">
                        <i class="fa-solid fa-xmark"></i> Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- 3 Tab Navigasi --}}
        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab('tab-semua', this)">
                <i class="fa-solid fa-layer-group"></i>
                <span>Semua Laporan</span>
                <span class="tab-count">{{ $counts['semua'] }}</span>
            </button>
            <button class="tab-btn" onclick="switchTab('tab-menunggu', this)">
                <i class="fa-solid fa-clock"></i>
                <span>Menunggu Diproses</span>
                <span class="tab-count">{{ $counts['menunggu'] }}</span>
            </button>
            <button class="tab-btn" onclick="switchTab('tab-selesai', this)">
                <i class="fa-solid fa-check-double"></i>
                <span>Selesai</span>
                <span class="tab-count">{{ $counts['selesai'] }}</span>
            </button>
        </div>

        {{-- TAB 1: SEMUA LAPORAN --}}
        <div id="tab-semua" class="tab-content">
            <div class="table-card">
                @if($laporanSemua->isEmpty())
                    <div class="empty-state">
                        <i class="fa-solid fa-box-archive"></i>
                        <p style="font-size: 14px; font-weight: 600; color: #475569;">Tidak Ada Laporan Ditemukan</p>
                        <p style="font-size: 12px; margin-top: 4px;">Belum ada laporan dari siswa atau filter tidak cocok.</p>
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa Pelapor</th>
                                <th>Alat & Kategori</th>
                                <th>Kondisi</th>
                                <th>Deskripsi</th>
                                <th>Foto Bukti</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th style="text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporanSemua as $item)
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; color:#0f172a;">
                                            {{ $item->user?->name ?? $item->peminjaman?->user?->name ?? $item->nama_peminjam }}
                                        </div>
                                        <div style="font-size: 11px; color:#64748b;">
                                            {{ $item->user?->email ?? $item->peminjaman?->user?->email ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600;">
                                            {{ $item->alat?->nama_alat ?? $item->peminjaman?->alat?->nama_alat ?? 'Alat #' . $item->alat_id }}
                                        </div>
                                        <div style="font-size: 11px; color:#64748b;">
                                            {{ $item->alat?->kode_alat ?? $item->kode_inventaris }} &bull; {{ $item->kategori }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-kondisi-{{ $item->kondisi_terima }}">
                                            {{ $item->kondisi_label }}
                                        </span>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $item->deskripsi_kerusakan }}">
                                            {{ $item->deskripsi_kerusakan }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->foto)
                                            <a href="{{ asset('storage/' . $item->foto) }}" target="_blank" title="Buka foto asli">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                                            </a>
                                        @else
                                            <span style="font-size: 11px; color:#94a3b8;">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 12px; color: #64748b;">
                                        {{ $item->created_at?->format('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        @if($item->status === 'selesai')
                                            <span class="badge badge-selesai"><i class="fa-solid fa-circle-check"></i> Selesai</span>
                                        @elseif($item->status === 'sedang_diproses')
                                            <span class="badge badge-proses"><i class="fa-solid fa-spinner fa-spin"></i> Diproses</span>
                                        @else
                                            <span class="badge badge-menunggu"><i class="fa-solid fa-hourglass-half"></i> Menunggu</span>
                                        @endif
                                    </td>
                                    <td style="text-align: right; white-space: nowrap;">
                                        <button type="button" class="btn-action btn-detail" onclick="openDetailModal({{ $item->id }})">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- TAB 2: MENUNGGU DIPROSES --}}
        <div id="tab-menunggu" class="tab-content" style="display: none;">
            <div class="table-card">
                @if($laporanMenunggu->isEmpty())
                    <div class="empty-state">
                        <i class="fa-solid fa-circle-check"></i>
                        <p style="font-size: 14px; font-weight: 600; color: #475569;">Semua Laporan Sudah Selesai!</p>
                        <p style="font-size: 12px; margin-top: 4px;">Tidak ada laporan pending yang butuh diproses saat ini.</p>
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa Pelapor</th>
                                <th>Alat & Kategori</th>
                                <th>Kondisi</th>
                                <th>Deskripsi</th>
                                <th>Foto Bukti</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th style="text-align: right;">Aksi Tanggapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporanMenunggu as $item)
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; color:#0f172a;">
                                            {{ $item->user?->name ?? $item->peminjaman?->user?->name ?? $item->nama_peminjam }}
                                        </div>
                                        <div style="font-size: 11px; color:#64748b;">
                                            {{ $item->user?->email ?? $item->peminjaman?->user?->email ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600;">
                                            {{ $item->alat?->nama_alat ?? $item->peminjaman?->alat?->nama_alat ?? 'Alat #' . $item->alat_id }}
                                        </div>
                                        <div style="font-size: 11px; color:#64748b;">
                                            {{ $item->alat?->kode_alat ?? $item->kode_inventaris }} &bull; {{ $item->kategori }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-kondisi-{{ $item->kondisi_terima }}">
                                            {{ $item->kondisi_label }}
                                        </span>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $item->deskripsi_kerusakan }}">
                                            {{ $item->deskripsi_kerusakan }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->foto)
                                            <a href="{{ asset('storage/' . $item->foto) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                                            </a>
                                        @else
                                            <span style="font-size: 11px; color:#94a3b8;">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 12px; color: #64748b;">
                                        {{ $item->created_at?->format('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        @if($item->status === 'sedang_diproses')
                                            <span class="badge badge-proses"><i class="fa-solid fa-spinner fa-spin"></i> Diproses</span>
                                        @else
                                            <span class="badge badge-menunggu"><i class="fa-solid fa-hourglass-half"></i> Menunggu</span>
                                        @endif
                                    </td>
                                    <td style="text-align: right; white-space: nowrap;">
                                        <button type="button" class="btn-action btn-detail" onclick="openDetailModal({{ $item->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i> Periksa / Proses
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- TAB 3: SELESAI --}}
        <div id="tab-selesai" class="tab-content" style="display: none;">
            <div class="table-card">
                @if($laporanSelesai->isEmpty())
                    <div class="empty-state">
                        <i class="fa-solid fa-inbox"></i>
                        <p style="font-size: 14px; font-weight: 600; color: #475569;">Belum Ada Laporan Selesai</p>
                        <p style="font-size: 12px; margin-top: 4px;">Laporan yang telah ditandai selesai akan muncul di tab ini.</p>
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa Pelapor</th>
                                <th>Alat & Kategori</th>
                                <th>Kondisi</th>
                                <th>Deskripsi</th>
                                <th>Catatan Petugas</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th style="text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporanSelesai as $item)
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; color:#0f172a;">
                                            {{ $item->user?->name ?? $item->peminjaman?->user?->name ?? $item->nama_peminjam }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600;">
                                            {{ $item->alat?->nama_alat ?? $item->peminjaman?->alat?->nama_alat ?? 'Alat #' . $item->alat_id }}
                                        </div>
                                        <div style="font-size: 11px; color:#64748b;">
                                            {{ $item->alat?->kode_alat ?? $item->kode_inventaris }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-kondisi-{{ $item->kondisi_terima }}">
                                            {{ $item->kondisi_label }}
                                        </span>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $item->deskripsi_kerusakan }}
                                        </div>
                                    </td>
                                    <td style="max-width: 200px; color: #15803d; font-size: 12px;">
                                        {{ $item->catatan_petugas ?? '-' }}
                                    </td>
                                    <td style="font-size: 12px; color: #64748b;">
                                        {{ $item->created_at?->format('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        <span class="badge badge-selesai"><i class="fa-solid fa-circle-check"></i> Selesai</span>
                                    </td>
                                    <td style="text-align: right; white-space: nowrap;">
                                        <button type="button" class="btn-action btn-detail" onclick="openDetailModal({{ $item->id }})">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </main>

    {{-- MODAL DETAIL & RESPON PETUGAS --}}
    <div id="detailModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa-solid fa-file-circle-check text-blue-600"></i> Detail Laporan Kerusakan Alat</h3>
                <button type="button" class="btn-close" onclick="closeDetailModal()">&times;</button>
            </div>
            
            <form id="formUpdateStatus" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="info-row">
                        <span class="info-label">Siswa Pelapor:</span>
                        <span class="info-value" id="modalSiswa">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alat Inventaris:</span>
                        <span class="info-value" id="modalAlat">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kategori / Kode:</span>
                        <span class="info-value" id="modalKode">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kondisi Alat:</span>
                        <span class="info-value" id="modalKondisi">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tanggal Lapor:</span>
                        <span class="info-value" id="modalTanggal">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Deskripsi Kerusakan:</span>
                        <div class="info-value" id="modalDeskripsi" style="background: #f8fafc; padding: 10px; border-radius: 6px; border: 1px solid #e2e8f0; line-height: 1.5;"></div>
                    </div>

                    <div id="modalPhotoContainer" class="modal-photo" style="display: none;">
                        <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Foto Bukti Kerusakan:</div>
                        <a id="modalPhotoLink" href="#" target="_blank">
                            <img id="modalPhotoImg" src="" alt="Bukti Foto">
                        </a>
                    </div>

                    <hr style="border: 0; border-top: 1px dashed #cbd5e1; margin: 18px 0;">

                    {{-- Form Kontrol Status --}}
                    <div style="margin-bottom: 14px;">
                        <label for="modalSelectStatus" style="display: block; font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                            Ubah Status Laporan:
                        </label>
                        <select name="status" id="modalSelectStatus" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            <option value="menunggu">Menunggu</option>
                            <option value="sedang_diproses">Sedang Diproses (Dalam Penanganan)</option>
                            <option value="selesai">Selesai (Kerusakan Selesai Ditangani)</option>
                        </select>
                    </div>

                    <div>
                        <label for="modalCatatanPetugas" style="display: block; font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                            Catatan / Tanggapan Petugas:
                        </label>
                        <textarea name="catatan_petugas" id="modalCatatanPetugas" rows="3" placeholder="Tuliskan keterangan tindakan, perbaikan, atau respon untuk siswa..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px;"></textarea>
                    </div>
                </div>

                <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-action" style="background: #f1f5f9; color: #475569;" onclick="closeDetailModal()">Tutup</button>
                    <button type="submit" class="btn-action" style="background: #2563eb; color: #fff; padding: 8px 18px; font-size: 13px;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Tanggapan & Status
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchTab(tabId, el) {
            document.querySelectorAll('.tab-content').forEach(tc => tc.style.display = 'none');
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabId).style.display = 'block';
            el.classList.add('active');
        }

        function openDetailModal(id) {
            const modal = document.getElementById('detailModal');
            modal.style.display = 'flex';

            const form = document.getElementById('formUpdateStatus');
            form.action = `/petugas/laporan/${id}/status`;

            fetch(`/petugas/laporan/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('modalSiswa').textContent = `${data.nama_siswa} (${data.email_siswa})`;
                    document.getElementById('modalAlat').textContent = data.nama_alat;
                    document.getElementById('modalKode').textContent = `${data.kode_alat} • ${data.kategori}`;
                    document.getElementById('modalKondisi').textContent = data.kondisi_label;
                    document.getElementById('modalTanggal').textContent = data.tanggal_laporan;
                    document.getElementById('modalDeskripsi').textContent = data.deskripsi_kerusakan;

                    document.getElementById('modalSelectStatus').value = data.status;
                    document.getElementById('modalCatatanPetugas').value = data.catatan_petugas || '';

                    const photoContainer = document.getElementById('modalPhotoContainer');
                    const photoImg = document.getElementById('modalPhotoImg');
                    const photoLink = document.getElementById('modalPhotoLink');
                    if (data.foto_url) {
                        photoImg.src = data.foto_url;
                        photoLink.href = data.foto_url;
                        photoContainer.style.display = 'block';
                    } else {
                        photoContainer.style.display = 'none';
                    }
                })
                .catch(err => {
                    alert('Gagal memuat detail laporan.');
                    closeDetailModal();
                });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                closeDetailModal();
            }
        }
    </script>
</body>
</html>
