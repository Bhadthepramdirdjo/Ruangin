<?php

define('BASE_PATH', dirname(__FILE__));
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->boot();

use App\Services\GoogleCalendarService;
use Carbon\Carbon;

$service = new GoogleCalendarService();

echo "=== Testing Multiple Holiday Months ===\n";

// Test April (Jumat Agung, Idul Fitri, Idul Adha)
echo "\nAPRIL 2026 (Jumat Agung 10, Idul Fitri 12-17, Idul Adha 25):\n";
foreach ([10, 12, 13, 14, 15, 16, 17, 25] as $day) {
    $date = Carbon::createFromDate(2026, 4, $day);
    $blocked = $service->isHolidayOrWeekend($date);
    echo "  Apr $day (" . $date->format('l') . "): " . ($blocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";
}

// Test May (Buruh 1, Kesaksian 14-15)
echo "\nMAY 2026 (Hari Buruh 1, Kesaksian Nabi 14-15):\n";
foreach ([1, 14, 15] as $day) {
    $date = Carbon::createFromDate(2026, 5, $day);
    $blocked = $service->isHolidayOrWeekend($date);
    echo "  May $day (" . $date->format('l') . "): " . ($blocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";
}

// Test June (Pancasila 1)
echo "\nJUNE 2026 (Pancasila 1):\n";
$date = Carbon::createFromDate(2026, 6, 1);
$blocked = $service->isHolidayOrWeekend($date);
echo "  Jun 1 (" . $date->format('l') . "): " . ($blocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";

// Test August (Kemerdekaan 17)
echo "\nAUGUST 2026 (Kemerdekaan 17):\n";
$date = Carbon::createFromDate(2026, 8, 17);
$blocked = $service->isHolidayOrWeekend($date);
echo "  Aug 17 (" . $date->format('l') . "): " . ($blocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";

// Test December (Natal 25)
echo "\nDECEMBER 2026 (Natal 25):\n";
$date = Carbon::createFromDate(2026, 12, 25);
$blocked = $service->isHolidayOrWeekend($date);
echo "  Dec 25 (" . $date->format('l') . "): " . ($blocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";

// Test January special dates
echo "\nJANUARY 2026 (Tahun Baru 1, Imlek 29):\n";
foreach ([1, 29] as $day) {
    $date = Carbon::createFromDate(2026, 1, $day);
    $blocked = $service->isHolidayOrWeekend($date);
    echo "  Jan $day (" . $date->format('l') . "): " . ($blocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";
}

// Test March (Nyepi 25-26)
echo "\nMARCH 2026 (Nyepi 25-26):\n";
foreach ([25, 26] as $day) {
    $date = Carbon::createFromDate(2026, 3, $day);
    $blocked = $service->isHolidayOrWeekend($date);
    echo "  Mar $day (" . $date->format('l') . "): " . ($blocked ? '✗ BLOCKED' : '✓ CAN BOOK') . "\n";
}
