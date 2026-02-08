<?php
// Simple test tanpa Laravel container
require_once __DIR__ . '/vendor/autoload.php';

use Carbon\Carbon;

echo "=== Testing Carbon isSunday() ===\n\n";

// Test February 2026
$testDates = [
    '2026-02-01', // Sunday
    '2026-02-02', // Monday
    '2026-02-08', // Sunday
    '2026-02-09', // Monday
    '2026-02-15', // Sunday
    '2026-02-16', // Monday
];

foreach ($testDates as $dateStr) {
    $date = Carbon::parse($dateStr);
    $dayName = $date->format('l'); // Full day name
    $isSunday = $date->isSunday();
    
    echo "{$dateStr} ({$dayName}) - isSunday(): " . ($isSunday ? 'YES ✓' : 'NO') . "\n";
}
