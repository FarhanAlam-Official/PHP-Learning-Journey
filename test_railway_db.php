<?php
/**
 * Test Railway Database Connection
 */

echo "<h2>Testing Railway Database Connection</h2>";

// Test different Railway database connection patterns
$connectionTests = [
    [
        'name' => 'Railway Default MySQL',
        'host' => 'containers-us-west-1.railway.app',
        'user' => 'root',
        'pass' => 'example',
        'db' => 'railway'
    ],
    [
        'name' => 'Railway Internal Domain',
        'host' => 'php-learning-journey.railway.internal',
        'user' => 'root',
        'pass' => 'example',
        'db' => 'railway'
    ],
    [
        'name' => 'Localhost Fallback',
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'db' => 'php_journey'
    ]
];

foreach ($connectionTests as $test) {
    echo "<h3>Testing: {$test['name']}</h3>";
    echo "<p>Host: {$test['host']}, User: {$test['user']}, Database: {$test['db']}</p>";
    
    try {
        $conn = new mysqli($test['host'], $test['user'], $test['pass'], $test['db']);
        
        if ($conn->connect_error) {
            echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
        } else {
            echo "<p style='color: green;'>✅ Connection successful!</p>";
            
            // Test a simple query
            $result = $conn->query("SELECT 1 as test");
            if ($result) {
                echo "<p style='color: green;'>✅ Query test successful!</p>";
            } else {
                echo "<p style='color: orange;'>⚠️ Query test failed: " . $conn->error . "</p>";
            }
            
            $conn->close();
            break; // Stop testing if we found a working connection
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Exception: " . $e->getMessage() . "</p>";
    }
}

// Show current environment
echo "<h3>Current Environment:</h3>";
echo "<p>RAILWAY_ENVIRONMENT: " . getenv('RAILWAY_ENVIRONMENT') . "</p>";
echo "<p>RAILWAY_PRIVATE_DOMAIN: " . getenv('RAILWAY_PRIVATE_DOMAIN') . "</p>";
echo "<p>RAILWAY_PUBLIC_DOMAIN: " . getenv('RAILWAY_PUBLIC_DOMAIN') . "</p>";

echo "<p><strong>Note:</strong> Delete this file after testing for security.</p>";
?>
