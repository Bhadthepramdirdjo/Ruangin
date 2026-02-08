<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

$apiKey = env('GOOGLE_CALENDAR_API_KEY');

if (!$apiKey) {
    die("ERROR: API Key tidak ditemukan di .env\n");
}

echo "=== TESTING BERBAGAI GOOGLE CALENDAR IDs ===\n";
echo "API Key: " . substr($apiKey, 0, 20) . "...\n\n";

// Berbagai calendar ID yang mungkin untuk Indonesia
$calendarIds = [
    'en.indonesia#holiday@group.v.calendar.google.com' => 'Format LAMA (dengan @group)',
    'id.indonesian#holiday@group.v.calendar.google.com' => 'Format dengan prefix ID',
    'indonesian@holiday.calendar.google.com' => 'Format alternatif 1',
    'id_ID#holiday@group.v.calendar.google.com' => 'Format dengan locale ID_ID',
    'indonesia@holiday.calendar.google.com' => 'Format simple',
];

$startDate = Carbon::create(2026, 1, 1)->startOfDay();
$endDate = Carbon::create(2026, 3, 31)->endOfDay();

foreach ($calendarIds as $calendarId => $description) {
    echo "================================\n";
    echo "Testing: $calendarId\n";
    echo "Description: $description\n";
    echo "================================\n";
    
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
        
        echo "Status: " . $response->status();
        
        if ($response->successful()) {
            $events = $response->json('items', []);
            echo " ✓ SUCCESS\n";
            echo "Events found: " . count($events) . "\n\n";
            
            if (count($events) > 0) {
                echo "Sample holidays:\n";
                foreach (array_slice($events, 0, 5) as $event) {
                    if (isset($event['start']['date'])) {
                        echo "  - " . $event['start']['date'] . ": " . ($event['summary'] ?? 'N/A') . "\n";
                    }
                }
                echo "\n";
            }
        } else {
            echo " ✗ FAILED\n";
            $error = $response->json('error.message', $response->body());
            echo "Error: " . substr($error, 0, 150) . "\n\n";
        }
    } catch (\Exception $e) {
        echo "Exception: " . $e->getMessage() . "\n\n";
    }
}

echo "\n=== TESTING DIRECT API LIST ===\n";
echo "Trying to list all available calendars...\n\n";

$listUrl = 'https://www.googleapis.com/calendar/v3/calendarList';
$listParams = ['key' => $apiKey];

try {
    $response = Http::timeout(10)->get($listUrl, $listParams);
    
    if ($response->successful()) {
        $calendars = $response->json('items', []);
        echo "Public calendars found: " . count($calendars) . "\n";
        
        foreach ($calendars as $cal) {
            if (strpos(strtolower($cal['summary'] ?? ''), 'holiday') !== false || 
                strpos(strtolower($cal['summary'] ?? ''), 'indonesia') !== false) {
                echo "  - " . $cal['summary'] . " (ID: " . $cal['id'] . ")\n";
            }
        }
    } else {
        echo "Status: " . $response->status() . "\n";
        echo "Note: Might need authentication to list calendars\n";
    }
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
