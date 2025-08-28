<?php
/**
 * Debug Environment Variables
 * This script will show all available environment variables
 */

echo "<h2>Environment Variables Debug</h2>";

// Check all possible database-related environment variables
$envVars = [
    'MYSQLHOST' => getenv('MYSQLHOST'),
    'MYSQLUSER' => getenv('MYSQLUSER'),
    'MYSQLPASSWORD' => getenv('MYSQLPASSWORD'),
    'MYSQLDATABASE' => getenv('MYSQLDATABASE'),
    'MYSQL_URL' => getenv('MYSQL_URL'),
    'MYSQL_PUBLIC_URL' => getenv('MYSQL_PUBLIC_URL'),
    'RAILWAY_ENVIRONMENT' => getenv('RAILWAY_ENVIRONMENT'),
    'DATABASE_URL' => getenv('DATABASE_URL'),
    'DB_HOST' => getenv('DB_HOST'),
    'DB_USER' => getenv('DB_USER'),
    'DB_PASSWORD' => getenv('DB_PASSWORD'),
    'DB_NAME' => getenv('DB_NAME'),
    'PHP_DB_HOST' => getenv('PHP_DB_HOST'),
    'PHP_DB_USER' => getenv('PHP_DB_USER'),
    'PHP_DB_PASS' => getenv('PHP_DB_PASS'),
    'PHP_DB_NAME' => getenv('PHP_DB_NAME')
];

echo "<h3>Database Environment Variables:</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Variable</th><th>Value</th></tr>";

foreach ($envVars as $var => $value) {
    if ($value !== false) {
        // Mask password for security
        if (strpos($var, 'PASSWORD') !== false || strpos($var, 'PASS') !== false) {
            $value = '***MASKED***';
        }
        echo "<tr><td>$var</td><td>$value</td></tr>";
    } else {
        echo "<tr><td>$var</td><td style='color: red;'>NOT SET</td></tr>";
    }
}
echo "</table>";

// Show all environment variables
echo "<h3>All Environment Variables:</h3>";
echo "<pre>";
print_r($_ENV);
echo "</pre>";

// Test database connection with different configurations
echo "<h3>Database Connection Test:</h3>";

// Test 1: Direct Railway MySQL variables
if (getenv('MYSQLHOST')) {
    echo "<p>Testing with MYSQLHOST...</p>";
    $host = getenv('MYSQLHOST');
    $user = getenv('MYSQLUSER') ?: 'root';
    $pass = getenv('MYSQLPASSWORD');
    $db = getenv('MYSQLDATABASE') ?: 'railway';
    
    echo "<p>Host: $host, User: $user, Database: $db</p>";
    
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
    } else {
        echo "<p style='color: green;'>✅ Connection successful!</p>";
        $conn->close();
    }
}

// Test 2: Parse MYSQL_URL if available
if (getenv('MYSQL_URL')) {
    echo "<p>Testing with MYSQL_URL...</p>";
    $url = parse_url(getenv('MYSQL_URL'));
    if ($url) {
        $host = $url['host'];
        $user = $url['user'];
        $pass = $url['pass'];
        $db = ltrim($url['path'], '/');
        
        echo "<p>Host: $host, User: $user, Database: $db</p>";
        
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
        } else {
            echo "<p style='color: green;'>✅ Connection successful!</p>";
            $conn->close();
        }
    }
}

echo "<p><strong>Note:</strong> Delete this file after debugging for security.</p>";
?>
