<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Peminjaman - SIMPATI</title>
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
        .nav-badge {
            margin-left: auto;
            background: #d97706;
            color: #fff;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
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

        /* Title Section */
        .title-section {
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

        /* Stats Mini Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
        }
        .stat-icon.orange { background-color: #fffbeb; border-color: #fef3c7; color: #d97706; }
        .stat-icon.green { background-color: #ecfdf5; border-color: #d1fae5; color: #059669; }
        .stat-icon.red { background-color: #fef2f2; border-color: #fee2e2; color: #ef4444; }
        .stat-label { font-size: 11px; color: #64748b; font-weight: 600; }
        .stat-value { font-size: 20px; font-weight: 800; color: #071b26; line-height: 1.1; }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Table Card */
        .table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .table-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-card-header h3 { font-size: 15px; font-weight: bold; color: #1e293b; }
        .table-card-header span { font-size: 12px; color: #94a3b8; }

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
            padding: 14px 18px;
            vertical-align: middle;
        }
        tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: 0.2s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background-color: #f8fafc; }

        .peminjam-info strong {
            display: block;
            font-size: 13px;
            color: #071b26;
        }
        .peminjam-info span { font-size: 11px; color: #94a3b8; }

        .item-info strong {
            display: block;
            font-size: 13px;
            color: #1e293b;
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
            margin-top: 3px;
        }

        .date-text { font-size: 12px; color: #475569; white-space: nowrap; }
        .jumlah-text { font-size: 13px; font-weight: bold; color: #1e293b; }

        .status-pill {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }
        .status-pill.menunggu { background-color: #fef3c7; color: #d97706; }
        .status-pill.disetujui { background-color: #d1fae5; color: #059669; }
        .status-pill.dipinjam { background-color: #dbeafe; color: #1d4ed8; }
        .status-pill.ditolak { background-color: #fee2e2; color: #ef4444; }
        .status-pill.dikembalikan { background-color: #e2e8f0; color: #475569; }

        .aksi-form {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .aksi-form select {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 12px;
            color: #475569;
            outline: none;
            cursor: pointer;
        }
        .aksi-form select:focus { border-color: #00897b; }
        .btn-simpan {
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            white-space: nowrap;
        }
        .btn-simpan:hover { background-color: #00796b; }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }
        .empty-state .icon { font-size: 40px; margin-bottom: 12px; }
        .empty-state h4 { font-size: 15px; color: #1e293b; font-weight: bold; margin-bottom: 6px; }
        .empty-state p { font-size: 12px; color: #94a3b8; }

        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .table-card { overflow-x: auto; }
            table { min-width: 720px; }
            th, td { padding: 12px 12px; }
            .table-card-header { flex-direction: column; align-items: flex-start; gap: 6px; padding: 14px 16px; }
        }
        @media (max-width: 420px) {
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('petugas.partials.sidebar', ['active' => 'persetujuan'])


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
                <h1>Persetujuan peminjaman</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">Dashboard / <strong>Persetujuan Peminjaman</strong></div>

        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;">
            <div class="title-section" style="margin-bottom: 0;">
                <h2>Verifikasi &amp; persetujuan</h2>
                <p>Tinjau pengajuan peminjaman alat dari siswa dan organisasi.</p>
            </div>
            <a href="{{ route('petugas.persetujuan-siswa') }}" style="background: linear-gradient(135deg, #00897b 0%, #00695c 100%); color: #ffffff; text-decoration: none; padding: 10px 18px; border-radius: 10px; font-size: 13.5px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0, 137, 123, 0.25);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <polyline points="16 11 18 13 22 9"></polyline>
                </svg>
                <span>Persetujuan Akun Siswa &rarr;</span>
            </a>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">⚠️ {{ session('error') }}</div>
        @endif
        @error('status')
            <div class="alert alert-error">⚠️ {{ $message }}</div>
        @enderror
        @error('perpanjangan')
            <div class="alert alert-error">⚠️ {{ $message }}</div>
        @enderror

        <!-- Mini Stats -->
        @php
            $pendingCount = $borrowings->where('status', 'menunggu')->count();
            $disetujuiCount = $borrowings->where('status', 'disetujui')->count();
            $ditolakCount = $borrowings->where('status', 'ditolak')->count();
            $dikembalikanCount = $borrowings->where('status', 'dikembalikan')->count();
        @endphp
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon orange">⏳</div>
                <div>
                    <div class="stat-label">Menunggu</div>
                    <div class="stat-value">{{ $pendingCount }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">✓</div>
                <div>
                    <div class="stat-label">Disetujui</div>
                    <div class="stat-value">{{ $disetujuiCount }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon red">✕</div>
                <div>
                    <div class="stat-label">Ditolak</div>
                    <div class="stat-value">{{ $ditolakCount }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🔄</div>
                <div>
                    <div class="stat-label">Dikembalikan</div>
                    <div class="stat-value">{{ $dikembalikanCount }}</div>
                </div>
            </div>
        </div>

        @if($perpanjangans->isNotEmpty())
        <div class="table-card" style="margin-bottom:24px;">
            <div class="table-card-header">
                <h3>Permintaan perpanjangan</h3>
                <span>{{ $perpanjangans->count() }} menunggu persetujuan</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Barang</th>
                        <th>Tanggal pengembalian</th>
                        <th>Keputusan</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($perpanjangans as $perpanjangan)
                    <tr>
                        <td>{{ $perpanjangan->peminjaman->user->name ?? 'Siswa' }}</td>
                        <td>{{ $perpanjangan->peminjaman->alat->nama_alat ?? 'Alat tidak ditemukan' }}</td>
                        <td>
                            {{ $perpanjangan->tanggal_kembali_lama->translatedFormat('d M Y') }}
                            &rarr; {{ $perpanjangan->tanggal_kembali_baru->translatedFormat('d M Y') }}
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                <form action="{{ route('petugas.perpanjangan.update', $perpanjangan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="btn-simpan">Setujui</button>
                                </form>
                                <form action="{{ route('petugas.perpanjangan.update', $perpanjangan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="btn-simpan" style="background:#dc2626;">Tolak</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Tabel Pengajuan -->
        <div class="table-card">
            <div class="table-card-header">
                <h3>Daftar pengajuan peminjaman</h3>
                <span>Total {{ $borrowings->count() }} pengajuan</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($borrowings as $b)
                    <tr>
                        <td>
                            <div class="peminjam-info">
                                <strong>{{ $b->user->name ?? 'Siswa' }}</strong>
                                <span>Siswa • {{ ucfirst($b->kategori) }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="item-info">
                                <strong>{{ $b->alat->nama_alat ?? 'Alat tidak ditemukan' }}</strong>
                                @if($b->alat)
                                <span class="badge-code">
                                    <span>{{ $b->alat->kode_alat }}</span>
                                </span>
                                @endif
                            </div>
                        </td>
                        <td><span class="jumlah-text">1 unit</span></td>
                        <td>
                            <span class="date-text">
                                {{ $b->tanggal_pinjam->translatedFormat('d M Y') }}
                                – {{ $b->tanggal_kembali->translatedFormat('d M Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="status-pill {{ $b->status }}">
                                @if($b->status == 'menunggu') • Menunggu
                                @elseif($b->status == 'disetujui') ✓ Disetujui
                                @elseif($b->status == 'dipinjam') 📦 Dipinjam
                                @elseif($b->status == 'ditolak') ✕ Ditolak
                                @elseif($b->status == 'dikembalikan') 🔄 Dikembalikan
                                @endif
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('petugas.persetujuan.update', $b->id) }}" method="POST" class="aksi-form">
                                @csrf
                                @method('PUT')
                                <select name="status">
                                    <option value="menunggu" {{ $b->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="disetujui" {{ $b->status == 'disetujui' ? 'selected' : '' }}>Setujui</option>
                                    <option value="dipinjam" {{ $b->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="ditolak" {{ $b->status == 'ditolak' ? 'selected' : '' }}>Tolak</option>
                                    <option value="dikembalikan" {{ $b->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                                <button type="submit" class="btn-simpan">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; padding:40px; color:#94a3b8; font-size:13px;">📭 Belum ada pengajuan peminjaman.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
    

</body>
</html>
