<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - SIMPATI</title>
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
            min-height: 100vh;
            display: flex;
        }
        .container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        .panel-left {
            width: 45%;
            background-color: #071b26;
            color: #fff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
        }
        .badge-sub {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 16px;
        }
        .panel-left h1 {
            font-size: 28px;
            line-height: 1.3;
            margin-bottom: 16px;
            font-weight: 600;
            font-style: italic;
        }
        .panel-left p {
            font-size: 13px;
            color: #a0aec0;
        }
        .footer-left {
            font-size: 12px;
            color: #718096;
        }
        .panel-right {
            width: 55%;
            background-color: #f4f6f8;
            padding: 40px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .form-wrapper {
            width: 100%;
            max-width: 460px;
        }
        .back-link {
            font-size: 12px;
            color: #718096;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 24px;
        }
        .back-link:hover {
            color: #1a202c;
        }
        .card-form {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .card-form h2 {
            font-size: 22px;
            color: #1a202c;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .intro {
            font-size: 12px;
            color: #718096;
            margin-bottom: 24px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 12px 14px;
            font-size: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: 0.2s;
        }
        .form-control:focus {
            border-color: #00897b;
            box-shadow: 0 0 0 3px rgba(0,137,123,0.1);
        }
        .field-error {
            color: #c0392b;
            font-size: 12px;
            margin-top: 4px;
        }
        .btn-submit {
            width: 100%;
            background-color: #00897b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-submit:hover {
            background-color: #00796b;
        }
        .btn-submit:focus-visible,
        .back-link:focus-visible,
        .login-link:focus-visible {
            outline: 3px solid rgba(0,137,123,0.35);
            outline-offset: 3px;
        }
        .login-note {
            margin-top: 18px;
            text-align: center;
            font-size: 12px;
            color: #718096;
        }
        .login-link {
            color: #00897b;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 900px) {
            .panel-left {
                padding: 40px 32px;
            }
            .panel-right {
                padding: 32px;
            }
        }
        @media (max-width: 680px) {
            .panel-left {
                display: none;
            }
            .panel-right {
                width: 100%;
                min-height: 100vh;
                padding: 28px 20px;
            }
            .card-form {
                padding: 26px 22px;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <aside class="panel-left">
            <div class="brand">SIMPATI</div>
            <div>
                <span class="badge-sub">AKSES SISWA • SMK NEGERI 5 SURAKARTA</span>
                <h1>Mulai gunakan inventaris sekolah dengan akun siswa Anda.</h1>
                <p>Daftarkan data diri dan akun sekolah untuk mengakses layanan peminjaman.</p>
            </div>
            <div class="footer-left">Portal Inventaris Sarpras &amp; Prasarana</div>
        </aside>

        <section class="panel-right">
            <div class="form-wrapper">
                <a href="<?php echo e(route('login.siswa')); ?>" class="back-link">‹ Kembali ke login siswa</a>

                <div class="card-form">
                    <h2>Daftar sebagai Siswa</h2>
                    <p class="intro">Isi data berikut untuk membuat akun SIMPATI.</p>

                    <form method="POST" action="<?php echo e(route('register.siswa.proses')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" class="form-control" autocomplete="name" maxlength="255" aria-invalid="<?php echo e($errors->has('name') ? 'true' : 'false'); ?>" <?php if($errors->has('name')): ?> aria-describedby="name-error" <?php endif; ?> required autofocus>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div id="name-error" class="field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" id="nis" name="nis" value="<?php echo e(old('nis')); ?>" class="form-control" inputmode="numeric" pattern="[0-9]{5,20}" minlength="5" maxlength="20" autocomplete="off" aria-describedby="nis-hint <?php if($errors->has('nis')): ?> nis-error <?php endif; ?>" aria-invalid="<?php echo e($errors->has('nis') ? 'true' : 'false'); ?>" required>
                            <small id="nis-hint">Masukkan minimal 5 digit angka.</small>
                            <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div id="nis-error" class="field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="tingkat_kelas">Tingkat Kelas</label>
                            <select id="tingkat_kelas" name="tingkat_kelas" class="form-control" aria-invalid="<?php echo e($errors->has('tingkat_kelas') ? 'true' : 'false'); ?>" <?php if($errors->has('tingkat_kelas')): ?> aria-describedby="tingkat-kelas-error" <?php endif; ?> required>
                                <option value="">Pilih tingkat kelas</option>
                                <?php $__currentLoopData = ['X', 'XI', 'XII']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tingkat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tingkat); ?>" <?php if(old('tingkat_kelas') === $tingkat): echo 'selected'; endif; ?>><?php echo e($tingkat); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tingkat_kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div id="tingkat-kelas-error" class="field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select id="jurusan" name="jurusan" class="form-control" aria-invalid="<?php echo e($errors->has('jurusan') ? 'true' : 'false'); ?>" <?php if($errors->has('jurusan')): ?> aria-describedby="jurusan-error" <?php endif; ?> required>
                                <option value="">Pilih jurusan</option>
                                <?php $__currentLoopData = [
                                    'DPIB' => '(DPIB) Desain Pemodelan dan Informasi Bangunan',
                                    'BKP' => '(BKP) Bisnis Konstruksi dan Properti',
                                    'TOI' => '(TOI) Teknik Otomasi Industri',
                                    'TITL' => '(TITL) Teknik Instalasi Tenaga Listrik',
                                    'TEI' => '(TEI) Teknik Elektronika Industri',
                                    'TP' => '(TP) Teknik Pemesinan',
                                    'TKRO' => '(TKRO) Teknik Kendaraan Ringan Otomotif',
                                    'TBSM' => '(TBSM) Teknik dan Bisnis Sepeda Motor',
                                    'RPL' => '(RPL) Rekayasa Perangkat Lunak',
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kode => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kode); ?>" <?php if(old('jurusan') === $kode): echo 'selected'; endif; ?>><?php echo e($nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div id="jurusan-error" class="field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Sekolah</label>
                            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" autocomplete="email" maxlength="255" aria-invalid="<?php echo e($errors->has('email') ? 'true' : 'false'); ?>" <?php if($errors->has('email')): ?> aria-describedby="email-error" <?php endif; ?> required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div id="email-error" class="field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" minlength="6" aria-describedby="password-hint <?php if($errors->has('password')): ?> password-error <?php endif; ?>" aria-invalid="<?php echo e($errors->has('password') ? 'true' : 'false'); ?>" required>
                            <small id="password-hint">Kata sandi minimal 6 karakter.</small>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div id="password-error" class="field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" aria-invalid="<?php echo e($errors->has('password') ? 'true' : 'false'); ?>" <?php if($errors->has('password')): ?> aria-describedby="password-error" <?php endif; ?> required>
                        </div>

                        <button type="submit" class="btn-submit">Daftar</button>
                    </form>

                    <p class="login-note">
                        Sudah punya akun?
                        <a href="<?php echo e(route('login.siswa')); ?>" class="login-link">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
<?php /**PATH C:\xampp7\htdocs\simpati\resources\views/auth/register-siswa.blade.php ENDPATH**/ ?>