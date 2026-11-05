<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - SIMPATI</title>
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
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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

        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .title-section h2 {
            font-size: 18px;
            color: #1a202c;
        }

        .title-section p {
            font-size: 13px;
            color: #718096;
            margin-top: 4px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: #00897b;
            color: #fff;
        }

        .btn-primary:hover {
            background: #00796b;
        }

        .btn-light {
            background: #fff;
            color: #2d3748;
            border: 1px solid #e2e8f0;
        }

        /* Stat cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
        }

        .stat-card .number {
            font-size: 24px;
            font-weight: 700;
            color: #1a202c;
        }

        .stat-card .label {
            font-size: 12px;
            color: #718096;
            margin-top: 2px;
        }

        .stat-card.active {
            border-color: #00897b;
            background: #e0f2f1;
        }

        /* Notif card */
        .notif-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .notif-card.belum-dibaca {
            border-left: 4px solid #00897b;
            background: #f0fdfc;
        }

        .notif-icon {
            font-size: 26px;
            line-height: 1;
            margin-top: 2px;
        }

        .notif-body {
            flex: 1;
        }

        .notif-title {
            font-size: 14px;
            font-weight: 700;
            color: #1a202c;
        }

        .notif-message {
            font-size: 13px;
            color: #4a5568;
            margin-top: 4px;
        }

        .notif-time {
            font-size: 11px;
            color: #a0aec0;
            margin-top: 6px;
        }

        .notif-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }

        .notif-badge.disetujui {
            background: #d1fae5;
            color: #047857;
        }

        .notif-badge.ditolak {
            background: #fee2e2;
            color: #b91c1c;
        }

        .notif-badge.dikembalikan {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .notif-badge.menunggu {
            background: #fef3c7;
            color: #b45309;
        }

        .notif-actions {
            display: flex;
            flex-direction: column;
            gap: 6px;
            align-items: flex-end;
        }

        .btn-small {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            white-space: nowrap;
        }

        .unread-dot {
            width: 9px;
            height: 9px;
            background: #00897b;
            border-radius: 50%;
            margin-top: 8px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .empty-state .emoji {
            font-size: 48px;
        }

        .empty-state h3 {
            margin-top: 12px;
            color: #1a202c;
        }

        .empty-state p {
            color: #718096;
            font-size: 13px;
            margin-top: 6px;
        }

        .alert-success {
            background: #d1fae5;
            color: #047857;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            gap: 8px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 6px;
            margin-top: 20px;
            justify-content: center;
        }

        .pagination a,
        .pagination span {
            padding: 8px 14px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            color: #2d3748;
            text-decoration: none;
        }

        .pagination span.active-page {
            background: #00897b;
            color: #fff;
            border-color: #00897b;
        }

        .pagination .disabled {
            color: #cbd5e0;
        }
        
        @media (max-width: 768px) {
            main { padding: 18px 14px; }
            header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .notif-item { padding: 14px; }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php echo $__env->make('siswa.partials.sidebar', ['active' => 'notifikasi'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


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
                <h1>Notifikasi</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span><?php echo e(Auth::user()->name ?? 'Siswa'); ?></span>
            </div>
        </header>

        <div class="breadcrumb">
            <a href="/siswa/beranda" style="color:#00897b; text-decoration:none;">Beranda</a> /
            <span style="color:#718096;">Notifikasi</span>
        </div>

        <div class="title-section">
            <div>
                <h2>Pemberitahuan peminjaman</h2>
                <p>Status peminjaman alat: disetujui, ditolak, dan dikembalikan.</p>
            </div>
            <?php if($belumDibaca > 0): ?>
            <form action="<?php echo e(route('siswa.notifikasi.semua-dibaca')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">✓ Tandai semua dibaca</button>
            </form>
            <?php endif; ?>
        </div>

        <?php if(session('success')): ?>
        <div class="alert-success"><span>✅</span> <?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php
        $totalSemua = $notifikasis->total();
        $totalSetuju = \App\Models\Notifikasi::where('user_id', auth()->id())->where('jenis', 'disetujui')->count();
        $totalTolak = \App\Models\Notifikasi::where('user_id', auth()->id())->where('jenis', 'ditolak')->count();
        $totalKembali= \App\Models\Notifikasi::where('user_id', auth()->id())->where('jenis', 'dikembalikan')->count();
        ?>

        <div class="stats-grid">
            <div class="stat-card active">
                <div class="number"><?php echo e($totalSemua); ?></div>
                <div class="label">Semua</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo e($totalSetuju); ?></div>
                <div class="label">✅ Disetujui</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo e($totalTolak); ?></div>
                <div class="label">❌ Ditolak</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo e($totalKembali); ?></div>
                <div class="label">🔄 Dikembalikan</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo e($belumDibaca); ?></div>
                <div class="label">Belum dibaca</div>
            </div>
        </div>

        
        <?php if($notifikasis->count() > 0): ?>
        <?php $__currentLoopData = $notifikasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="notif-card <?php echo e($notif->dibaca ? '' : 'belum-dibaca'); ?>">
            <div class="notif-icon"><?php echo e($notif->ikon); ?></div>
            <div class="notif-body">
                <div class="notif-title">
                    <?php echo e($notif->judul); ?>

                    <span class="notif-badge <?php echo e($notif->warna); ?>"><?php echo e(ucfirst($notif->jenis)); ?></span>
                </div>
                <div class="notif-message"><?php echo e($notif->pesan); ?></div>
                <div class="notif-time">
                    🕒 <?php echo e($notif->created_at->translatedFormat('d M Y, H:i')); ?>

                    <?php if($notif->peminjaman && $notif->peminjaman->alat): ?>
                    • Alat: <?php echo e($notif->peminjaman->alat->nama_alat); ?>

                    (<?php echo e($notif->peminjaman->alat->kode_alat ?? '-'); ?>)
                    <?php endif; ?>
                </div>
            </div>
            <div class="notif-actions">
                <?php if(!$notif->dibaca): ?>
                <form action="<?php echo e(route('siswa.notifikasi.dibaca', $notif->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-light btn-small">Tandai dibaca</button>
                </form>
                <?php endif; ?>
            </div>
            <?php if(!$notif->dibaca): ?>
            <div class="unread-dot"></div>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($notifikasis->lastPage() > 1): ?>
        <div class="pagination">
            <?php if($notifikasis->onFirstPage()): ?>
            <span class="disabled">‹ Sebelumnya</span>
            <?php else: ?>
            <a href="<?php echo e($notifikasis->previousPageUrl()); ?>">‹ Sebelumnya</a>
            <?php endif; ?>
            <?php $__currentLoopData = $notifikasis->toArray()['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dummy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <span class="active-page"><?php echo e($notifikasis->currentPage()); ?> / <?php echo e($notifikasis->lastPage()); ?></span>
            <?php if($notifikasis->hasMorePages()): ?>
            <a href="<?php echo e($notifikasis->nextPageUrl()); ?>">Selanjutnya ›</a>
            <?php else: ?>
            <span class="disabled">Selanjutnya ›</span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="empty-state">
            <div class="emoji">🔔</div>
            <h3>Belum ada notifikasi</h3>
            <p>Notifikasi akan muncul ketika pengajuan peminjaman alat kamu disetujui, ditolak, atau dikembalikan.</p>
        </div>
        <?php endif; ?>
    </main>
    

</body>

</html><?php /**PATH C:\xampp7\htdocs\simpati\resources\views/siswa/notifikasi.blade.php ENDPATH**/ ?>