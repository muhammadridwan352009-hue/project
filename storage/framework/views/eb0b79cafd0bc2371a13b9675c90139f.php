<!-- Sidebar Partial Petugas SIMPATI -->
<style>
    /* Styling Dasar Sidebar Petugas SIMPATI */
    #sidebar {
        width: 260px !important;
        min-width: 260px !important;
        max-width: 260px !important;
        background: linear-gradient(180deg, #071b26 0%, #05141c 100%) !important;
        color: #fff !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        padding: 20px 14px 18px 14px !important;
        flex-shrink: 0 !important;
        min-height: 100vh !important;
        height: 100vh !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 100 !important;
        box-shadow: 4px 0 24px rgba(0, 0, 0, 0.22) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
        transition: width 0.28s cubic-bezier(0.4, 0, 0.2, 1), 
                    min-width 0.28s cubic-bezier(0.4, 0, 0.2, 1), 
                    max-width 0.28s cubic-bezier(0.4, 0, 0.2, 1), 
                    padding 0.28s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.28s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-sizing: border-box !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }

    /* Scrollbar halus untuk sidebar */
    #sidebar::-webkit-scrollbar {
        width: 4px;
    }
    #sidebar::-webkit-scrollbar-track {
        background: transparent;
    }
    #sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 4px;
    }
    #sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    /* Header Sidebar (Logo + Judul + Toggle Button) */
    #sidebar .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding-bottom: 16px;
        margin-bottom: 18px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        min-height: 48px;
    }

    #sidebar .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: inherit;
        overflow: hidden;
        flex: 1;
        transition: opacity 0.2s ease;
    }

    #sidebar .sidebar-brand-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 137, 123, 0.28);
        overflow: hidden;
        padding: 3px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    #sidebar .sidebar-brand-icon img.brand-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    #sidebar .sidebar-brand-icon .brand-fallback-icon {
        font-size: 22px;
        line-height: 1;
    }

    #sidebar .brand-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
        white-space: nowrap;
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    #sidebar .brand-name {
        font-size: 18px;
        font-weight: 800;
        letter-spacing: 1.2px;
        color: #ffffff;
        line-height: 1.1;
    }

    #sidebar .brand-sub {
        font-size: 9.5px;
        font-weight: 700;
        letter-spacing: 0.6px;
        color: #2dd4bf;
        text-transform: uppercase;
        background: rgba(45, 212, 191, 0.12);
        padding: 2px 7px;
        border-radius: 5px;
        width: fit-content;
        border: 1px solid rgba(45, 212, 191, 0.2);
    }

    /* Tombol Toggle / Ciutkan (Icon Chevron) */
    #sidebar .sidebar-toggle-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #94a3b8;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0;
    }

    #sidebar .sidebar-toggle-btn:hover {
        background: #00897b;
        border-color: #00897b;
        color: #ffffff;
        transform: scale(1.06);
        box-shadow: 0 3px 10px rgba(0, 137, 123, 0.4);
    }

    #sidebar .sidebar-toggle-btn .toggle-icon {
        transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Section Label */
    #sidebar .sidebar-section-label {
        font-size: 10.5px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        padding: 0 10px;
        margin-bottom: 8px;
        white-space: nowrap;
        transition: opacity 0.2s ease;
    }

    /* Navigasi Links */
    #sidebar nav {
        display: flex;
        flex-direction: column;
        gap: 5px;
        width: 100%;
    }

    #sidebar nav a.nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #94a3b8;
        text-decoration: none;
        padding: 10.5px 14px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 500;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        white-space: nowrap;
        border: 1px solid transparent;
        box-sizing: border-box;
    }

    #sidebar nav a.nav-item:hover:not(.active) {
        background: rgba(255, 255, 255, 0.06);
        color: #ffffff;
        transform: translateX(3px);
    }

    #sidebar nav a.nav-item.active {
        background: linear-gradient(135deg, #00897b 0%, #00695c 100%) !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 14px rgba(0, 137, 123, 0.38) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
    }

    #sidebar nav a.nav-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 22%;
        bottom: 22%;
        width: 3.5px;
        border-radius: 0 4px 4px 0;
        background: #5eead4;
    }

    #sidebar .nav-icon {
        font-size: 17px;
        line-height: 1;
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
    }

    #sidebar .nav-text {
        flex: 1;
        transition: opacity 0.2s ease;
    }

    #sidebar .nav-badge {
        background: #ea580c;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 12px;
        margin-left: auto;
        box-shadow: 0 2px 6px rgba(234, 88, 12, 0.4);
    }

    #sidebar .badge-dot {
        position: absolute;
        top: -2px;
        right: -3px;
        width: 9px;
        height: 9px;
        background: #ea580c;
        border-radius: 50%;
        border: 2px solid #071b26;
        display: none;
        box-shadow: 0 0 6px rgba(234, 88, 12, 0.8);
    }

    /* Footer & Logout */
    #sidebar .sidebar-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding-top: 14px;
        margin-top: 18px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #sidebar .sidebar-footer-info {
        font-size: 11px;
        color: #64748b;
        line-height: 1.4;
        padding: 0 6px;
        transition: opacity 0.2s ease;
    }

    #sidebar .sidebar-footer-info .footer-title {
        color: #94a3b8;
        font-weight: 600;
        font-size: 11.5px;
    }

    #sidebar .sidebar-logout-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(239, 68, 68, 0.08);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.18);
        padding: 9.5px 14px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        box-sizing: border-box;
    }

    #sidebar .sidebar-logout-btn:hover {
        background: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
    }

    /* ========================================================== */
    /* MODE COLLAPSED (CIUTKAN / MINI SIDEBAR 72px)              */
    /* ========================================================== */
    #sidebar.collapsed {
        width: 72px !important;
        min-width: 72px !important;
        max-width: 72px !important;
        padding: 18px 8px !important;
        align-items: center !important;
    }

    #sidebar.collapsed .sidebar-header {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding-bottom: 12px;
        margin-bottom: 14px;
        gap: 10px;
    }

    #sidebar.collapsed .sidebar-brand {
        justify-content: center;
        width: 100%;
        margin: 0;
    }

    #sidebar.collapsed .brand-text,
    #sidebar.collapsed .sidebar-section-label,
    #sidebar.collapsed .nav-text,
    #sidebar.collapsed .nav-badge,
    #sidebar.collapsed .sidebar-footer-info {
        display: none !important;
    }

    #sidebar.collapsed .sidebar-toggle-btn {
        width: 32px;
        height: 32px;
        margin: 0 auto;
    }

    #sidebar.collapsed .sidebar-toggle-btn .toggle-icon {
        transform: rotate(180deg);
    }

    #sidebar.collapsed nav {
        width: 100%;
        align-items: center;
    }

    #sidebar.collapsed nav a.nav-item {
        justify-content: center;
        padding: 0 !important;
        width: 44px !important;
        height: 44px !important;
        margin: 4px auto !important;
        border-radius: 10px !important;
        position: relative;
    }

    #sidebar.collapsed nav a.nav-item:hover:not(.active) {
        transform: scale(1.08);
    }

    #sidebar.collapsed .nav-icon {
        width: 24px;
        font-size: 19px;
    }

    #sidebar.collapsed .badge-dot {
        display: block !important;
    }

    #sidebar.collapsed .sidebar-bottom {
        width: 100%;
        padding-top: 10px;
        align-items: center;
    }

    #sidebar.collapsed .sidebar-logout-btn {
        justify-content: center;
        padding: 0 !important;
        width: 44px !important;
        height: 44px !important;
        margin: 0 auto;
        border-radius: 10px;
    }

    #sidebar.collapsed .sidebar-logout-btn .nav-text {
        display: none !important;
    }

    /* Floating Tooltip saat sidebar ciut */
    #sidebar.collapsed nav a.nav-item::after,
    #sidebar.collapsed .sidebar-logout-btn::after {
        content: attr(data-tooltip);
        position: absolute;
        left: calc(100% + 12px);
        top: 50%;
        transform: translateY(-50%);
        background: #0f2d3d;
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.12);
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.15s ease, transform 0.15s ease;
        z-index: 1000;
    }

    #sidebar.collapsed nav a.nav-item:hover::after,
    #sidebar.collapsed .sidebar-logout-btn:hover::after {
        opacity: 1;
        visibility: visible;
        transform: translateY(-50%) translateX(2px);
    }

    /* Backdrop untuk Mobile */
    .sidebar-backdrop {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 99;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
    }

    /* Tombol Toggle di Top Header Main Content */
    .header-sidebar-toggle-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #334155;
        cursor: pointer;
        margin-right: 12px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        flex-shrink: 0;
    }

    .header-sidebar-toggle-btn:hover {
        background: #f1f5f9;
        color: #00897b;
        border-color: #00897b;
        transform: scale(1.04);
    }

    /* ========================================================== */
    /* RESPONSIVE MOBILE & TABLET                                */
    /* ========================================================== */
    @media (max-width: 768px) {
        #sidebar {
            position: fixed !important;
            left: -290px !important;
            top: 0 !important;
            bottom: 0 !important;
            width: 260px !important;
            min-width: 260px !important;
            max-width: 260px !important;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 10px 0 30px rgba(0,0,0,0.4) !important;
        }

        #sidebar.mobile-open {
            left: 0 !important;
        }

        .sidebar-backdrop.active {
            display: block;
        }
    }
</style>

<!-- Script inisialisasi awal cegah kedipan (FOUC) -->
<script>
    (function() {
        try {
            if (localStorage.getItem('simpati_sidebar_collapsed') === 'true' && window.innerWidth > 768) {
                document.write('<style>#sidebar{width:72px!important;min-width:72px!important;max-width:72px!important;padding:18px 8px!important;}#sidebar .sidebar-header{flex-direction:column!important;justify-content:center!important;padding-bottom:12px!important;margin-bottom:14px!important;gap:10px!important;}#sidebar .sidebar-brand{justify-content:center!important;}#sidebar .brand-text,#sidebar .sidebar-section-label,#sidebar .nav-text,#sidebar .nav-badge,#sidebar .sidebar-footer-info{display:none!important;}#sidebar .sidebar-toggle-btn .toggle-icon{transform:rotate(180deg)!important;}#sidebar nav a.nav-item{justify-content:center!important;padding:0!important;width:44px!important;height:44px!important;margin:4px auto!important;border-radius:10px!important;}#sidebar .badge-dot{display:block!important;}#sidebar .sidebar-logout-btn{justify-content:center!important;padding:0!important;width:44px!important;height:44px!important;margin:0 auto!important;}#sidebar .sidebar-logout-btn .nav-text{display:none!important;}</style>');
            }
        } catch(e) {}
    })();
</script>

<!-- Backdrop Mobile -->
<div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar(false)"></div>

<!-- Komponen Sidebar Utama Petugas -->
<aside id="sidebar">
    <div>
        <!-- Bagian Atas: Logo & Tombol Toggle -->
        <div class="sidebar-header">
            <a href="<?php echo e(route('petugas.dashboard')); ?>" class="sidebar-brand" title="SIMPATI - Ruang Petugas">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo e(asset('SIMPATI Inventory Equipment Logo.png')); ?>" alt="Logo SIMPATI" class="brand-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                    <span class="brand-fallback-icon" style="display:none;">📦</span>
                </div>
                <div class="brand-text">
                    <span class="brand-name">SIMPATI</span>
                    <span class="brand-sub">Ruang Petugas</span>
                </div>
            </a>
            <button type="button" class="sidebar-toggle-btn" id="sidebarToggleBtn" onclick="toggleSidebar()" title="Sembunyikan / Ciutkan sidebar">
                <svg class="toggle-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
        </div>

        <!-- Label Menu -->
        <div class="sidebar-section-label">Navigasi Utama</div>

        <!-- Daftar Menu -->
        <nav>
            <a href="<?php echo e(route('petugas.dashboard')); ?>" class="nav-item <?php echo e(($active ?? '') === 'dashboard' ? 'active' : ''); ?>" title="Dashboard" data-tooltip="Dashboard">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9"></rect>
                        <rect x="14" y="3" width="7" height="5"></rect>
                        <rect x="14" y="12" width="7" height="9"></rect>
                        <rect x="3" y="16" width="7" height="5"></rect>
                    </svg>
                </span>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="<?php echo e(route('petugas.inventaris.index')); ?>" class="nav-item <?php echo e(($active ?? '') === 'inventaris' ? 'active' : ''); ?>" title="Inventaris" data-tooltip="Inventaris">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </span>
                <span class="nav-text">Inventaris</span>
            </a>
            <a href="<?php echo e(route('petugas.persetujuan')); ?>" class="nav-item <?php echo e(($active ?? '') === 'persetujuan' ? 'active' : ''); ?>" title="Persetujuan" data-tooltip="Persetujuan<?php echo e(!empty($menungguCount) && $menungguCount > 0 ? ' (' . $menungguCount . ')' : ''); ?>">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <?php if(!empty($menungguCount) && $menungguCount > 0): ?>
                        <span class="badge-dot"></span>
                    <?php endif; ?>
                </span>
                <span class="nav-text">Persetujuan</span>
                <?php if(!empty($menungguCount) && $menungguCount > 0): ?>
                    <span class="nav-badge"><?php echo e($menungguCount); ?></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo e(route('petugas.pengembalian')); ?>" class="nav-item <?php echo e(($active ?? '') === 'pengembalian' ? 'active' : ''); ?>" title="Pengembalian" data-tooltip="Pengembalian">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"></polyline>
                        <polyline points="23 20 23 14 17 14"></polyline>
                        <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                    </svg>
                </span>
                <span class="nav-text">Pengembalian</span>
            </a>
            <a href="<?php echo e(route('petugas.laporan')); ?>" class="nav-item <?php echo e(($active ?? '') === 'laporan' ? 'active' : ''); ?>" title="Laporan" data-tooltip="Laporan">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                </span>
                <span class="nav-text">Laporan</span>
            </a>
            <a href="<?php echo e(route('petugas.profil')); ?>" class="nav-item <?php echo e(($active ?? '') === 'profil' ? 'active' : ''); ?>" title="Profil saya" data-tooltip="Profil saya">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </span>
                <span class="nav-text">Profil saya</span>
            </a>
        </nav>
    </div>

    <!-- Bagian Bawah: Info & Logout -->
    <div class="sidebar-bottom">
        <div class="sidebar-footer-info">
            <div class="footer-title">SMK Negeri 5 Surakarta</div>
            <div>Bantuan Sarpras • SIMPATI v1.4</div>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin: 0;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="sidebar-logout-btn" title="Keluar dari akun" data-tooltip="Keluar">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </span>
                <span class="nav-text">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    function applySidebarState() {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return;
        const isCollapsed = localStorage.getItem('simpati_sidebar_collapsed') === 'true';
        if (window.innerWidth > 768) {
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
            } else {
                sidebar.classList.remove('collapsed');
            }
        }
    }

    function toggleSidebar(forceState) {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if (!sidebar) return;

        const isMobile = window.innerWidth <= 768;

        if (isMobile) {
            if (typeof forceState === 'boolean') {
                sidebar.classList.toggle('mobile-open', forceState);
                if (backdrop) backdrop.classList.toggle('active', forceState);
            } else {
                const isOpen = sidebar.classList.toggle('mobile-open');
                if (backdrop) backdrop.classList.toggle('active', isOpen);
            }
        } else {
            const willCollapse = typeof forceState === 'boolean' 
                ? forceState 
                : !sidebar.classList.contains('collapsed');
            
            if (willCollapse) {
                sidebar.classList.add('collapsed');
            } else {
                sidebar.classList.remove('collapsed');
            }
            try {
                localStorage.setItem('simpati_sidebar_collapsed', willCollapse ? 'true' : 'false');
            } catch(e) {}
        }
    }

    // Inisialisasi setelah DOM dimuat
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', applySidebarState);
    } else {
        applySidebarState();
    }

    // Pastikan Favicon SIMPATI terpasang di Head browser
    (function() {
        const setFavicon = () => {
            let icon = document.querySelector("link[rel~='icon']");
            if (!icon) {
                icon = document.createElement('link');
                icon.rel = 'icon';
                document.head.appendChild(icon);
            }
            icon.type = 'image/png';
            icon.href = "<?php echo e(asset('favicon.png')); ?>";

            let appleIcon = document.querySelector("link[rel='apple-touch-icon']");
            if (!appleIcon) {
                appleIcon = document.createElement('link');
                appleIcon.rel = 'apple-touch-icon';
                document.head.appendChild(appleIcon);
            }
            appleIcon.href = "<?php echo e(asset('apple-touch-icon.png')); ?>";
        };
        if (document.head) {
            setFavicon();
        } else {
            document.addEventListener('DOMContentLoaded', setFavicon);
        }
    })();
</script>
<?php /**PATH C:\xampp7\htdocs\simpati\resources\views/petugas/partials/sidebar.blade.php ENDPATH**/ ?>