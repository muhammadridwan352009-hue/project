<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Akun Siswa - SIMPATI</title>
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
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .header-title h1 {
            font-size: 22px;
            color: #1a202c;
            font-weight: 800;
        }
        .header-title p {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }
        .user-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            font-size: 13px;
            font-weight: 600;
        }
        .dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
        }

        /* Top Bar: Search & Summary */
        .toolbar-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 280px;
            max-width: 520px;
        }
        .search-input-wrap {
            position: relative;
            flex: 1;
        }
        .search-input-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        .search-input {
            width: 100%;
            padding: 10px 14px 10px 38px;
            font-size: 13.5px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            transition: all 0.2s;
            background: #f8fafc;
        }
        .search-input:focus {
            background: #ffffff;
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.12);
        }
        .btn-search {
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-search:hover {
            background-color: #00796b;
        }
        .btn-reset {
            background-color: #f1f5f9;
            color: #64748b;
            border: 1px solid #cbd5e1;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-reset:hover {
            background-color: #e2e8f0;
            color: #1e293b;
        }
        .total-summary {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }
        .total-summary strong {
            color: #0f172a;
        }

        /* Alert Notification */
        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Table Card */
        .card-table {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }
        th {
            background: #f8fafc;
            color: #475569;
            font-weight: 700;
            padding: 14px 18px;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        td {
            padding: 16px 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            vertical-align: middle;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover td {
            background: #f8fafc;
        }

        .student-name {
            font-weight: 700;
            color: #0f172a;
        }

        /* Badges Status Akun */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }
        /* Pending: Kuning / Oranye */
        .status-pill.pending {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        /* Approved: Hijau */
        .status-pill.approved {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        /* Rejected: Merah */
        .status-pill.rejected {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .btn-approve {
            background: #10b981;
            color: #ffffff;
            border: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }
        .btn-approve:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        .btn-delete {
            background: #b91c1c;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s ease;
            white-space: nowrap;
        }

        .btn-delete:hover {
            background: #991b1b;
        }

        .btn-reject {
            background: #ef4444;
            color: #ffffff;
            border: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }
        .btn-reject:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .empty-state {
            padding: 48px 20px;
            text-align: center;
            color: #64748b;
        }
        .empty-state-icon {
            font-size: 42px;
            margin-bottom: 12px;
        }
        .empty-state-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        /* Pagination */
        .pagination-container {
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        @media (max-width: 768px) {
            main {
                padding: 20px 16px;
            }
            .toolbar-card {
                flex-direction: column;
                align-items: stretch;
            }
            .search-form {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Petugas SIMPATI -->
    @include('petugas.partials.sidebar', ['active' => 'persetujuan-siswa'])

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
                <div class="header-title">
                    <h1>Persetujuan Akun Siswa</h1>
                    <p>Kelola dan verifikasi seluruh pendaftaran akun siswa dalam satu daftar terpadu.</p>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('petugas.daftar-siswa') }}" style="background: #00897b; color: #fff; padding: 9px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(0, 137, 123, 0.25);">
                    <span>+</span> Tambah Akun Siswa
                </a>
                <div class="user-badge">
                    <span class="dot"></span>
                    <span>{{ Auth::user()->name }} (Petugas)</span>
                </div>
            </div>
        </header>

        @if(session('status'))
            <div class="alert-success">
                <span>✓</span>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <!-- Toolbar Pencarian & Info Total -->
        <div class="toolbar-card">
            <form method="GET" action="{{ route('petugas.persetujuan-siswa') }}" class="search-form">
                <div class="search-input-wrap">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $search }}" 
                        placeholder="Cari berdasarkan Nama atau NIS siswa..." 
                        class="search-input"
                    >
                </div>
                <button type="submit" class="btn-search">Cari</button>
                @if($search !== '')
                    <a href="{{ route('petugas.persetujuan-siswa') }}" class="btn-reset">Reset</a>
                @endif
            </form>

            <div class="total-summary">
                Menampilkan <strong>{{ $students->total() }}</strong> siswa terdaftar
                @if($search !== '')
                    (hasil pencarian: "<em>{{ $search }}</em>")
                @endif
            </div>
        </div>

        <!-- Tabel Tunggal Seluruh Pendaftaran Siswa -->
        <div class="card-table">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 45px; text-align: center;">No</th>
                            <th>Nama Lengkap</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Email Sekolah</th>
                            <th>Tanggal Daftar</th>
                            <th style="text-align: center;">Status Akun</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                            @php
                                $status = $student->status_akun ?? 'pending';
                            @endphp
                            <tr>
                                <td style="text-align: center; color: #94a3b8; font-weight: 600;">
                                    {{ $students->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="student-name">{{ $student->name }}</div>
                                </td>
                                <td>
                                    <span style="font-family: monospace; font-size: 13px; font-weight: 600; color: #0284c7;">
                                        {{ $student->nis ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 12px; color: #334155;">
                                        {{ $student->kelas ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span style="color: #475569;">{{ $student->email }}</span>
                                </td>
                                <td>
                                    <div style="font-size: 12px; color: #64748b;">
                                        {{ $student->created_at ? $student->created_at->format('d M Y, H:i') : '-' }}
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    @if($status === 'approved')
                                        <span class="status-pill approved">● Disetujui</span>
                                    @elseif($status === 'rejected')
                                        <span class="status-pill rejected">● Ditolak</span>
                                    @else
                                        <span class="status-pill pending">● Menunggu</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div class="action-group" style="justify-content: center;">
                                        {{-- Pending: Tampilkan tombol Setujui dan Tolak --}}
                                        @if($status === 'pending')
                                            <form method="POST" action="{{ route('petugas.persetujuan-siswa.approve', $student->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin MENYETUJUI akun {{ $student->name }}?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-approve" title="Setujui Akun Siswa">
                                                    ✓ Setujui
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('petugas.persetujuan-siswa.reject', $student->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK akun {{ $student->name }}?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-reject" title="Tolak Akun Siswa">
                                                    ✕ Tolak
                                                </button>
                                            </form>

                                        {{-- Approved: Tampilkan tombol Tolak jika petugas ingin membatalkan persetujuan --}}
                                        @elseif($status === 'approved')
                                            <form method="POST" action="{{ route('petugas.persetujuan-siswa.reject', $student->id) }}" onsubmit="return confirm('Batalkan persetujuan dan TOLAK akun {{ $student->name }}? Siswa tidak akan dapat masuk kembali.');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-reject" title="Batalkan Persetujuan (Tolak)">
                                                    ✕ Tolak
                                                </button>
                                            </form>

                                        {{-- Rejected: Tampilkan tombol Setujui jika petugas ingin menyetujui kembali --}}
                                        @elseif($status === 'rejected')
                                            <form method="POST" action="{{ route('petugas.persetujuan-siswa.approve', $student->id) }}" onsubmit="return confirm('Setujui kembali akun {{ $student->name }} agar dapat masuk?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-approve" title="Setujui Kembali">
                                                    ✓ Setujui
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Tombol Hapus permanen tersedia untuk semua status --}}
                                        <form method="POST" action="{{ route('petugas.persetujuan-siswa.destroy', $student->id) }}" onsubmit="return confirm('PERINGATAN: Akun {{ $student->name }} ({{ $student->nis }}) akan DIHAPUS PERMANEN beserta data peminjaman dan notifikasinya. Lanjutkan?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Hapus Akun Permanen">🗑 Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">📋</div>
                                        <div class="empty-state-title">Belum ada pendaftaran siswa</div>
                                        <p>
                                            @if($search !== '')
                                                Tidak ditemukan data siswa dengan kata kunci "<strong>{{ $search }}</strong>".
                                            @else
                                                Saat ini belum ada data siswa yang mendaftar di sistem SIMPATI.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($students->hasPages())
                <div class="pagination-container">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </main>

</body>
</html>
