<?php
$path = getcwd();
require $path . '/vendor/autoload.php';
$app = require $path . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

echo "=== TEST BOOKING CONFLICT VALIDATION ===\n\n";

// Get existing approved booking
$existing = Booking::where('status', 'disetujui')->where('tanggal', '2026-02-10')->first();
if ($existing) {
    echo "Found approved booking:\n";
    echo "  ID: {$existing->id}\n";
    echo "  Room: {$existing->ruangan_id}\n";
    echo "  Date: {$existing->tanggal}\n";
    echo "  Time: {$existing->jam_mulai}\n";
    echo "  Duration: {$existing->jumlah_sks} SKS\n";
    
    // Calculate end time
    $jamMulai = Carbon::createFromTimeString($existing->jam_mulai);
    $jamSelesai = $jamMulai->copy()->addMinutes($existing->jumlah_sks * 50);
    echo "  End time: " . $jamSelesai->format('H:i') . "\n";
    
    echo "\n--- Testing conflict detection ---\n";
    
    // Simulate new booking with same time
    $newJamMulai = Carbon::createFromTimeString($existing->jam_mulai);
    $newSks = 2;
    $newJamSelesai = $newJamMulai->copy()->addMinutes($newSks * 50);
    
    echo "Testing new booking:\n";
    echo "  Room: {$existing->ruangan_id}\n";
    echo "  Date: {$existing->tanggal}\n";
    echo "  Time: " . $newJamMulai->format('H:i') . "\n";
    echo "  Duration: {$newSks} SKS\n";
    echo "  End time: " . $newJamSelesai->format('H:i') . "\n";
    
    // Check overlap logic
    $overlap = $newJamMulai->lt($jamSelesai) && $jamMulai->lt($newJamSelesai);
    echo "\nConflict detected: " . ($overlap ? "YES" : "NO") . "\n";
    
} else {
    echo "No approved bookings found on 2026-02-10\n";
}

echo "\n=== ALL BOOKINGS ON 2026-02-10 ===\n";
$all = Booking::where('tanggal', '2026-02-10')->get();
foreach ($all as $b) {
    echo "ID {$b->id}: Room {$b->ruangan_id}, {$b->jam_mulai} ({$b->jumlah_sks} SKS), Status: {$b->status}\n";
}
