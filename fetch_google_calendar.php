<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

$apiKey = env('GOOGLE_CALENDAR_API_KEY');
$calendarId = 'en.indonesia#holiday@group.v.calendar.google.com';

if (!$apiKey) {
    die('API Key tidak ditemukan di .env\n');
}

echo "=== Fetching Indonesia Holidays from Google Calendar ===\n\n";

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

echo "API URL: $url\n";
echo "Start: " . $startDate->toRfc3339String() . "\n";
echo "End: " . $endDate->toRfc3339String() . "\n\n";

try {
    $response = Http::timeout(10)->get($url, $params);
    
    echo "Response Status: " . $response->status() . "\n\n";
    
    if ($response->successful()) {
        $events = $response->json('items', []);
        
        echo "Total events found: " . count($events) . "\n\n";
        echo "=== HOLIDAYS (From Google Calendar) ===\n";
        
        $holidays = [];
        foreach ($events as $event) {
            if (isset($event['start']['date'])) {
                $date = $event['start']['date'];
                $summary = $event['summary'] ?? 'N/A';
                $holidays[$date] = $summary;
                echo "'{$date}' => '{$summary}',\n";
            }
        }
        
        echo "\n\nPHP Array Format (untuk copy ke GoogleCalendarService.php):\n\n";
        echo "[\n";
        ksort($holidays);
        foreach ($holidays as $date => $name) {
            echo "    '{$date}' => '{$name}',\n";
        }
        echo "]\n";
        
    } else {
        echo "Error Response:\n";
        echo "Status: " . $response->status() . "\n";
        echo "Body: " . $response->body() . "\n";
    }
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
