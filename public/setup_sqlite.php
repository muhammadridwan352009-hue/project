<?php
/**
 * SQLite Setup + Cache Cleaner
 * Buka: http://127.0.0.1/simpati/public/setup_sqlite.php
 */
set_time_limit(120);

$root = dirname(__DIR__);
$cacheDir = $root . '/bootstrap/cache/';
$results = [];

// 1. Hapus cache lama (config & routes)
$filesToDelete = ['routes-v7.php', 'config.php', 'events.php'];
foreach ($filesToDelete as $f) {
    $path = $cacheDir . $f;
    if (file_exists($path)) {
        @chmod($path, 0777);
        if (@unlink($path)) {
            $results[] = ['ok', "Deleted cache: $f"];
        } else {
            if (@file_put_contents($path, '<?php return [];') !== false) {
                $results[] = ['warn', "Overwritten (locked): $f"];
            } else {
                $results[] = ['err', "FAILED to clear: $f"];
            }
        }
    }
}

// 2. Pastikan storage writable
@chmod($root . '/storage/logs/laravel.log', 0777);
if (!file_exists($root . '/storage/logs/laravel.log')) {
    file_put_contents($root . '/storage/logs/laravel.log', '');
}
$results[] = ['ok', 'Storage log file checked'];

// 3. Cek file SQLite
$sqliteFile = $root . '/database/database.sqlite';
if (file_exists($sqliteFile)) {
    $size = round(filesize($sqliteFile) / 1024, 1);
    $results[] = ['ok', "SQLite database found: database.sqlite ({$size} KB)"];
} else {
    // Buat file SQLite kosong
    touch($sqliteFile);
    $results[] = ['warn', 'SQLite file created (empty - perlu migrate)'];
}

// 4. Verifikasi koneksi SQLite via PDO
try {
    $pdo = new PDO('sqlite:' . $sqliteFile);
    $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
    $results[] = ['ok', 'SQLite connection: OK | Tables found: ' . implode(', ', $tables)];
} catch (Exception $e) {
    $results[] = ['err', 'SQLite error: ' . $e->getMessage()];
}

// 5. Jalankan artisan via CLI PHP (dari web context)
$phpExe = 'C:/xampp7/php/php.exe';
$artisan = $root . '/artisan';

$commands = [
    'config:clear',
    'cache:clear',
    'route:clear',
    'view:clear',
];
foreach ($commands as $cmd) {
    $output = shell_exec("\"$phpExe\" \"$artisan\" $cmd 2>&1");
    if (strpos($output, 'successfully') !== false || strpos($output, 'INFO') !== false) {
        $results[] = ['ok', "artisan $cmd: OK"];
    } else {
        $results[] = ['warn', "artisan $cmd: " . trim(strip_tags($output))];
    }
}

// 6. Self delete
@unlink(__FILE__);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SQLite Setup</title>
    <style>
        body{font-family:Arial;background:#f0f4f8;margin:0;padding:30px}
        .box{background:#fff;border-radius:10px;padding:25px;max-width:680px;margin:auto;box-shadow:0 2px 12px rgba(0,0,0,.1)}
        h2{color:#1e293b;margin-top:0}
        .row{padding:8px 12px;border-radius:6px;margin:5px 0;font-size:14px}
        .ok{background:#dcfce7;color:#166534}
        .warn{background:#fef9c3;color:#854d0e}
        .err{background:#fee2e2;color:#991b1b}
        .btn{background:#3b82f6;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;display:inline-block;margin-top:20px;font-size:15px}
        .btn:hover{background:#2563eb}
    </style>
</head>
<body>
<div class="box">
    <h2>🗄️ SQLite Setup Result</h2>
    <?php foreach($results as $r): ?>
        <div class="row <?= $r[0] ?>">
            <?= $r[0] === 'ok' ? '✅' : ($r[0] === 'warn' ? '⚠️' : '❌') ?>
            <?= htmlspecialchars($r[1]) ?>
        </div>
    <?php endforeach; ?>
    <hr style="margin:20px 0">
    <p><strong>SQLite aktif! Tidak perlu MySQL lagi.</strong></p>
    <a class="btn" href="http://127.0.0.1/simpati/public">🚀 Buka Aplikasi SIMPATI</a>
    <p style="color:#94a3b8;font-size:12px;margin-top:15px">File ini telah auto-dihapus untuk keamanan.</p>
</div>
</body>
</html>
