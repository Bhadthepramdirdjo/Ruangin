<?php
/**
 * Script untuk verify dan update tanggal merah Indonesia 2026
 * Sesuaikan dengan Google Calendar resmi
 */

// Tanggal merah RESMI Indonesia 2026 berdasarkan:
// 1. Keputusan Presiden 
// 2. Islamic Lunar Calendar (Hijriah)
// 3. Official Government Announcements

$officialHolidays2026 = [
    // ===== FIXED HOLIDAYS (Tetap sama setiap tahun) =====
    '2026-01-01' => 'Tahun Baru Masehi',
    
    // ===== LUNAR CALENDAR (Imlek/Chinese New Year) =====
    '2026-01-29' => 'Tahun Baru Imlek 2577',
    
    // ===== ISLAMIC HOLIDAYS (Lunar/Hijriah Calendar) =====
    // Isra dan Miraj (27 Rajab) - Perkiraan 16 Feb 2026
    '2026-02-16' => 'Isra dan Miraj Nabi Muhammad SAW',
    
    // Idul Fitri (1-2 Shawwal) - Perkiraan 12-13 April 2026
    '2026-04-11' => 'Hari Raya Idul Fitri',  // Hari Libur Cuti Bersama
    '2026-04-12' => 'Hari Raya Idul Fitri (Hari Pertama)',
    '2026-04-13' => 'Hari Raya Idul Fitri (Hari Kedua)',
    
    // Cuti Bersama Idul Fitri
    '2026-04-14' => 'Cuti Bersama',
    '2026-04-15' => 'Cuti Bersama',
    '2026-04-16' => 'Cuti Bersama',
    '2026-04-17' => 'Cuti Bersama',
    
    // Idul Adha (10 Dhul-Hijjah) - Perkiraan 25 April 2026
    '2026-04-25' => 'Hari Raya Idul Adha',
    
    // Mawlid Nabi Muhammad (12 Rabi al-Awwal) - Perkiraan akhir September/Oktober 2026
    // Biasanya tidak selalu jadi libur nasional, perlu dikonfirmasi
    
    // Tahun Baru Hijriah (1 Muharram) - Perkiraan akhir Desember 2025/Awal Januari 2026
    // Untuk 2026, mungkin akhir Desember 2025
    
    // ===== KRISTEN HOLIDAYS =====
    '2026-04-10' => 'Jumat Agung / Good Friday',
    
    '2026-12-25' => 'Hari Raya Natal',
    
    // ===== HINDU HOLIDAYS (Nyepi - Saka New Year) =====
    '2026-03-25' => 'Hari Raya Nyepi / Tahun Baru Saka',
    
    // ===== FIXED NATIONAL HOLIDAYS =====
    '2026-05-01' => 'Hari Buruh Internasional',
    '2026-06-01' => 'Hari Lahir Pancasila',
    '2026-08-17' => 'Hari Kemerdekaan Republik Indonesia',
    
    // ===== POSSIBLE CUTI BERSAMA (perlu dikonfirmasi) =====
    '2026-03-26' => 'Cuti Bersama (setelah Nyepi)',
    '2026-04-09' => 'Cuti Bersama (sebelum Good Friday)',
    '2026-05-14' => 'Kesaksian Nabi Muhammad SAW / Imlek (mungkin)',
    '2026-05-15' => 'Cuti Bersama (mungkin)',
    '2026-06-02' => 'Cuti Bersama (setelah Pancasila)',
    '2026-08-18' => 'Cuti Bersama (setelah Kemerdekaan)',
    '2026-12-26' => 'Cuti Bersama (setelah Natal)',
    '2026-12-31' => 'Cuti Bersama (Tahun Baru 2027)',
];

echo "=== TANGGAL MERAH RESMI INDONESIA 2026 ===\n";
echo "Total: " . count($officialHolidays2026) . " tanggal\n\n";

echo "PHP Array Format (untuk GoogleCalendarService.php):\n\n";
echo "[\n";
ksort($officialHolidays2026);
foreach ($officialHolidays2026 as $date => $name) {
    echo "    '{$date}' => '{$name}',\n";
}
echo "]\n\n";

echo "=== NOTES ===\n";
echo "1. Data ini berdasarkan:\n";
echo "   - Islamic Lunar Calendar (Hijriah) estimates untuk 2026\n";
echo "   - Fixed national holidays\n";
echo "   - Cuti Bersama yang biasanya diumumkan government\n\n";
echo "2. Tanggal Islamic holidays mungkin berubah tergantung:\n";
echo "   - Sighting of moon (hilal)\n";
echo "   - Official government announcement\n\n";
echo "3. Beberapa cuti bersama dipilih berdasarkan pola tahun-tahun sebelumnya\n";
echo "4. SILAKAN SESUAIKAN dengan Google Calendar resmi yang Anda periksa!\n";
