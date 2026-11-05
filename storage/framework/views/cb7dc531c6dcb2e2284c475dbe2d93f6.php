<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPATI - Pilih Peran</title>
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
        /* Panel Kiri */
        .panel-left {
            width: 45%;
            background-color: #071b26;
            color: #fff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .brand-logo {
            display: block;
            width: min(230px, 100%);
            aspect-ratio: 1;
            object-fit: contain;
            padding: 8px;
            border-radius: 18px;
            background: #fff;
            align-self: center;
            margin-top: -20px;
        }
        .panel-left h1 {
            font-size: 38px;
            line-height: 1.2;
            margin-bottom: 16px;
            font-weight: bold;
        }
        .panel-left p {
            font-size: 14px;
            color: #a0aec0;
            line-height: 1.6;
        }
        .footer-left {
            font-size: 12px;
            color: #718096;
        }

        /* Animasi ketik (typewriter) */
        .hero-text h1 {
            min-height: 3.6em;
        }
        .hero-text h1 .cursor {
            display: inline-block;
            width: 3px;
            height: 1em;
            background: #00897b;
            margin-left: 2px;
            vertical-align: middle;
            animation: blink 0.7s step-end infinite;
        }
        @keyframes blink {
            50% { opacity: 0; }
        }
        .hero-text p {
            color: #a0aec0;
        }

        /* Panel Kanan */
        .panel-right {
            width: 55%;
            background-color: #f4f6f8;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .role-wrapper {
            width: 100%;
            max-width: 440px;
        }
        .role-wrapper h2 {
            font-size: 24px;
            color: #1a202c;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .role-wrapper p {
            font-size: 13px;
            color: #718096;
            margin-bottom: 30px;
        }
        .role-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 24px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            margin-bottom: 16px;
            transition: 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .role-card:hover {
            border-color: #00897b;
            box-shadow: 0 4px 12px rgba(0,137,123,0.08);
            transform: translateY(-2px);
        }
        .role-info h3 {
            font-size: 16px;
            color: #1a202c;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .role-info span {
            font-size: 12px;
            color: #718096;
        }
        .role-icon {
            width: 48px;
            height: 48px;
            background: #e6f4ea;
            color: #00897b;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .role-card.petugas .role-icon {
            background: #fef3c7;
            color: #d97706;
        }
        @media (max-width: 768px) {
            .panel-left {
                padding: 32px 24px;
            }
            .brand-logo {
                width: min(180px, 55vw);
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Panel Kiri -->
        <div class="panel-left">
            <img class="brand-logo" src="<?php echo e(asset('SIMPATI Inventory Equipment Logo.png')); ?>" alt="Logo SIMPATI">
            <div class="hero-text">
                <h1><span id="typed-text"></span><span class="cursor"></span></h1>
                <p id="typed-desc"></p>
            </div>
            <div class="footer-left">
                SMK Negeri 5 Surakarta • Portal Inventaris Utama
            </div>
        </div>

        <!-- Panel Kanan (Pilihan Peran) -->
        <div class="panel-right">
            <div class="role-wrapper">
                <h2>Selamat datang di SIMPATI</h2>
                <p>Silakan pilih jalur masuk sesuai peran Anda di institusi.</p>

                <!-- Pilihan Siswa -->
                <a href="<?php echo e(route('login.siswa')); ?>" class="role-card">
                    <div class="role-info">
                        <h3>Masuk sebagai Siswa</h3>
                        <span>Ajukan peminjaman, cek status & riwayat alat</span>
                    </div>
                    <div class="role-icon">👨‍🎓</div>
                </a>

                <!-- Pilihan Petugas -->
                <a href="<?php echo e(route('login.petugas')); ?>" class="role-card petugas">
                    <div class="role-info">
                        <h3>Masuk sebagai Petugas</h3>
                        <span>Kelola inventaris, verifikasi & laporan sarpras</span>
                    </div>
                    <div class="role-icon">🛡️</div>
                </a>
            </div>
        </div>
    </div>
    <script>
        const texts = [
            { el: document.getElementById('typed-text'), text: "Satu Sistem, Semua Inventaris Terkelola.", speed: 60 },
            { el: document.getElementById('typed-desc'), text: "Kelola peminjaman, pantau ketersediaan, dan jaga kondisi alat inventaris sekolah dengan lebih mudah, tertata, dan transparan.", speed: 25 }
        ];
        let t = 0;
        function typeText() {
            if (t >= texts.length) return;
            const { el, text, speed } = texts[t];
            let i = 0;
            (function type() {
                if (i < text.length) {
                    el.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                } else {
                    t++;
                    setTimeout(typeText, 400);
                }
            })();
        }
        window.addEventListener('load', () => setTimeout(typeText, 300));
    </script>
</body>
</html><?php /**PATH C:\xampp7\htdocs\simpati\resources\views/auth/role-selection.blade.php ENDPATH**/ ?>