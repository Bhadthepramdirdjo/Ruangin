<?php

return [
    // Google Calendar API Configuration
    'calendar' => [
        'enabled' => env('GOOGLE_CALENDAR_ENABLED', true),
        'api_key' => env('GOOGLE_CALENDAR_API_KEY', ''),
        'calendar_id' => env('GOOGLE_CALENDAR_ID', 'en.indonesia#holiday@group.v.calendar.google.com'),
    ],
];
