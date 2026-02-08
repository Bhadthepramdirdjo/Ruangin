<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use App\Services\GoogleCalendarService;
use Carbon\Carbon;

$service = new GoogleCalendarService();

echo "=== Testing Nyepi & Idul Fitri Dates ===\n\n";

echo "MARCH 2026 - Nyepi:\n";
foreach ([25, 26] as $day) {
    $date = Carbon::createFromDate(2026, 3, $day);
    $isBlocked = $service->isHolidayOrWeekend($date);
    echo "  Mar $day (" . $date->format('D') . "): " . ($isBlocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";
}

echo "\nAPRIL 2026 - Idul Fitri:\n";
foreach ([12, 13, 14, 15, 16, 17] as $day) {
    $date = Carbon::createFromDate(2026, 4, $day);
    $isBlocked = $service->isHolidayOrWeekend($date);
    echo "  Apr $day (" . $date->format('D') . "): " . ($isBlocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";
}

echo "\n=== Testing getUnavailableDates API ===\n";
$startDate = '2026-03-01';
$endDate = '2026-04-30';
$unavailable = $service->getUnavailableDates($startDate, $endDate);
echo "Total unavailable dates in Mar-Apr: " . count($unavailable) . "\n";
echo "\nUnavailable dates:\n";
foreach ($unavailable as $date) {
    echo "  - $date\n";
}
