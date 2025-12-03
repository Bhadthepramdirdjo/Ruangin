<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Ambil semua user untuk melihat data yang ada
$users = User::all();

if ($users->isEmpty()) {
    echo "Tidak ada user di database.\n";
    exit(1);
}

echo "User yang ada di database:\n";
echo str_repeat("-", 60) . "\n";
foreach ($users as $user) {
    echo "ID: {$user->id} | Email: {$user->email} | Role: {$user->role}\n";
}
echo str_repeat("-", 60) . "\n\n";

// Cari admin dan update passwordnya
$admin = $users->where('role', 'admin')->first();

if ($admin) {
    $admin->password = Hash::make('adminganteng123');
    $admin->save();
    echo "✓ Password admin ({$admin->email}) berhasil di-hash dengan Bcrypt.\n";
} else {
    echo "✗ Tidak ada user dengan role 'admin'.\n";
    echo "Pilih user mana yang ingin di-jadikan admin? (input ID): ";
    $id = trim(fgets(STDIN));
    
    if (is_numeric($id)) {
        $user = User::find($id);
        if ($user) {
            $user->password = Hash::make('adminganteng123');
            $user->role = 'admin';
            $user->save();
            echo "✓ User {$user->email} berhasil di-update menjadi admin dengan password ter-hash.\n";
        }
    }
}
