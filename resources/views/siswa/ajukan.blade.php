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
            width: 100%;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
            flex-wrap: wrap;
            gap: 12px;
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
            margin-bottom: 20px;
        }
        .breadcrumb a {
            color: #00897b;
            text-decoration: none;
        }

        /* Form Card Container */
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 30px;
            max-width: 800px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            margin-bottom: 40px;
        }
        .form-header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }
        .form-header h2 {
            font-size: 18px;
            color: #071b26;
            font-weight: 800;
            margin-bottom: 4px;
        }
        .form-header p {
            font-size: 13px;
            color: #64748b;
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            color: #1e293b;
            background-color: #fff;
            transition: 0.2s;
        }
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0, 137, 123, 0.1);
        }

        /* Grid for Dates & Number */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* Category Radio/Pill Group */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .category-option {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            background: #fff;
            transition: 0.2s;
        }
        .category-option input {
            display: none;
        }
        .category-option:hover {
            border-color: #94a3b8;
            background: #f8fafc;
        }
        .category-option.selected {
            border-color: #00897b;
            background-color: #e6f4f1;
            color: #00695c;
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
          justify-end: flex-end; /* Diperbaiki dari justify-end ke justify-content */
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }
        .btn-cancel {
            background-color: #f1f5f9;
            color: #475569;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
        }
        .btn-cancel:hover {
            background-color: #e2e8f0;
        }
        .btn-submit {
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-submit:hover {
            background-color: #00796b;
        }

        /* Responsive Layout */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            aside {
                width: 100%;
                flex-direction: row;
                align-items: center;
                padding: 16px;
            }
            aside nav {
                display: flex;
                gap: 6px;
            }
            aside .brand, aside .sidebar-footer, aside .menu-label {
                display: none;
            }
            main {
                padding: 20px 16px;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    @include('siswa.partials.sidebar', ['active' => 'peminjaman'])


    <!-- Konten Utama Form Ajukan Peminjaman -->
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
                <h1>Formulir Peminjaman Alat</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="breadcrumb">
            <a href="/siswa/peminjaman">Peminjaman saya</a> / Ajukan peminjaman
        </div>

        <div class="form-card">
            <div class="form-header">
                <h2>Form Pengajuan Peminjaman Alat</h2>
                <p>Lengkapi formulir di bawah ini untuk mengajukan peminjaman inventaris sekolah.</p>
            </div>

            <form action="/siswa/peminjaman/proses" method="POST">
                
                <!-- 1. Organisasi / Ekstrakurikuler -->
                <div class="form-group">
                    <label class="form-label">Organisasi / Ekstrakurikuler</label>
                    <div class="category-grid">
                        <label class="category-option selected" onclick="selectCategory(this)">
                            <input type="radio" name="organisasi" value="multimedia" checked> 🎥 Multimedia
                        </label>
                        <label class="category-option" onclick="selectCategory(this)">
                            <input type="radio" name="organisasi" value="rohis"> ☪️ Rohis
                        </label>
                        <label class="category-option" onclick="selectCategory(this)">
                            <input type="radio" name="organisasi" value="band"> 🎸 Band
                        </label>
                        <label class="category-option" onclick="selectCategory(this)">
                            <input type="radio" name="organisasi" value="osis"> 🏛️ OSIS
                        </label>
                    </div>
                </div>

                <!-- 2. Pilih Alat & 3. Jumlah -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="alat">Pilih Alat</label>
                        <select id="alat" name="alat_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih alat --</option>
                            <option value="MM-CAM-014">Kamera Sony Alpha A6400</option>
                            <option value="MM-TRP-021">Tripod Video Manfrotto</option>
                            <option value="BND-MIC-082">Mikrofon Wireless Shure</option>
                            <option value="RHS-SND-011">Sound Portable Majelis</option>
                            <option value="OS-MGF-003">Megafon TOA ER-1215</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control" min="1" value="1" required>
                    </div>
                </div>

                <!-- 4. Tanggal Peminjaman & 5. Tanggal Pengembalian -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="tgl_peminjaman">Tanggal Peminjaman</label>
                        <input type="date" id="tgl_peminjaman" name="tgl_peminjaman" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tgl_pengembalian">Tanggal Pengembalian</label>
                        <input type="date" id="tgl_pengembalian" name="tgl_pengembalian" class="form-control" required>
                    </div>
                </div>

                <!-- 6. Keperluan Peminjaman -->
                <div class="form-group">
                    <label class="form-label" for="keperluan">Keperluan Peminjaman</label>
                    <textarea id="keperluan" name="keperluan" rows="3" class="form-control" placeholder="Contoh: Dokumentasi kegiatan pentas seni sekolah..." required></textarea>
                </div>

                <!-- 7. Lokasi Penggunaan -->
                <div class="form-group">
                    <label class="form-label" for="lokasi">Lokasi Penggunaan</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Contoh: Lapangan Utama / Aula Sekolah / Studio Multimedia" required>
                </div>

                <!-- 8. Catatan Tambahan -->
                <div class="form-group">
                    <label class="form-label" for="catatan">Catatan Tambahan (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="2" class="form-control" placeholder="Tambahan informasi jika ada..."></textarea>
                </div>

                <!-- 9. Bagian Bawah: Batal | Tombol Submit -->
                <div class="form-actions">
                    <a href="/siswa/peminjaman" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Ajukan Peminjaman</button>
                </div>

            </form>
        </div>
    </main>

    <script>
        function selectCategory(element) {
            document.querySelectorAll('.category-option').forEach(el => {
                el.classList.remove('selected');
            });
            element.classList.add('selected');
            element.querySelector('input').checked = true;
        }
    </script>
    

</body>
</html>