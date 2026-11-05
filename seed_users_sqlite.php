<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$columns = ['nis', 'kelas', 'tingkat_kelas', 'jurusan', 'foto'];
foreach ($columns as $col) {
    try {
        $pdo->exec("ALTER TABLE users ADD COLUMN $col VARCHAR NULL");
        echo "Added column $col\n";
    } catch (Exception $e) {
        // column might exist
    }
}

// Tambah user petugas
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
$stmt->execute(['petugas@smkn5surakarta.id']);
if ($stmt->fetchColumn() == 0) {
    $ins = $pdo->prepare("INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, datetime('now'), datetime('now'))");
    $ins->execute([
        'Rizky Maulana',
        'petugas@smkn5surakarta.id',
        password_hash('password123', PASSWORD_BCRYPT),
        'petugas'
    ]);
    echo "Petugas created\n";
} else {
    $upd = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $upd->execute([password_hash('password123', PASSWORD_BCRYPT), 'petugas@smkn5surakarta.id']);
    echo "Petugas password reset\n";
}

// Tambah user siswa
$stmt->execute(['siswa@smkn5surakarta.id']);
if ($stmt->fetchColumn() == 0) {
    $ins = $pdo->prepare("INSERT INTO users (name, email, nis, kelas, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))");
    $ins->execute([
        'Nadia Putri',
        'siswa@smkn5surakarta.id',
        '33189',
        'XII RPL 1',
        password_hash('password123', PASSWORD_BCRYPT),
        'siswa'
    ]);
    echo "Siswa created\n";
} else {
    $upd = $pdo->prepare("UPDATE users SET password = ?, nis = '33189' WHERE email = ?");
    $upd->execute([password_hash('password123', PASSWORD_BCRYPT), 'siswa@smkn5surakarta.id']);
    echo "Siswa password reset\n";
}

echo "DONE SEEDING SQLITE\n";
