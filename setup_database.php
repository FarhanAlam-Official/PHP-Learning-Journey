<?php
/**
 * Database Setup Script
 * Run this script once after setting up your Railway MySQL database
 * to create all necessary tables and sample data based on your database.sql
 */

// Include database connection
include 'db.php';

echo "<h2>Database Setup Script</h2>";

try {
    $conn = db();
    
    if ($conn->connect_error) {
        echo "<p style='color: red;'>❌ Database connection failed: " . $conn->connect_error . "</p>";
        echo "<p>Please make sure you have:</p>";
        echo "<ul>";
        echo "<li>Added a MySQL database service to your Railway project</li>";
        echo "<li>Set the correct environment variables (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)</li>";
        echo "</ul>";
        exit;
    }
    
    echo "<p style='color: green;'>✅ Database connected successfully!</p>";
    
    // Read and execute the database.sql file
    $sqlFile = file_get_contents('database.sql');
    
    if ($sqlFile === false) {
        echo "<p style='color: red;'>❌ Could not read database.sql file</p>";
        exit;
    }
    
    // Split the SQL file into individual statements
    $statements = explode(';', $sqlFile);
    
    $successCount = 0;
    $errorCount = 0;
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        
        // Skip empty statements and comments
        if (empty($statement) || strpos($statement, '--') === 0 || strpos($statement, '/*') === 0) {
            continue;
        }
        
        // Execute the statement
        if ($conn->query($statement)) {
            $successCount++;
            echo "<p style='color: green;'>✅ Executed: " . substr($statement, 0, 50) . "...</p>";
        } else {
            $errorCount++;
            echo "<p style='color: orange;'>⚠️ Error: " . $conn->error . "</p>";
        }
    }
    
    echo "<h3>Setup Summary:</h3>";
    echo "<p>✅ Successfully executed: $successCount statements</p>";
    echo "<p>⚠️ Errors: $errorCount statements</p>";
    
    // Show tables
    $result = $conn->query("SHOW TABLES");
    echo "<h3>Available Tables:</h3>";
    echo "<ul>";
    while ($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
    
    // Show sample data from each table
    echo "<h3>Sample Data Verification:</h3>";
    
    // Check category table
    $result = $conn->query("SELECT COUNT(*) as count FROM category");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p>📊 Categories: " . $row['count'] . " records</p>";
    }
    
    // Check students table
    $result = $conn->query("SELECT COUNT(*) as count FROM students");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p>📊 Students: " . $row['count'] . " records</p>";
    }
    
    // Check products table
    $result = $conn->query("SELECT COUNT(*) as count FROM products");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p>📊 Products: " . $row['count'] . " records</p>";
    }
    
    // Check users table
    $result = $conn->query("SELECT COUNT(*) as count FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p>📊 Users: " . $row['count'] . " records</p>";
    }
    
    // Check post table
    $result = $conn->query("SELECT COUNT(*) as count FROM post");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p>📊 Posts: " . $row['count'] . " records</p>";
    }
    
    echo "<h3>✅ Database setup completed successfully!</h3>";
    echo "<p>Your database now contains all the tables and data from your database.sql file.</p>";
    echo "<p><strong>Security Note:</strong> You can now delete this setup_database.php file for security.</p>";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>
