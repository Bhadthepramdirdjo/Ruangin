<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

$apiKey = env('GOOGLE_CALENDAR_API_KEY');
$calendarId = 'indonesian@holiday.calendar.google.com'; // CALENDAR ID YANG BENAR

echo "=== FETCHING INDONESIA HOLIDAYS 2026 ===\n";
echo "Using Calendar ID: $calendarId\n\n";

$startDate = Carbon::create(2026, 1, 1)->startOfDay();
$endDate = Carbon::create(2026, 12, 31)->endOfDay();

$url = 'https://www.googleapis.com/calendar/v3/calendars/' . urlencode($calendarId) . '/events';
$params = [
    'key' => $apiKey,
    'timeMin' => $startDate->toRfc3339String(),
    'timeMax' => $endDate->toRfc3339String(),
    'singleEvents' => 'true',
    'orderBy' => 'startTime',
];

try {
    $response = Http::timeout(10)->get($url, $params);
    
    if ($response->successful()) {
        $events = $response->json('items', []);
        
        echo "Total holidays found: " . count($events) . "\n\n";
        echo "=== HOLIDAY LIST ===\n\n";
        
        $holidays = [];
        foreach ($events as $event) {
            if (isset($event['start']['date'])) {
                $date = $event['start']['date'];
                $summary = $event['summary'] ?? 'Unknown';
                $holidays[$date] = $summary;
                echo "'{$date}' => '{$summary}',\n";
            }
        }
        
        echo "\n\n=== PHP ARRAY FORMAT (untuk copy ke GoogleCalendarService.php) ===\n\n";
        echo "[\n";
        foreach ($holidays as $date => $name) {
            echo "    '{$date}' => '{$name}',\n";
        }
        echo "]\n";
        
    } else {
        echo "Error: " . $response->status() . "\n";
        echo "Response: " . $response->body() . "\n";
    }
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
