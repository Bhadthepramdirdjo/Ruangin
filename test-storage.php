<?php
/**
 * Script untuk Debugging Upload Foto di Hosting
 *
 * Jalankan di browser: yourdomain.com/test-storage.php
 * JANGAN LUPAKAN UNTUK MENGHAPUS FILE INI SETELAH TESTING!
 */

echo "<h1>Storage Configuration Test</h1>";
echo "<hr>";

// 1. Test APP_URL
echo "<h3>1. APP_URL Configuration</h3>";
echo "<p><strong>APP_URL dari .env:</strong> " . (function_exists('env') ? env('APP_URL', 'undefined') : 'Function env() tidak tersedia') . "</p>";
echo "<p><strong>Expected URL untuk foto:</strong> " . (getenv('APP_URL') ?: 'http://localhost') . "/storage/avatars/filename.jpg</p>";

// 2. Test Filesystem Disk
echo "<h3>2. Filesystem Disk Configuration</h3>";
echo "<p><strong>FILESYSTEM_DISK dari .env:</strong> " . (getenv('FILESYSTEM_DISK') ?: 'undefined') . "</p>";

// 3. Test Folder Permissions
echo "<h3>3. Storage Folder Permissions</h3>";

$paths = [
    'storage/app/public' => 'storage/app/public',
    'storage/app/public/avatars' => 'storage/app/public/avatars',
    'storage/app/public/documents' => 'storage/app/public/documents',
    'bootstrap/cache' => 'bootstrap/cache',
];

foreach ($paths as $label => $path) {
    if (file_exists($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        $writable = is_writable($path) ? '<span style="color:green;">✓ Writable</span>' : '<span style="color:red;">✗ NOT Writable</span>';
        echo "<p><strong>$label</strong> - Permissions: $perms | Status: $writable</p>";
    } else {
        echo "<p><strong>$label</strong> - <span style=\"color:red;\">✗ FOLDER NOT FOUND</span></p>";
    }
}

// 4. Test Symlink
echo "<h3>4. Storage Symlink Check</h3>";
if (is_link('public/storage')) {
    $target = readlink('public/storage');
    echo "<p><strong>public/storage</strong> - ✓ Symlink exists → $target</p>";
} else {
    echo "<p><strong>public/storage</strong> - ✗ Symlink NOT found (need to run: php artisan storage:link)</p>";
}

// 5. Test Database Connection
echo "<h3>5. Database Connection</h3>";
try {
    // Try to connect to MySQL
    $host = getenv('DB_HOST') ?: 'localhost';
    $username = getenv('DB_USERNAME') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: '';
    $database = getenv('DB_DATABASE') ?: 'test';

    $conn = @new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        echo "<p style=\"color:red;\">✗ Database connection failed: " . $conn->connect_error . "</p>";
    } else {
        echo "<p style=\"color:green;\">✓ Database connected successfully</p>";
        // Check if users table exists
        $result = $conn->query("SHOW TABLES LIKE 'users'");
        if ($result->num_rows > 0) {
            echo "<p style=\"color:green;\">✓ Users table exists</p>";
        } else {
            echo "<p style=\"color:red;\">✗ Users table not found</p>";
        }
        $conn->close();
    }
} catch (Exception $e) {
    echo "<p style=\"color:red;\">✗ Error: " . $e->getMessage() . "</p>";
}

// 6. Test File Upload Simulation
echo "<h3>6. Upload Test</h3>";
$test_dir = 'storage/app/public/avatars';
if (is_writable($test_dir)) {
    $test_file = $test_dir . '/test_' . time() . '.txt';
    if (file_put_contents($test_file, 'Test file')) {
        echo "<p style=\"color:green;\">✓ Can create files in avatars folder</p>";
        unlink($test_file);
        echo "<p style=\"color:green;\">✓ Can delete files in avatars folder</p>";
    } else {
        echo "<p style=\"color:red;\">✗ Cannot create files in avatars folder</p>";
    }
} else {
    echo "<p style=\"color:red;\">✗ avatars folder is not writable</p>";
}

// 7. PHP Version & Extensions
echo "<h3>7. PHP Information</h3>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
$required_ext = ['gd', 'mbstring', 'pdo', 'pdo_mysql'];
foreach ($required_ext as $ext) {
    $status = extension_loaded($ext) ? '<span style="color:green;">✓</span>' : '<span style="color:red;">✗</span>';
    echo "<p><strong>$ext</strong> extension: $status</p>";
}

echo "<hr>";
echo "<p style=\"color:red;\"><strong>⚠️ PENTING:</strong> Hapus file ini (test-storage.php) setelah selesai testing!</p>";
?>
