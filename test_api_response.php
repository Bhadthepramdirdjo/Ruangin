<?php
$path = getcwd();
require $path . '/vendor/autoload.php';
$app = require $path . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Services\GoogleCalendarService;
use Carbon\Carbon;

$calendarService = new GoogleCalendarService();

echo "=== TEST UNAVAILABLE DATES API RESPONSE ===\n\n";

// Test February
echo "--- FEBRUARY 2026 ---\n";
$startDate = '2026-02-01';
$endDate = '2026-02-28';
$unavailableDates = $calendarService->getUnavailableDates($startDate, $endDate);
echo "Total unavailable dates: " . count($unavailableDates) . "\n";
foreach ($unavailableDates as $date) {
    $carbon = Carbon::parse($date);
    $day = $carbon->translatedFormat('l');
    echo "  - {$date} ({$day})\n";
}

// Test March (Nyepi - should be on Mar 25-26)
echo "\n--- MARCH 2026 (Nyepi) ---\n";
$startDate = '2026-03-01';
$endDate = '2026-03-31';
$unavailableDates = $calendarService->getUnavailableDates($startDate, $endDate);
echo "Total unavailable dates: " . count($unavailableDates) . "\n";
foreach ($unavailableDates as $date) {
    $carbon = Carbon::parse($date);
    $day = $carbon->translatedFormat('l');
    echo "  - {$date} ({$day})\n";
}

// Test April (Idul Fitri - should be Apr 12-17)
echo "\n--- APRIL 2026 (Idul Fitri) ---\n";
$startDate = '2026-04-01';
$endDate = '2026-04-30';
$unavailableDates = $calendarService->getUnavailableDates($startDate, $endDate);
echo "Total unavailable dates: " . count($unavailableDates) . "\n";
foreach ($unavailableDates as $date) {
    $carbon = Carbon::parse($date);
    $day = $carbon->translatedFormat('l');
    echo "  - {$date} ({$day})\n";
}
