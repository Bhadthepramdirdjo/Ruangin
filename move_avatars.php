<?php

use Illuminate\Support\Facades\Storage;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$src = storage_path('app/public/avatars');
$dest = public_path('avatars');

echo "Source: " . $src . "\n";
echo "Dest: " . $dest . "\n";

if (!file_exists($dest)) {
    mkdir($dest, 0777, true);
    echo "Folder public/avatars dibuat.\n";
}

// Copy semua file dari storage/app/public/avatars ke public/avatars
if (file_exists($src)) {
    $files = scandir($src);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        copy($src . '/' . $file, $dest . '/' . $file);
        echo "Copied: " . $file . "\n";
    }
} else {
    echo "Folder source tidak ditemukan.\n";
}
