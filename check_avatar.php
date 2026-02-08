<?php

use App\Models\User;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::first(); // Ambil user pertama
echo "User: " . $user->nama . "\n";
echo "Avatar DB: " . $user->avatar . "\n";

if ($user->avatar) {
    if (file_exists(public_path('storage/' . $user->avatar))) {
        echo "File di public/storage: ADA\n";
    } else {
        echo "File di public/storage: TIDAK ADA\n";
    }

    if (file_exists(storage_path('app/public/' . $user->avatar))) {
        echo "File di storage/app/public: ADA\n";
    } else {
        echo "File di storage/app/public: TIDAK ADA\n";
    }
} else {
    echo "Tidak ada avatar.\n";
}
