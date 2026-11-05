<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Peminjaman - SIMPATI</title>
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
            font-size: 13px;
            color: #718096;
            margin-top: 2px;
        }

        /* Form Card */
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 28px 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            margin-bottom: 24px;
        }
        .form-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        .form-card-header .icon-box {
            width: 42px;
            height: 42px;
            background: #00897b;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .form-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #071b26;
        }
        .form-card-header p {
            font-size: 12px;
            color: #718096;
            margin-top: 2px;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group.full {
            grid-column: 1 / -1;
        }
        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .form-group label .required {
            color: #dc2626;
            margin-right: 4px;
        }
        .form-group label .optional {
            color: #94a3b8;
            font-weight: 400;
            font-size: 12px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px;
            color: #333;
            background: #f8fafc;
            transition: 0.2s;
            outline: none;
            font-family: inherit;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #00897b;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.1);
        }
        .form-group input.error,
        .form-group select.error,
        .form-group textarea.error {
            border-color: #dc2626;
            background: #fef2f2;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        .error-message {
            font-size: 11px;
            color: #dc2626;
            margin-top: 4px;
        }

        /* Stok Info */
        .stok-info {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
            display: none;
        }
        .stok-info.show {
            display: block;
        }
        .stok-info span {
            color: #00897b;
            font-weight: 700;
        }

        /* Info Penanggung Jawab */
        .pj-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-top: 8px;
        }
        .pj-card-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }
        .pj-card-header .icon {
            font-size: 18px;
        }
        .pj-card-header span {
            font-size: 13px;
            font-weight: 700;
            color: #071b26;
        }
        .pj-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .pj-info-item {
            font-size: 12px;
        }
        .pj-info-item .label {
            color: #64748b;
        }
        .pj-info-item .value {
            color: #1e293b;
            font-weight: 600;
            margin-left: 4px;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
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
        .btn-secondary {
            background: #fff;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        .btn-secondary:hover {
            background: #f1f5f9;
        }
        .btn-primary {
            background: #00897b;
            color: #fff;
        }
        .btn-primary:hover {
            background: #00796b;
        }

        /* Alert Success */
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
        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        /* Sidebar Collapse */
        .sidebar-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 10px;
            padding: 8px 10px;
            background: rgba(255,255,255,0.06);
            color: #b0c4de;
            border: 0;
            border-radius: 10px;
            font: inherit;
            font-size: 12px;
            cursor: pointer;
            transition: 0.2s;
        }
        .sidebar-toggle:hover { background: rgba(255,255,255,0.12); color: #fff; }
        .sidebar-toggle .chevron { transition: transform 0.25s; }
        aside.collapsed {
            width: 68px !important;
            padding: 24px 10px !important;
            align-items: center;
        }
        aside.collapsed .brand,
        aside.collapsed .menu-label,
        aside.collapsed .sidebar-footer,
        aside.collapsed nav a span,
        aside.collapsed .logout-button span,
        aside.collapsed .sidebar-toggle .toggle-label { display: none; }
        aside.collapsed .brand-mini {
            display: inline-block;
            background: #fff;
            color: #071b26;
            font-weight: 800;
            font-size: 13px;
            padding: 6px 7px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        aside.collapsed nav a { justify-content: center; padding: 12px 8px; }
        aside.collapsed .sidebar-toggle { width: auto; }
        aside.collapsed .sidebar-toggle .chevron { transform: rotate(180deg); }

        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            .form-grid { grid-template-columns: 1fr; }
            .pj-info-grid { grid-template-columns: 1fr; }
            input, select, textarea { font-size: 16px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('siswa.partials.sidebar', ['active' => 'peminjaman'])

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
                    <h1>Peminjaman saya</h1>
                </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">
            <a href="/siswa/beranda" style="color:#00897b; text-decoration:none;">Beranda</a> / 
            <a href="/siswa/peminjaman" style="color:#00897b; text-decoration:none;">Peminjaman saya</a> / 
            <span style="color:#718096;">Ajukan peminjaman</span>
        </div>

        <div class="title-section">
            <div>
                <h2>Ajukan Peminjaman</h2>
                <p>Isi form di bawah untuk mengajukan peminjaman alat inventaris sekolah.</p>
            </div>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
        <div class="alert-success">
            <span>✅</span>
            {{ session('success') }}
        </div>
        @endif

        {{-- Alert Error --}}
        @if(session('error'))
        <div class="alert-error">
            <span>️</span>
            {{ session('error') }}
        </div>
        @endif

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-card-header">
                <div class="icon-box" style="color: #ffffff;"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                <div>
                    <h3>Form Peminjaman Alat</h3>
                    <p>Lengkapi semua field yang diperlukan</p>
                </div>
            </div>

            <form action="{{ route('siswa.peminjaman.store') }}" method="POST" id="formPeminjaman">
                @csrf

                <div class="form-grid">

                    <!-- Kategori -->
                    <div class="form-group full">
                        <label>
                            <span class="required">*</span> Kategori Alat
                        </label>
                        <select name="kategori" id="kategori" required
                            class="@error('kategori') error @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="multimedia" {{ old('kategori') == 'multimedia' ? 'selected' : '' }}>🎬 Multimedia</option>
                            <option value="rohis" {{ old('kategori') == 'rohis' ? 'selected' : '' }}>🕌 Rohis</option>
                            <option value="band" {{ old('kategori') == 'band' ? 'selected' : '' }}>🎸 Band</option>
                            <option value="osis" {{ old('kategori') == 'osis' ? 'selected' : '' }}>🏫 OSIS</option>
                        </select>
                        @error('kategori')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alat -->
                    <div class="form-group full">
                        <label>
                            <span class="required">*</span> Nama Alat
                        </label>
                        <select name="alat_id" id="alat_id" required
                            class="@error('alat_id') error @enderror">
                            <option value="">-- Pilih Kategori Terlebih Dahulu --</option>
                        </select>
                        <div id="stok_info" class="stok-info">
                            Tersedia: <span id="stok_count">0</span> unit
                        </div>
                        @error('alat_id')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="form-group">
                        <label>
                            <span class="required">*</span> Tanggal Peminjaman
                        </label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required
                            value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}"
                            class="@error('tanggal_pinjam') error @enderror">
                        @error('tanggal_pinjam')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Kembali -->
                    <div class="form-group">
                        <label>
                            <span class="required">*</span> Tanggal Pengembalian
                        </label>
                        <p style="font-size:12px;color:#64748b;margin:0 0 8px;">
                            Lama peminjaman maksimal 7 hari. Jika masih diperlukan, ajukan perpanjangan 7 hari melalui halaman Peminjaman Saya.
                        </p>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" required
                            value="{{ old('tanggal_kembali') }}"
                            min="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                            max="{{ \Carbon\Carbon::parse(old('tanggal_pinjam', date('Y-m-d')))->addDays(7)->format('Y-m-d') }}"
                            class="@error('tanggal_kembali') error @enderror">
                        @error('tanggal_kembali')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Keperluan -->
                    <div class="form-group full">
                        <label>
                            <span class="required">*</span> Keperluan / Tujuan Peminjaman
                        </label>
                        <input type="text" name="keperluan" required
                            value="{{ old('keperluan') }}"
                            placeholder="Contoh: Dokumentasi acara pentas seni"
                            class="@error('keperluan') error @enderror">
                        @error('keperluan')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="form-group full">
                        <label>
                            <span class="required">*</span> Lokasi Penggunaan
                        </label>
                        <input type="text" name="lokasi_penggunaan" required
                            value="{{ old('lokasi_penggunaan') }}"
                            placeholder="Contoh: Aula Sekolah, Lapangan, Kelas XII-1"
                            class="@error('lokasi_penggunaan') error @enderror">
                        @error('lokasi_penggunaan')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="form-group full">
                        <label>
                            Keterangan Tambahan <span class="optional">(Opsional)</span>
                        </label>
                        <textarea name="keterangan" rows="3"
                            placeholder="Catatan khusus untuk petugas..."
                            class="@error('keterangan') error @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Info Penanggung Jawab -->
                <div class="pj-card">
                    <div class="pj-card-header">
                        <span class="icon"></span>
                        <span>Penanggung Jawab</span>
                    </div>
                    <div class="pj-info-grid">
                        <div class="pj-info-item">
                            <span class="label">Nama:</span>
                            <span class="value">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="pj-info-item">
                            <span class="label">NIS:</span>
                            <span class="value">{{ Auth::user()->nis ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="form-actions">
                    <a href="{{ route('siswa.peminjaman.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        📤 Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriSelect = document.getElementById('kategori');
        const alatSelect = document.getElementById('alat_id');
        const stokInfo = document.getElementById('stok_info');
        const stokCount = document.getElementById('stok_count');
        const tanggalPinjam = document.getElementById('tanggal_pinjam');
        const tanggalKembali = document.getElementById('tanggal_kembali');

        // Jika dibuka dari halaman detail alat (?alat_id=X&kategori=Y), langsung pilih alat tsb
        const params = new URLSearchParams(window.location.search);
        const preKategori = params.get('kategori') || @json(old('kategori'));
        const preAlat = params.get('alat_id') || @json(old('alat_id'));

        // Saat kategori berubah, load alat via AJAX
        kategoriSelect.addEventListener('change', function() {
            const kategori = this.value;
            alatSelect.innerHTML = '<option value="">-- Memuat alat... --</option>';
            stokInfo.classList.remove('show');

            if (!kategori) {
                alatSelect.innerHTML = '<option value="">-- Pilih Kategori Terlebih Dahulu --</option>';
                return;
            }

            fetch(`/siswa/peminjaman/alats/${kategori}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Gagal memuat alat (${response.status}).`);
                    }

                    return response.json();
                })
                .then(data => {
                    alatSelect.innerHTML = '<option value="">-- Pilih Alat --</option>';

                    if (data.length === 0) {
                        alatSelect.innerHTML = '<option value="">-- Tidak ada alat tersedia --</option>';
                        return;
                    }

                    // Jika dibuka dari halaman detail alat (?alat_id=X), langsung pilih alat tsb
                    const preselect = preAlat;

                    data.forEach(alat => {
                        const option = document.createElement('option');
                        option.value = alat.id;
                        option.textContent = `${alat.kode_alat} - ${alat.nama_alat} (Stok: ${alat.stok})`;
                        option.dataset.stok = alat.stok;
                        if (preselect && String(alat.id) === preselect) {
                            option.selected = true;
                            stokCount.textContent = alat.stok;
                            stokInfo.classList.add('show');
                        }
                        alatSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alatSelect.innerHTML = '<option value="">-- Gagal memuat alat --</option>';
                });
        });

        // Pasang handler sebelum memuat kategori dari URL atau input sebelumnya.
        if (preKategori) {
                kategoriSelect.value = preKategori;
        }
        if (kategoriSelect.value) {
                kategoriSelect.dispatchEvent(new Event('change'));
        }

        // Saat alat dipilih, tampilkan info stok
        alatSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption && selectedOption.dataset.stok) {
                stokCount.textContent = selectedOption.dataset.stok;
                stokInfo.classList.add('show');
            } else {
                stokInfo.classList.remove('show');
            }
        });

        // Batas awal peminjaman adalah tujuh hari dari tanggal pinjam.
        const updateBatasTanggalKembali = function() {
            if (!tanggalPinjam.value) {
                return;
            }

            const tanggalMaksimal = new Date(`${tanggalPinjam.value}T00:00:00`);
            tanggalMaksimal.setDate(tanggalMaksimal.getDate() + 7);
            const tahun = tanggalMaksimal.getFullYear();
            const bulan = String(tanggalMaksimal.getMonth() + 1).padStart(2, '0');
            const hari = String(tanggalMaksimal.getDate()).padStart(2, '0');
            tanggalKembali.min = tanggalPinjam.value;
            tanggalKembali.max = `${tahun}-${bulan}-${hari}`;

            if (tanggalKembali.value && tanggalKembali.value > tanggalKembali.max) {
                tanggalKembali.value = tanggalKembali.max;
            } else if (tanggalKembali.value && tanggalKembali.value < tanggalKembali.min) {
                tanggalKembali.value = tanggalKembali.min;
            }
        };

        tanggalPinjam.addEventListener('change', function() {
            updateBatasTanggalKembali();
        });
        updateBatasTanggalKembali();
    });
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            const label = sidebar.querySelector('.toggle-label');
            if (label) label.textContent = sidebar.classList.contains('collapsed') ? '' : 'Ciutkan';
        }
    </script>

</body>
</html>