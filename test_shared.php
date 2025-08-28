<?php
/**
 * Test Shared Variables
 */

echo "<h2>Testing Shared Variables</h2>";

// Test different ways to access shared variables
$tests = [
    'getenv("MYSQLHOST")' => getenv('MYSQLHOST'),
    'getenv("MYSQLUSER")' => getenv('MYSQLUSER'),
    'getenv("MYSQLPASSWORD")' => getenv('MYSQLPASSWORD'),
    'getenv("MYSQLDATABASE")' => getenv('MYSQLDATABASE'),
    'getenv("MYSQL_URL")' => getenv('MYSQL_URL'),
    '$_ENV["MYSQLHOST"]' => $_ENV['MYSQLHOST'] ?? 'NOT SET',
    '$_ENV["MYSQLUSER"]' => $_ENV['MYSQLUSER'] ?? 'NOT SET',
    '$_ENV["MYSQLPASSWORD"]' => $_ENV['MYSQLPASSWORD'] ?? 'NOT SET',
    '$_ENV["MYSQLDATABASE"]' => $_ENV['MYSQLDATABASE'] ?? 'NOT SET',
    '$_ENV["MYSQL_URL"]' => $_ENV['MYSQL_URL'] ?? 'NOT SET',
];

echo "<h3>Variable Access Tests:</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Method</th><th>Value</th></tr>";

foreach ($tests as $method => $value) {
    if ($value !== false && $value !== 'NOT SET') {
        // Mask password for security
        if (strpos($method, 'PASSWORD') !== false) {
            $value = '***MASKED***';
        }
        echo "<tr><td>$method</td><td style='color: green;'>$value</td></tr>";
    } else {
        echo "<tr><td>$method</td><td style='color: red;'>NOT SET</td></tr>";
    }
}
echo "</table>";

// Show all environment variables
echo "<h3>All Environment Variables:</h3>";
echo "<pre>";
foreach ($_ENV as $key => $value) {
    if (strpos($key, 'MYSQL') !== false) {
        if (strpos($key, 'PASSWORD') !== false) {
            echo "$key = ***MASKED***\n";
        } else {
            echo "$key = $value\n";
        }
    }
}
echo "</pre>";

echo "<p><strong>Note:</strong> Delete this file after testing for security.</p>";
?>
