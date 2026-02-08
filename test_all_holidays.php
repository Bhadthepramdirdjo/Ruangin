<?php
$path = getcwd();
require $path . '/vendor/autoload.php';
$app = require $path . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Services\GoogleCalendarService;
use Carbon\Carbon;

$calendarService = new GoogleCalendarService();

echo "=== COMPREHENSIVE HOLIDAY TEST FOR 2026 ===\n\n";

// Test all months
$testDates = [
    // January
    '2026-01-01' => 'Tahun Baru Masehi',
    
    // February
    '2026-02-13' => 'Sabtu',
    '2026-02-14' => 'Minggu',
    '2026-02-16' => 'Isra & Miraj',
    '2026-02-17' => 'Cuti Bersama',
    '2026-02-20' => 'Jumat biasa',
    
    // April (Lebaran period)
    '2026-04-10' => 'Jumat Agung',
    '2026-04-11' => 'Hari Libur',
    '2026-04-12' => 'Idul Fitri',
    '2026-04-13' => 'Idul Fitri',
    '2026-04-14' => 'Cuti Bersama',
    
    // May
    '2026-05-01' => 'Hari Buruh',
    '2026-05-14' => 'Hari Kesaksian Nabi Muhammad',
    
    // June
    '2026-06-01' => 'Hari Lahir Pancasila',
    '2026-06-02' => 'Cuti Bersama Pancasila',
    
    // August
    '2026-08-17' => 'Hari Kemerdekaan',
    
    // December
    '2026-12-25' => 'Natal',
    '2026-12-26' => 'Cuti Bersama Natal',
];

echo "Testing dates:\n";
foreach ($testDates as $date => $desc) {
    $isWeekend = Carbon::parse($date)->dayOfWeek === 0 || Carbon::parse($date)->dayOfWeek === 6;
    $isHoliday = $calendarService->isHoliday($date);
    $canBook = !$calendarService->isHolidayOrWeekend($date);
    
    $status = $canBook ? '✓ CAN BOOK' : '✗ BLOCKED';
    $reason = $isWeekend ? '(Weekend)' : ($isHoliday ? '(Holiday)' : '(Normal day)');
    
    echo sprintf("%-12s %-30s %s %s\n", $date, $desc, $status, $reason);
}
