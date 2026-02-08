<?php

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

echo "Target: " . $target . "\n";
echo "Link: " . $link . "\n";

if (file_exists($link)) {
    echo "Link public/storage sudah ada.\n";
} else {
    if (symlink($target, $link)) {
        echo "Berhasil membuat symlink public/storage -> storage/app/public\n";
    } else {
        echo "Gagal membuat symlink. Coba jalankan PHP sebagai Administrator atau aktifkan Developer Mode di Windows.\n";
        // Coba alternatif copy (kurang ideal tapi jalan)
        // copy_dir($target, $link);
    }
}
