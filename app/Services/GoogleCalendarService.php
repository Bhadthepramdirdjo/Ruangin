<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class GoogleCalendarService
{
    protected $apiKey;
    protected $calendarId;
    protected $cacheMinutes = 1440; // Cache selama 1 hari

    public function __construct()
    {
        $this->apiKey = config('google.calendar.api_key');
        $this->calendarId = config('google.calendar.calendar_id');
    }

    /**
     * Check if a date is a holiday or weekend
     * Note: Only Sunday is blocked as weekend, Saturday is allowed
     */
    public function isHolidayOrWeekend($date)
    {
        $carbonDate = Carbon::parse($date);
        
        // Check if Sunday using isSunday() method - most reliable
        if ($carbonDate->isSunday()) {
            return true;
        }

        // Check if holiday from Google Calendar
        return $this->isHoliday($date);
    }

    /**
     * Check if date is a holiday from Google Calendar API
     */
    public function isHoliday($date)
    {
        $carbonDate = Carbon::parse($date);
        $cacheKey = "google_calendar_holidays_{$carbonDate->year}";

        // Get or fetch holidays for the year
        $holidays = Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($carbonDate) {
            return $this->fetchHolidaysFromAPI($carbonDate->year);
        });

        // Check if current date is in the holidays array
        $dateStr = $carbonDate->format('Y-m-d');
        return in_array($dateStr, $holidays);
    }

    /**
     * Get hardcoded Indonesia holidays for 2026 from Google Calendar API
     * This is a fallback only - API is the primary source
     */
    protected function getIndonesiaHolidays2026()
    {
        return [
            // INDONESIA HOLIDAYS 2026 - From Official Google Calendar API
            // Source: indonesian@holiday.calendar.google.com
            '2026-01-01' => 'New Year\'s Day',
            '2026-01-16' => 'Ascension of the Prophet Muhammad',
            '2026-02-16' => 'Chinese New Year Joint Holiday',
            '2026-02-17' => 'Chinese New Year\'s Day',
            '2026-02-20' => 'Ramadan Start (tentative)',
            '2026-03-18' => 'Joint Holiday for Nyepi',
            '2026-03-19' => 'Bali\'s Day of Silence (Nyepi)',
            '2026-03-20' => 'Idul Fitri Joint Holiday',
            '2026-03-21' => 'Idul Fitri (tentative)',
            '2026-03-22' => 'Idul Fitri Holiday (tentative)',
            '2026-03-23' => 'Idul Fitri Joint Holiday',
            '2026-03-24' => 'Idul Fitri Joint Holiday',
            '2026-04-03' => 'Good Friday',
            '2026-04-05' => 'Easter Sunday',
            '2026-05-01' => 'International Labor Day',
            '2026-05-14' => 'Ascension Day of Jesus Christ',
            '2026-05-15' => 'Joint Holiday after Ascension Day',
            '2026-05-27' => 'Idul Adha (tentative)',
            '2026-05-28' => 'Joint Holiday for Idul Adha',
            '2026-05-31' => 'Waisak Day (Buddha\'s Anniversary) (tentative)',
            '2026-06-01' => 'Pancasila Day',
            '2026-06-16' => 'Muharram / Islamic New Year (tentative)',
            '2026-08-17' => 'Indonesian Independence Day',
            '2026-08-25' => 'Maulid Nabi Muhammad (tentative)',
            '2026-12-24' => 'Christmas Eve Joint Holiday',
            '2026-12-25' => 'Christmas Day',
            '2026-12-31' => 'New Year\'s Eve',
        ];
    }

    /**
     * Fetch holidays from Google Calendar API with fallback to hardcoded list
     */
    protected function fetchHolidaysFromAPI($year)
    {
        try {
            if (!$this->apiKey || !$this->calendarId) {
                \Log::warning('Google Calendar Config missing', [
                    'apiKey' => $this->apiKey ? 'SET' : 'EMPTY',
                    'calendarId' => $this->calendarId
                ]);
                // Use fallback for current year
                if ($year == 2026) {
                    return array_keys($this->getIndonesiaHolidays2026());
                }
                return [];
            }

            $startDate = Carbon::create($year, 1, 1)->startOfDay();
            $endDate = Carbon::create($year, 12, 31)->endOfDay();

            $url = 'https://www.googleapis.com/calendar/v3/calendars/' . urlencode($this->calendarId) . '/events';
            $params = [
                'key' => $this->apiKey,
                'timeMin' => $startDate->toRfc3339String(),
                'timeMax' => $endDate->toRfc3339String(),
                'singleEvents' => 'true',
                'orderBy' => 'startTime',
            ];

            \Log::info('Fetching Google Calendar events', [
                'url' => $url,
                'year' => $year,
                'timeMin' => $startDate->toRfc3339String(),
                'timeMax' => $endDate->toRfc3339String(),
            ]);

            $response = Http::timeout(10)->get($url, $params);

            \Log::info('Google Calendar API Response', [
                'status' => $response->status(),
                'body_length' => strlen($response->body())
            ]);

            if (!$response->successful()) {
                \Log::warning('Failed to fetch Google Calendar events', [
                    'status' => $response->status(),
                    'response' => substr($response->body(), 0, 500)
                ]);
                // Use fallback for 2026
                if ($year == 2026) {
                    \Log::info('Using fallback Indonesia holidays for 2026');
                    return array_keys($this->getIndonesiaHolidays2026());
                }
                return [];
            }

            $holidays = [];
            $events = $response->json('items', []);

            \Log::info('Google Calendar Events Found', [
                'count' => count($events)
            ]);

            foreach ($events as $event) {
                // All-day events usually have only 'date' field
                if (isset($event['start']['date'])) {
                    $holidays[] = $event['start']['date'];
                    \Log::debug('Holiday added', [
                        'date' => $event['start']['date'],
                        'summary' => $event['summary'] ?? 'N/A'
                    ]);
                }
            }

            \Log::info('Holidays extracted', [
                'total' => count($holidays),
                'holidays' => $holidays
            ]);

            return $holidays;

        } catch (\Exception $e) {
            \Log::error('Google Calendar API Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            // Use fallback for 2026
            if ($year == 2026) {
                \Log::info('Using fallback Indonesia holidays for 2026 due to API error');
                return array_keys($this->getIndonesiaHolidays2026());
            }
            return [];
        }
    }

    /**
     * Get all unavailable dates (holidays + weekends) for a date range
     */
    public function getUnavailableDates($startDate, $endDate)
    {
        $unavailable = [];
        $current = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        while ($current->lte($end)) {
            if ($this->isHolidayOrWeekend($current)) {
                $unavailable[] = $current->format('Y-m-d');
            }
            $current->addDay();
        }

        return $unavailable;
    }

    /**
     * Get next available booking date
     */
    public function getNextAvailableDate($from = null)
    {
        $current = $from ? Carbon::parse($from) : Carbon::now();
        
        while ($this->isHolidayOrWeekend($current)) {
            $current->addDay();
        }

        return $current;
    }
}
