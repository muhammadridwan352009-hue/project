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
        .alert-error {
            background-color: #fef2f2;
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }

        /* Layout Grid */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 24px;
            align-items: start;
        }
        @media (max-width: 1024px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

        /* Card */
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            border: 1px solid #e2e8f0;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        .form-control, select, textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            color: #1e293b;
            background-color: #fff;
            outline: none;
            transition: border-color 0.15s ease;
        }
        .form-control:focus, select:focus, textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .helper-text {
            font-size: 12px;
            color: #64748b;
            margin-top: 4px;
        }

        /* Condition options */
        .condition-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .condition-option {
            position: relative;
        }
        .condition-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        .condition-box {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 12px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #f8fafc;
        }
        .condition-box .title {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
        }
        .condition-box .sub {
            font-size: 11px;
            color: #64748b;
        }
        .condition-option input[type="radio"]:checked + .condition-box {
            border-color: #2563eb;
            background-color: #eff6ff;
        }
        .condition-option input[type="radio"]:checked + .condition-box .title {
            color: #1d4ed8;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            background-color: #2563eb;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 0.15s ease;
        }
        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        /* Riwayat List */
        .history-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .history-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
            transition: all 0.2s ease;
        }
        .history-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .history-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        .tool-name {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }
        .tool-code {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
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
        
        .badge-kondisi {
            background: #f1f5f9;
            color: #475569;
            border-radius: 6px;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
        }

        .desc-text {
            font-size: 13px;
            color: #334155;
            background: #fff;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            margin: 10px 0;
            line-height: 1.5;
        }
        .catatan-petugas {
            font-size: 13px;
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 10px 12px;
            border-radius: 6px;
            margin-top: 10px;
        }
        .catatan-petugas strong {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
            color: #15803d;
        }

        .history-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #64748b;
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px dashed #e2e8f0;
        }
        .photo-thumbnail {
            margin-top: 8px;
            display: inline-block;
        }
        .photo-thumbnail img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            cursor: pointer;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #94a3b8;
        }
        .empty-state i {
            font-size: 36px;
            margin-bottom: 12px;
            color: #cbd5e1;
        }
    </style>
</head>
<body>

    {{-- Sidebar Siswa --}}
    @include('siswa.partials.sidebar', ['active' => 'laporan-kondisi'])

    <main>
        <header>
            <div>
                <div class="title-sub">Layanan Siswa</div>
                <h1>Laporan Kondisi Alat</h1>
            </div>
            <div class="user-badge">
                <i class="fa-solid fa-user-circle"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="grid-container">
            {{-- FORM LAPORAN --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fa-solid fa-file-pen text-blue-600"></i>
                        <span>Buat Laporan Kerusakan</span>
                    </div>
                </div>

                @if($peminjamans->isEmpty())
                    <div class="empty-state">
                        <i class="fa-solid fa-box-open"></i>
                        <p style="font-size: 14px; font-weight: 600; color: #475569;">Belum Ada Riwayat Peminjaman</p>
                        <p style="font-size: 12px; margin-top: 4px;">Anda hanya dapat membuat laporan untuk alat yang sedang atau pernah Anda pinjam.</p>
                    </div>
                @else
                    <form action="{{ route('siswa.laporan-kondisi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Pilihan Alat --}}
                        <div class="form-group">
                            <label for="peminjaman_id">Pilih Alat yang Dilaporkan <span style="color:#ef4444">*</span></label>
                            <select name="peminjaman_id" id="peminjaman_id" required>
                                <option value="" disabled selected>-- Pilih alat dari riwayat pinjam --</option>
                                @foreach($peminjamans as $p)
                                    @php
                                        $sudahDilaporkan = $peminjamanLaporanAktif->contains($p->id);
                                    @endphp
                                    <option value="{{ $p->id }}" {{ old('peminjaman_id') == $p->id ? 'selected' : '' }} {{ $sudahDilaporkan ? 'disabled' : '' }}>
                                        {{ $p->alat->nama_alat ?? 'Alat #' . $p->alat_id }}
                                        ({{ $p->alat->kode_alat ?? 'KODE' }}) - Pinjam: {{ $p->tanggal_pinjam->translatedFormat('d M Y') }}{{ $sudahDilaporkan ? ' — Sudah dilaporkan' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="helper-text">Menampilkan alat yang sedang atau pernah dipinjam.</div>
                        </div>

                        {{-- Pilihan Kondisi Alat --}}
                        <div class="form-group">
                            <label>Kondisi Alat <span style="color:#ef4444">*</span></label>
                            <div class="condition-grid">
                                <label class="condition-option">
                                    <input type="radio" name="kondisi_terima" value="rusak_ringan" {{ old('kondisi_terima', 'rusak_ringan') == 'rusak_ringan' ? 'checked' : '' }} required>
                                    <div class="condition-box">
                                        <span class="title">Rusak Ringan</span>
                                        <span class="sub">Lecet, kendala fisik minor</span>
                                    </div>
                                </label>

                                <label class="condition-option">
                                    <input type="radio" name="kondisi_terima" value="rusak_berat" {{ old('kondisi_terima') == 'rusak_berat' ? 'checked' : '' }}>
                                    <div class="condition-box">
                                        <span class="title">Rusak Berat</span>
                                        <span class="sub">Patah, retak, tidak utuh</span>
                                    </div>
                                </label>

                                <label class="condition-option">
                                    <input type="radio" name="kondisi_terima" value="tidak_berfungsi" {{ old('kondisi_terima') == 'tidak_berfungsi' ? 'checked' : '' }}>
                                    <div class="condition-box">
                                        <span class="title">Tidak Berfungsi</span>
                                        <span class="sub">Mati total, error sistem</span>
                                    </div>
                                </label>

                                <label class="condition-option">
                                    <input type="radio" name="kondisi_terima" value="kehilangan" {{ old('kondisi_terima') == 'kehilangan' ? 'checked' : '' }}>
                                    <div class="condition-box">
                                        <span class="title">Kehilangan</span>
                                        <span class="sub">Hilang / part kurang</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Deskripsi / Kronologi Kerusakan --}}
                        <div class="form-group">
                            <label for="deskripsi_kerusakan">Deskripsi / Kronologi Kerusakan <span style="color:#ef4444">*</span></label>
                            <textarea name="deskripsi_kerusakan" id="deskripsi_kerusakan" rows="4" placeholder="Jelaskan secara rinci kendala, letak kerusakan, atau bagaimana kerusakan terjadi..." required>{{ old('deskripsi_kerusakan') }}</textarea>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="form-group">
                            <label for="foto">Upload Foto Bukti Kondisi Alat</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                            <div class="helper-text">Format didukung: JPG, PNG, WEBP (Maks. 5MB)</div>
                        </div>

                        {{-- Tanggal Otomatis --}}
                        <div class="form-group">
                            <label>Tanggal Laporan</label>
                            <input type="text" class="form-control" value="{{ now()->translatedFormat('d F Y, H:i') }}" readonly style="background-color: #f8fafc; cursor: not-allowed;">
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Kirim Laporan</span>
                        </button>
                    </form>
                @endif
            </div>

            {{-- RIWAYAT LAPORAN --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fa-solid fa-clock-rotate-left text-blue-600"></i>
                        <span>Riwayat Laporan Saya ({{ $riwayatLaporan->count() }})</span>
                    </div>
                </div>

                @if($riwayatLaporan->isNotEmpty())
                    {{-- Ringkasan status laporan --}}
                    @php
                        $jumlahMenunggu = $riwayatLaporan->where('status', 'menunggu')->count();
                        $jumlahDiproses = $riwayatLaporan->where('status', 'sedang_diproses')->count();
                        $jumlahSelesai  = $riwayatLaporan->where('status', 'selesai')->count();
                    @endphp
                    <div style="display:flex; gap:10px; margin-bottom: 16px; flex-wrap: wrap;">
                        <span class="badge badge-menunggu" style="font-size:12px; padding:6px 12px;">
                            <i class="fa-solid fa-hourglass-half"></i> Menunggu: {{ $jumlahMenunggu }}
                        </span>
                        <span class="badge badge-proses" style="font-size:12px; padding:6px 12px;">
                            <i class="fa-solid fa-spinner"></i> Diproses: {{ $jumlahDiproses }}
                        </span>
                        <span class="badge badge-selesai" style="font-size:12px; padding:6px 12px;">
                            <i class="fa-solid fa-circle-check"></i> Selesai: {{ $jumlahSelesai }}
                        </span>
                    </div>
                @endif

                @if($riwayatLaporan->isEmpty())
                    <div class="empty-state">
                        <i class="fa-solid fa-clipboard-check"></i>
                        <p style="font-size: 14px; font-weight: 600; color: #475569;">Belum Ada Laporan Dikirim</p>
                        <p style="font-size: 12px; margin-top: 4px;">Laporan kerusakan yang Anda buat akan tercatat di sini dan dipantau oleh petugas.</p>
                    </div>
                @else
                    <div class="history-list">
                        @foreach($riwayatLaporan as $item)
                            <div class="history-item">
                                <div class="history-top">
                                    <div>
                                        <div class="tool-name">{{ $item->alat->nama_alat ?? $item->peminjaman->alat->nama_alat ?? 'Alat #' . $item->alat_id }}</div>
                                        <div class="tool-code">Kode: {{ $item->alat->kode_alat ?? $item->kode_inventaris ?? '-' }} &bull; Kategori: {{ $item->kategori ?? '-' }}</div>
                                    </div>
                                    <div>
                                        @if($item->status === 'selesai')
                                            <span class="badge badge-selesai">
                                                <i class="fa-solid fa-circle-check"></i> Selesai
                                            </span>
                                        @elseif($item->status === 'sedang_diproses')
                                            <span class="badge badge-proses">
                                                <i class="fa-solid fa-spinner fa-spin"></i> Sedang Diproses
                                            </span>
                                        @else
                                            <span class="badge badge-menunggu">
                                                <i class="fa-solid fa-hourglass-half"></i> Menunggu
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div style="display:flex; gap:8px; align-items:center; margin-bottom: 6px;">
                                    <span class="badge-kondisi">
                                        <i class="fa-solid fa-wrench"></i> {{ $item->kondisi_label }}
                                    </span>
                                </div>

                                <div class="desc-text">
                                    <strong>Keterangan:</strong> {{ $item->deskripsi_kerusakan }}
                                </div>

                                @if($item->foto)
                                    <div class="photo-thumbnail">
                                        <a href="{{ asset('storage/' . $item->foto) }}" target="_blank" title="Klik untuk perbesar">
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Bukti Kerusakan">
                                        </a>
                                    </div>
                                @endif

                                @if($item->catatan_petugas)
                                    <div class="catatan-petugas">
                                        <strong>Tanggapan Petugas:</strong>
                                        {{ $item->catatan_petugas }}
                                    </div>
                                @endif

                                <div class="history-footer">
                                    <span><i class="fa-regular fa-calendar"></i> {{ $item->created_at?->format('d M Y, H:i') }}</span>
                                    <span>ID Laporan: #{{ $item->id }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

</body>
</html>
