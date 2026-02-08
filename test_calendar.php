<?php
$path = getcwd();
require $path . '/vendor/autoload.php';
$app = require $path . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Services\GoogleCalendarService;
use Carbon\Carbon;

$calendarService = new GoogleCalendarService();

echo "=== GOOGLE CALENDAR API TEST ===\n\n";

echo "Config Values:\n";
echo "  API Key: " . (config('google.calendar.api_key') ? 'SET ✓' : 'NOT SET ✗') . "\n";
echo "  Calendar ID: " . config('google.calendar.calendar_id') . "\n";
echo "  Enabled: " . (config('google.calendar.enabled') ? 'YES' : 'NO') . "\n\n";

// Test dates
$testDates = [
    '2026-02-13' => 'Sabtu (Weekend)',
    '2026-02-14' => 'Minggu (Weekend)',
    '2026-02-16' => 'Senin (Isra & Mi\'raj?)',
    '2026-02-17' => 'Selasa (Cuti Bersama?)',
    '2026-02-20' => 'Jumat (Jumat Legi?)',
    '2026-02-19' => 'Kamis',
];

echo "=== TESTING DATES ===\n";
foreach ($testDates as $date => $desc) {
    $isHoliday = $calendarService->isHoliday($date);
    $isWeekend = Carbon::parse($date)->dayOfWeek === 0 || Carbon::parse($date)->dayOfWeek === 6;
    $isUnavailable = $calendarService->isHolidayOrWeekend($date);
    
    echo "\n{$date} ({$desc})\n";
    echo "  - Weekend: " . ($isWeekend ? 'YES' : 'NO') . "\n";
    echo "  - Holiday (from API): " . ($isHoliday ? 'YES' : 'NO') . "\n";
    echo "  - Cannot Book: " . ($isUnavailable ? 'YES ✗' : 'NO ✓') . "\n";
}

echo "\n=== INSTRUCTIONS ===\n";
echo "To enable Google Calendar API:\n";
echo "1. Go to: https://console.cloud.google.com/\n";
echo "2. Create new project or select existing\n";
echo "3. Enable 'Google Calendar API'\n";
echo "4. Create API Key in Credentials\n";
echo "5. Set in .env: GOOGLE_CALENDAR_API_KEY=YOUR_KEY\n";
echo "6. Clear cache: php artisan cache:clear\n";
