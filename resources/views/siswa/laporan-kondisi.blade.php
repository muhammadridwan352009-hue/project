<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kondisi Alat - SIMPATI</title>
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
        /* Sidebar */
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
            background-color: #10b981;
            border-radius: 50%;
        }
        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 16px;
        }
        .breadcrumb a {
            color: #00897b;
            text-decoration: none;
        }

        /* Layout 2 kolom */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 24px;
            align-items: start;
        }

        /* Title Section */
        .title-section {
            margin-bottom: 24px;
        }
        .title-section h2 {
            font-size: 22px;
            color: #071b26;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .title-section p {
            font-size: 13px;
            color: #718096;
        }

        /* Form Card */
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 28px 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .form-card h3 {
            font-size: 15px;
            font-weight: 700;
            color: #071b26;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-group label .req {
            color: #dc2626;
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            color: #1e293b;
            outline: none;
            transition: 0.2s;
            background: #fff;
        }
        .form-group input[readonly] {
            background: #f8fafc;
            color: #64748b;
            cursor: not-allowed;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0,137,123,0.1);
        }
        .form-group textarea {
            resize: vertical;
            min-height: 90px;
        }
        .form-group .hint {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 4px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* Radio Pills Kondisi */
        .kondisi-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .kondisi-pill {
            position: relative;
        }
        .kondisi-pill input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        .kondisi-pill span {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            color: #64748b;
        }
        .kondisi-pill input:checked + span {
            border-color: currentColor;
            background: currentColor;
            color: #fff !important;
        }
        .kondisi-pill.baik span { color: #047857; }
        .kondisi-pill.baik input:checked + span { background: #047857; border-color: #047857; color: #fff; }
        .kondisi-pill.normal span { color: #059669; }
        .kondisi-pill.normal input:checked + span { background: #059669; border-color: #059669; color: #fff; }
        .kondisi-pill.rusak-ringan span { color: #d97706; }
        .kondisi-pill.rusak-ringan input:checked + span { background: #d97706; border-color: #d97706; color: #fff; }
        .kondisi-pill.rusak-berat span { color: #dc2626; }
        .kondisi-pill.rusak-berat input:checked + span { background: #dc2626; border-color: #dc2626; color: #fff; }
        .kondisi-pill.belum-dipakai span { color: #64748b; }
        .kondisi-pill.belum-dipakai input:checked + span { background: #64748b; border-color: #64748b; color: #fff; }

        /* Checkbox */
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }
        .checkbox-group input[type="checkbox"] {
            margin-top: 2px;
            accent-color: #00897b;
            width: 16px;
            height: 16px;
        }
        .checkbox-group label {
            font-size: 13px;
            color: #334155;
            font-weight: 600;
            cursor: pointer;
        }
        .checkbox-group p {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Alert */
        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #047857;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
            border: none;
        }
        .btn-primary {
            background: #00897b;
            color: #fff;
        }
        .btn-primary:hover {
            background: #00796b;
        }
        .btn-outline {
            background: #fff;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
        .btn-outline:hover {
            border-color: #00897b;
            color: #00897b;
        }

        /* Panel Kanan */
        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 16px;
        }
        .panel h4 {
            font-size: 13px;
            font-weight: 700;
            color: #071b26;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .panel h4 .icon {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }
        .status-ok {
            background: #d1fae5;
            color: #047857;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-list {
            list-style: none;
            counter-reset: info;
        }
        .info-list li {
            counter-increment: info;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            font-size: 11.5px;
            color: #475569;
            line-height: 1.4;
        }
        .info-list li:not(:last-child) {
            border-bottom: 1px solid #f1f5f9;
        }
        .info-list li::before {
            content: counter(info);
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1px;
        }
        .notice-warn {
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 11.5px;
            line-height: 1.5;
        }
        .notice-warn strong {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }
        .status-badge-sm {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .status-badge-sm.pending {
            background: #fef3c7;
            color: #92400e;
        }
        .status-badge-sm.sent {
            background: #d1fae5;
            color: #047857;
        }

        /* Empty State */
        .empty-state {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 60px 40px;
            text-align: center;
        }
        .empty-icon {
            width: 80px;
            height: 80px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }
        .empty-state h3 {
            font-size: 18px;
            font-weight: 700;
            color: #071b26;
            margin-bottom: 8px;
        }
        .empty-state p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 24px;
        }
        
        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr !important; }
            .form-row { grid-template-columns: 1fr !important; }
        }
        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .empty-state { padding: 40px 20px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    @include('siswa.partials.sidebar', ['active' => 'laporan-kondisi'])


    <!-- Konten Utama -->
    <main>
        <header>
            <div class="header-left">
                <div class="title-sub">SISTEM INVENTARIS SEKOLAH</div>
                <h1>Laporan kondisi alat</h1>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>
        <div class="breadcrumb">
            <a href="/siswa/beranda">Beranda</a> /
            <span style="color:#718096;">Laporan kondisi alat</span>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
        <div class="alert-success">
            <span>✅</span>
            {{ session('success') }}
        </div>
        @endif

        @if($peminjaman)
        <div class="form-card" style="margin-bottom:24px;">
            <form method="GET" action="{{ route('siswa.laporan-kondisi') }}">
                <div class="form-group" style="margin-bottom:0;">
                    <label for="peminjaman_id">Pilih peminjaman untuk laporan</label>
                    <select id="peminjaman_id" name="peminjaman_id" onchange="this.form.submit()">
                        @foreach($peminjamans as $itemPeminjaman)
                            <option value="{{ $itemPeminjaman->id }}" @selected($peminjaman->id === $itemPeminjaman->id)>
                                {{ $itemPeminjaman->alat->nama_alat ?? 'Alat' }} — {{ $itemPeminjaman->alat->kode_alat ?? '-' }}
                                @if($itemPeminjaman->laporanKondisi) (laporan tersimpan) @endif
                            </option>
                        @endforeach
                    </select>
                    <div class="hint">Setiap peminjaman memiliki laporan kondisi yang dapat diperbarui.</div>
                </div>
            </form>
        </div>

        <div class="content-grid">
            <!-- Kolom Kiri: Form -->
            <div>
                <div class="title-section">
                    <h2>Laporkan kondisi alat</h2>
                    <p>{{ $laporan ? 'Perbarui laporan kondisi alat yang sudah tersimpan.' : 'Isi kondisi alat untuk peminjaman yang dipilih.' }}</p>
                </div>

                <div class="form-card">
                    <h3>{{ $laporan ? 'Edit laporan kondisi alat' : 'Form pelaporan kondisi alat' }}</h3>

                    <form method="POST" action="{{ route('siswa.laporan-kondisi.store', ['peminjaman_id' => $peminjaman->id]) }}">
                        @csrf

                        <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">

                        <div class="form-group">
                            <label>Nama siswa</label>
                            <input type="text" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Kode inventaris</label>
                                <input type="text" value="{{ $peminjaman->alat->kode_alat ?? '-' }}" readonly>
                                <div class="hint">{{ $peminjaman->alat->nama_alat ?? '-' }}</div>
                            </div>
                            <div class="form-group">
                                <label>Kategori peminjaman</label>
                                <input type="text" value="{{ ucfirst($peminjaman->kategori) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Lokasi kegiatan <span class="req">*</span></label>
                            <input type="text" name="lokasi_kegiatan"
                                   value="{{ old('lokasi_kegiatan', $laporan?->lokasi_kegiatan ?? $peminjaman->lokasi_penggunaan) }}"
                                   placeholder="Ruang A\n{sesuaikan lokasi kegiatan}" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal dikembalikan <span class="req">*</span></label>
                            <input type="date" name="tanggal_pengembalian"
                                   value="{{ old('tanggal_pengembalian', $laporan?->tanggal_pengembalian ?? now()->toDateString()) }}" required>
                            <div class="hint">Maks. {{ \Carbon\Carbon::now()->addDays(10)->format('d M Y') }} (10 hari setelah pinjam)</div>
                        </div>

                        <div class="form-group">
                            <label>Kondisi yang diterima <span class="req">*</span></label>
                            <div class="kondisi-pills">
                                <label class="kondisi-pill baik">
                                    <input type="radio" name="kondisi_terima" value="baik"
                                        @checked(old('kondisi_terima', $laporan?->kondisi_terima) == 'baik')>
                                    <span>✓ Baik / Normal</span>
                                </label>
                                <label class="kondisi-pill rusak-ringan">
                                    <input type="radio" name="kondisi_terima" value="rusak_ringan"
                                        @checked(old('kondisi_terima', $laporan?->kondisi_terima) == 'rusak_ringan')>
                                    <span>⚠ Rusak ringan</span>
                                </label>
                                <label class="kondisi-pill rusak-berat">
                                    <input type="radio" name="kondisi_terima" value="rusak_berat"
                                        @checked(old('kondisi_terima', $laporan?->kondisi_terima) == 'rusak_berat')>
                                    <span>✕ Rusak berat</span>
                                </label>
                                <label class="kondisi-pill belum-dipakai">
                                    <input type="radio" name="kondisi_terima" value="belum_dipakai"
                                        @checked(old('kondisi_terima', $laporan?->kondisi_terima) == 'belum_dipakai')>
                                    <span>◌ Belum dipakai</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi kerusakan <span class="req">*</span></label>
                            <textarea name="deskripsi_kerusakan"
                                      placeholder="Uraikan kondisi saat kerusakan alat (sebutkan jenis kerusakannya). Jika tidak ada kerusakan, tuliskan \"Tidak ada kerusakan\"."
                                      required>{{ old('deskripsi_kerusakan', $laporan?->deskripsi_kerusakan) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Bukti lain (opsional)</label>
                            <div class="checkbox-group">
                                <input type="checkbox" id="kirim_foto" name="kirim_dengan_foto" value="1"
                                    @checked(old('kirim_dengan_foto', $laporan?->kirim_dengan_foto))>
                                <div>
                                    <label for="kirim_foto">Terlampir foto/rubah/gambar</label>
                                    <p>Lampirkan bukti visual untuk mempercepat verifikasi petugas.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Validasi error --}}
                        @if($errors->any())
                        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#dc2626;padding:12px 16px;border-radius:10px;font-size:12px;margin-bottom:16px;">
                            <strong>⚠ Ada kesalahan:</strong>
                            <ul style="margin:8px 0 0 18px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                💾 {{ $laporan ? 'Perbarui laporan' : 'Kirim laporan' }}
                            </button>
                            <a href="{{ route('siswa.peminjaman.index') }}" class="btn btn-outline">
                                Batal
                            </a>
                        </div>

                        <p style="font-size:11px;color:#94a3b8;margin-top:12px;">
                            Dengan mengklik tombol ini Anda menyatakan data yang diisikan
                            adalah benar dan bertanggung jawab atas isi laporan.
                        </p>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Panel Info -->
            <div>
                <div class="panel">
                    <h4>
                        <span class="icon" style="background:#d1fae5;color:#047857;">✓</span>
                        Status peminjaman
                    </h4>
                    <div class="status-ok">
                        <span>✅</span>
                        Silakan isi form di samping, lalu klik "Simpan laporan" untuk mengirimnya ke petugas.
                    </div>
                </div>

                <div class="panel">
                    <h4>
                        <span class="icon" style="background:#dbeafe;color:#1e40af;">ℹ</span>
                        Info
                    </h4>
                    <ul class="info-list">
                        <li>PMS akan disertai alat yang sudah disetujui oleh petugas.</li>
                        <li>PMS memungkinkan untuk mengulangi pengisian perangkat kondisi instalasi.</li>
                        <li>PMS ini diperuntukkan sebagai ringkasan pengisian data dari alat.</li>
                        <li>Maksimal pengisian 10 hari, lebih dari itu harus PMS manual.</li>
                        <li>Kebutuhan 10 hari dihitung dari tanggal pinjam hingga tanggal pengembalian alat.</li>
                        <li>Sudah dilakukan? Anda sudah memiliki alat. Silakan aktifkan pelaporan berikutnya saat periode pengisian berikutnya.</li>
                    </ul>
                </div>

                <div class="panel">
                    <h4>
                        <span class="icon" style="background:#f1f5f9;color:#64748b;">📄</span>
                        Laporan tersimpan
                    </h4>
                    @forelse($peminjamans->whereNotNull('laporanKondisi') as $itemPeminjaman)
                        <p style="font-size:12px;margin:0 0 10px;">
                            <strong>{{ $itemPeminjaman->alat->nama_alat ?? 'Alat' }}</strong><br>
                            {{ str_replace('_', ' ', ucfirst($itemPeminjaman->laporanKondisi->kondisi_terima)) }}
                            <a href="{{ route('siswa.laporan-kondisi', ['peminjaman_id' => $itemPeminjaman->id]) }}">Edit</a>
                        </p>
                    @empty
                        <p style="font-size:12px;color:#64748b;">Belum ada laporan yang dikirim.</p>
                    @endforelse
                </div>
            </div>
        </div>

        @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M9 12h6"></path><path d="M9 16h6"></path></svg></div>
            <h3>Tidak ada peminjaman aktif untuk dilaporkan</h3>
            <p>Anda belum memiliki peminjaman yang berstatus disetujui atau sedang dipinjam.<br>
            Ajukan peminjaman terlebih dahulu, lalu kembali untuk melapor kondisi alatnya.</p>
            <a href="{{ route('siswa.peminjaman.create') }}" class="btn btn-primary">
                + Ajukan peminjaman
            </a>
        </div>
        @endif
    </main>
    

</body>
</html>