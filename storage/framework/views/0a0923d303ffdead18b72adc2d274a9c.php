<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat - SIMPATI</title>
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

        /* Banner Section */
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
        /* Search & Filter Bar */
        .filter-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 28px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .filter-top {
            display: flex;
            gap: 12px;
            margin-bottom: 14px;
        }
        .search-box {
            flex: 1;
            display: flex;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            gap: 10px;
        }
        .search-box input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            font-size: 13px;
            color: #333;
        }
        .filter-tags {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .tags-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .tag {
            background: #f1f5f9;
            color: #64748b;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }
        .tag.active {
            background: #071b26;
            color: #fff;
        }
        .tag-info {
            font-size: 11px;
            color: #94a3b8;
        }

        /* Grid Produk */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .item-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .item-card[hidden],
        #catalog-no-results[hidden] {
            display: none;
        }
        #catalog-no-results {
            grid-column: 1 / -1;
            padding: 16px;
            text-align: center;
        }
        .card-img-wrapper {
            position: relative;
            width: 100%;
            height: 160px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .card-img-wrapper img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }
        .placeholder-text {
            position: relative;
            font-size: 14px;
            font-weight: bold;
            color: #64748b;
            z-index: 0;
        }
        .badge-code {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: bold;
            color: #071b26;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .badge-code .cat {
            color: #7c3aed;
            font-size: 9px;
            text-transform: uppercase;
        }
        .badge-code .cat.band { color: #ea580c; }
        .badge-code .cat.osis { color: #0284c7; }
        .badge-code .cat.rohis { color: #059669; }

        .btn-fav {
            position: absolute;
            bottom: 12px;
            left: 12px;
            z-index: 2;
            width: 30px;
            height: 30px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            border: none;
            cursor: pointer;
        }

        .card-body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .item-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .item-loc {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 12px;
        }
        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }
        .stock-badge {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
        }
        .stock-badge.ready { background: #d1fae5; color: #047857; }
        .stock-badge.busy { background: #fee2e2; color: #dc2626; }
        .condition {
            font-size: 10px;
            color: #94a3b8;
        }

        .btn-action {
            width: 100%;
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: 0.2s;
        }
        .btn-action:hover { background-color: #00796b; }
        .btn-action.disabled {
            background-color: #fff;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        
        @media (max-width: 1024px) {
            .catalog-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .title-section { flex-direction: column; align-items: flex-start; gap: 6px; }
            .title-section h2 { font-size: 18px; }
            .filter-card { padding: 14px; }
            .filter-top { flex-direction: column; }
            .filter-tags { flex-direction: column; align-items: flex-start; gap: 8px; }
        }
        @media (max-width: 480px) {
            .catalog-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    <?php echo $__env->make('siswa.partials.sidebar', ['active' => 'katalog'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


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
                <h1>Katalog alat</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span><?php echo e(Auth::user()->name); ?></span>
            </div>
        </header>

        <div class="breadcrumb">Beranda / Katalog alat</div>

        <div class="title-section">
            <div>
                <h2>Temukan alat untuk kegiatanmu</h2>
                <p><?php echo e($alats->count()); ?> alat dari <?php echo e($alats->pluck('kategori')->unique()->count()); ?> kategori.</p>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="filter-card">
            <div class="filter-top">
                <div class="search-box">
                    <input id="catalog-search" type="search" placeholder="Cari nama, kode inventaris, lokasi, atau kategori..." aria-label="Cari alat">
                </div>
            </div>

            <div class="filter-tags">
                <div class="tags-group">
                    <a href="#" class="tag active">Semua alat · <?php echo e($alats->count()); ?></a>
                    <?php $__currentLoopData = $alats->groupBy('kategori'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori => $alatKategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#" class="tag"><?php echo e(ucfirst($kategori)); ?> · <?php echo e($alatKategori->count()); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="tag-info" id="catalog-result-count">Menampilkan <?php echo e($alats->count()); ?> alat</div>
            </div>
        </div>

       <!-- Catalog Grid -->
       <div class="catalog-grid">
           <?php $__currentLoopData = $alats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="item-card" data-search="<?php echo e(strtolower($alat->nama_alat . ' ' . ($alat->kode_alat ?? '') . ' ' . ($alat->lokasi ?? '') . ' ' . ($alat->kategori ?? ''))); ?>">
               <div class="card-img-wrapper">
                   <img
                       src="<?php echo e(asset($alat->foto_katalog)); ?>"
                       alt="Foto <?php echo e($alat->nama_alat); ?>"
                       loading="lazy"
                   >
                   <div class="badge-code">
                        <span><?php echo e($alat->kode_alat ?? 'MM-CAM-014'); ?></span>
                        <span class="cat"><?php echo e($alat->kategori ?? 'MULTIMEDIA'); ?></span>
                    </div>
                    <button class="btn-fav">â™¡</button>
                </div>
                <div class="card-body">
                    <div>
                        <div class="item-title"><?php echo e($alat->nama_alat); ?></div>
                        <div class="item-loc"><?php echo e(ucfirst($alat->kategori ?? 'multimedia')); ?></div>
                    </div>
                    <div>
                        <div class="card-meta">
                            <span class="stock-badge ready"><?php echo e($alat->stok ?? 3); ?> tersedia</span>
                            <span class="condition"><?php echo e($alat->kondisi ?? 'Kondisi baik'); ?></span>
                        </div>
                       
<a href="<?php echo e(route('siswa.katalog.show', $alat->id)); ?>"
   class="btn-action">
    Lihat detail
</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <p class="tag-info" id="catalog-no-results" hidden>Tidak ada alat yang cocok dengan pencarian.</p>
        </div>
        <script>
            const catalogSearch = document.getElementById('catalog-search');
            const catalogItems = document.querySelectorAll('.item-card');
            const resultCount = document.getElementById('catalog-result-count');
            const noResults = document.getElementById('catalog-no-results');

            catalogSearch.addEventListener('input', () => {
                const query = catalogSearch.value.trim().toLocaleLowerCase('id');
                let visibleCount = 0;

                catalogItems.forEach((item) => {
                    const matches = item.dataset.search.includes(query);
                    item.hidden = !matches;
                    if (matches) visibleCount++;
                });

                resultCount.textContent = `Menampilkan ${visibleCount} alat`;
                noResults.hidden = visibleCount > 0;
            });
        </script>
    

</body>
</html>
<?php /**PATH C:\xampp7\htdocs\simpati\resources\views/siswa/katalog.blade.php ENDPATH**/ ?>