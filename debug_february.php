<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';

use App\Services\GoogleCalendarService;
use Carbon\Carbon;

$service = new GoogleCalendarService();

echo "=== DEBUGGING FEBRUARY 2026 ===\n\n";

// Test specific dates
$dates = [
    '2026-02-01', // Minggu
    '2026-02-02', // Senin
    '2026-02-03', // Selasa
    '2026-02-04', // Rabu
    '2026-02-05', // Kamis
    '2026-02-06', // Jumat
    '2026-02-07', // Sabtu
    '2026-02-08', // Minggu - TODAY
    '2026-02-09', // Senin
    '2026-02-15', // Minggu
    '2026-02-16', // Senin - should be holiday
    '2026-02-17', // Selasa - should be holiday
];

foreach ($dates as $date) {
    $carbonDate = Carbon::parse($date);
    $dayName = $carbonDate->translatedFormat('l');
    $dayOfWeek = $carbonDate->dayOfWeek;
    $isHolidayOrWeekend = $service->isHolidayOrWeekend($date);
    
    echo "[{$date}] {$dayName} (dayOfWeek: {$dayOfWeek}) - Unavailable: " . ($isHolidayOrWeekend ? 'YES' : 'NO') . "\n";
}

echo "\n=== TESTING GET UNAVAILABLE DATES ===\n";
$unavailable = $service->getUnavailableDates('2026-02-01', '2026-02-28');

echo "Total unavailable dates in February: " . count($unavailable) . "\n";
echo "Dates: " . implode(", ", $unavailable) . "\n";
?>