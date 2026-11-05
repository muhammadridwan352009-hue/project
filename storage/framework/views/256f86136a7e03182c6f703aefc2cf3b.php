<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - SIMPATI</title>
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

        .logout-form {
            margin-top: 12px;
        }

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

        .logout-button:hover {
            color: #fff;
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

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Kartu profil */
        .profile-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
        }

        .card h3 {
            font-size: 15px;
            color: #1a202c;
            margin-bottom: 4px;
        }

        .card .card-sub {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
        }

        .profile-identity {
            text-align: center;
        }

        .avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: #00897b;
            color: #fff;
            font-size: 36px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            position: relative;
            overflow: visible;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-actions {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn-foto {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-foto-primary {
            background: #00897b;
            color: #fff;
        }

        .btn-foto-primary:hover {
            background: #00796b;
        }

        .btn-foto-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-foto-danger:hover {
            background: #fecaca;
        }

        .btn-foto-upload {
            display: none;
        }

        .foto-error {
            color: #ef4444;
            font-size: 11px;
            margin-top: 8px;
        }

        .profile-name {
            font-size: 17px;
            font-weight: 700;
            color: #1a202c;
        }

        .profile-role {
            display: inline-block;
            background: #e0f2f1;
            color: #00897b;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            margin-top: 6px;
        }

        .identity-list {
            margin-top: 22px;
            text-align: left;
            font-size: 13px;
            color: #4a5568;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .identity-list .row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 10px;
        }

        .identity-list .row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .identity-list .row span:first-child {
            color: #718096;
        }

        .identity-list .row span:last-child {
            font-weight: 600;
            color: #1a202c;
            text-align: right;
            word-break: break-all;
        }

        /* Form */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            background: #f8fafc;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #00897b;
            background: #fff;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
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

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            gap: 8px;
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        .error-text {
            font-size: 11px;
            color: #ef4444;
            margin-top: 4px;
        }

        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 20px 0;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #00897b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        @media (max-width: 900px) {
            .profile-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            aside {
                width: 190px;
                padding: 16px;
            }

            main {
                padding: 20px 16px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php echo $__env->make('siswa.partials.sidebar', ['active' => 'profil'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


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
                <h1>Profil saya</h1>
            </div>
            </div>
            <div class="user-badge">
                <span class="dot"></span>
                <span><?php echo e($user->name); ?></span>
            </div>
        </header>

        <div class="breadcrumb">
            <a href="/siswa/beranda">Beranda</a> /
            <span style="color:#718096;">Profil saya</span>
        </div>

        <?php if(session('success')): ?>
        <div class="alert-success"><span>✅</span> <?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="profile-layout">
            <!-- Kartu identitas -->
            <div class="card profile-identity">
                <div class="avatar">
                    <?php if($user->foto && file_exists(storage_path('app/public/' . $user->foto))): ?>
                    <img src="<?php echo e(asset('storage/' . $user->foto)); ?>" alt="Foto <?php echo e($user->name); ?>">
                    <?php else: ?>
                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                    <?php endif; ?>
                </div>

                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="foto-error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="avatar-actions">
                    <form method="POST" action="<?php echo e(route('siswa.profil.foto')); ?>" enctype="multipart/form-data" id="form-foto-profil">
                        <?php echo csrf_field(); ?>
                        <input type="file" name="foto" id="input-foto-profil" accept="image/*" class="btn-foto-upload" onchange="document.getElementById('form-foto-profil').submit();">
                        <label for="input-foto-profil" class="btn-foto btn-foto-primary">📷 <?php echo e($user->foto ? 'Ganti foto' : 'Tambah foto'); ?></label>
                    </form>
                    <?php if($user->foto): ?>
                    <form method="POST" action="<?php echo e(route('siswa.profil.foto.hapus')); ?>" onsubmit="return confirm('Hapus foto profil?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-foto btn-foto-danger">🗑️ Hapus foto</button>
                    </form>
                    <?php endif; ?>
                </div>

                <div class="profile-name"><?php echo e($user->name); ?></div>
                <span class="profile-role">👨‍🎓 Siswa</span>

                <div class="identity-list">
                    <div class="row">
                        <span>NIS</span>
                        <span><?php echo e($user->nis ?? '-'); ?></span>
                    </div>
                    <div class="row">
                        <span>Kelas</span>
                        <span><?php echo e($user->kelas ?? '-'); ?></span>
                    </div>
                    <div class="row">
                        <span>Email</span>
                        <span><?php echo e($user->email); ?></span>
                    </div>
                    <div class="row">
                        <span>Anggota sejak</span>
                        <span><?php echo e($user->created_at->translatedFormat('d F Y')); ?></span>
                    </div>
                </div>
            </div>

            <!-- Form edit profil -->
            <div class="card">
                <h3>Edit informasi profil</h3>
                <p class="card-sub">Perbarui data diri dan kata sandi akun kamu.</p>

                <?php if($errors->any()): ?>
                <div class="alert-error"><span>⚠️</span> Terdapat kesalahan pada form, silakan periksa kembali.</div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('siswa.profil.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama lengkap</label>
                            <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>"
                                class="<?php echo e($errors->has('name') ? 'input-error' : ''); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-text"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>"
                                class="<?php echo e($errors->has('email') ? 'input-error' : ''); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-text"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" id="nis" name="nis" value="<?php echo e(old('nis', $user->nis)); ?>"
                                class="<?php echo e($errors->has('nis') ? 'input-error' : ''); ?>" required>
                            <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-text"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" id="kelas" name="kelas" value="<?php echo e(old('kelas', $user->kelas)); ?>"
                                placeholder="Contoh: X RPL 1" class="<?php echo e($errors->has('kelas') ? 'input-error' : ''); ?>">
                            <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-text"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <hr class="divider">

                    <div class="section-title">Ganti kata sandi</div>
                    <p class="card-sub">Kosongkan bagian ini jika tidak ingin mengganti kata sandi.</p>

                    <div class="form-group">
                        <label for="password_lama">Kata sandi lama</label>
                        <input type="password" id="password_lama" name="password_lama"
                            class="<?php echo e($errors->has('password_lama') ? 'input-error' : ''); ?>"
                            placeholder="Masukkan kata sandi saat ini">
                        <?php $__errorArgs = ['password_lama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-text"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Kata sandi baru</label>
                            <input type="password" id="password" name="password"
                                class="<?php echo e($errors->has('password') ? 'input-error' : ''); ?>"
                                placeholder="Minimal 6 karakter">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-text"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi kata sandi baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi kata sandi baru">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 Simpan perubahan</button>
                </form>
            </div>
        </div>
    </main>
    

</body>

</html><?php /**PATH C:\xampp7\htdocs\simpati\resources\views/siswa/profil.blade.php ENDPATH**/ ?>