<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Services\GoogleCalendarService;
use Carbon\Carbon;

$service = new GoogleCalendarService();

echo "=== Testing Google Calendar API (UPDATED) ===\n\n";
echo "Testing apakah API sekarang berfungsi dengan calendar ID yang benar:\n\n";

$testDates = [
    '2026-01-01' => 'Tahun Baru',
    '2026-02-17' => 'Imlek',
    '2026-03-19' => 'Nyepi',
    '2026-03-21' => 'Idul Fitri',
    '2026-04-03' => 'Good Friday',
    '2026-05-01' => 'Hari Buruh',
    '2026-08-17' => 'Kemerdekaan',
    '2026-12-25' => 'Natal',
];

foreach ($testDates as $date => $name) {
    $isBlocked = $service->isHolidayOrWeekend($date);
    $status = $isBlocked ? '✗ BLOCKED' : '✓ ALLOWED';
    echo "$date ($name): $status\n";
}

echo "\n=== Total hasil dari API ===\n";
$startDate = '2026-01-01';
$endDate = '2026-12-31';
$unavailable = $service->getUnavailableDates($startDate, $endDate);
echo "Total unavailable dates: " . count($unavailable) . " (weekends + 27 holidays)\n";
echo "\nFirst 10 unavailable dates:\n";
foreach (array_slice($unavailable, 0, 10) as $date) {
    echo "  - $date\n";
}
