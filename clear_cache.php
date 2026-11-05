<?php
$files = [
    __DIR__ . '/bootstrap/cache/routes-v7.php',
    __DIR__ . '/bootstrap/cache/config.php',
    __DIR__ . '/bootstrap/cache/events.php',
];
foreach ($files as $file) {
    if (file_exists($file)) {
        if (unlink($file)) {
            echo "DELETED: $file\n";
        } else {
            echo "FAILED: $file\n";
        }
    } else {
        echo "NOT FOUND: $file\n";
    }
}
echo "DONE\n";
