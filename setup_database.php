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
        echo "<li>Set the correct environment variables (MYSQLHOST, MYSQLUSER, MYSQLPASSWORD, MYSQLDATABASE, MYSQLPORT)</li>";
        echo "</ul>";
        exit;
    }
    
    echo "<p style='color: green;'>✅ Database connected successfully!</p>";
    
    // Read and preprocess the SQL dump
    $sqlRaw = file_get_contents('database.sql');
    if ($sqlRaw === false) {
        echo "<p style='color: red;'>❌ Could not read database.sql file</p>";
        exit;
    }

    // Normalize line endings
    $sql = str_replace(["\r\n", "\r"], "\n", $sqlRaw);

    // Remove multiline comments /* ... */ and /*! ... */
    $sql = preg_replace('#/\*!.*?\*/#s', '', $sql); // MySQL versioned comments
    $sql = preg_replace('#/\*.*?\*/#s', '', $sql);  // generic block comments

    // Remove single line comments starting with -- at line start
    $lines = explode("\n", $sql);
    $cleanLines = [];
    foreach ($lines as $line) {
        $trim = ltrim($line);
        if ($trim === '') { $cleanLines[] = $line; continue; }
        if (strpos($trim, '-- ') === 0 || $trim === '--') { continue; }
        $cleanLines[] = $line;
    }
    $sql = implode("\n", $cleanLines);

    // Optional: ensure we use the current database (MYSQLDATABASE)
    $dbName = getenv('MYSQLDATABASE') ?: 'railway';
    if (!empty($dbName)) {
        $conn->query("CREATE DATABASE IF NOT EXISTS `" . $conn->real_escape_string($dbName) . "`");
        $conn->query("USE `" . $conn->real_escape_string($dbName) . "`");
    }

    // Split into individual statements by semicolon followed by newline
    // This reduces risk of splitting inside data values
    $statements = preg_split('/;\s*\n/', $sql);

    $successCount = 0;
    $errorCount = 0;

    foreach ($statements as $statement) {
        $statement = trim($statement);
        if ($statement === '') { continue; }
        // Skip MySQL directives that aren't needed
        if (preg_match('/^(START TRANSACTION|COMMIT|SET\s+\w+)/i', $statement)) { continue; }
        // Append semicolon back (removed by split)
        $exec = $statement . ';';
        if ($conn->query($exec) === true) {
            $successCount++;
        } else {
            $error = $conn->error;
            // Some dumps contain statements that may fail if rerun; count as warning
            $errorCount++;
            echo "<p style='color: orange;'>⚠️ Error executing: " . htmlspecialchars(mb_substr($statement, 0, 80)) . "...<br>" . htmlspecialchars($error) . "</p>";
        }
    }

    echo "<h3>Setup Summary:</h3>";
    echo "<p>✅ Successfully executed: $successCount statements</p>";
    echo "<p>⚠️ Errors: $errorCount statements</p>";

    // Show tables
    $result = $conn->query("SHOW TABLES");
    echo "<h3>Available Tables:</h3>";
    echo "<ul>";
    $tables = [];
    if ($result) {
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
            echo "<li>" . htmlspecialchars($row[0]) . "</li>";
        }
    }
    echo "</ul>";

    // Sample counts for known tables if they exist
    echo "<h3>Sample Data Verification:</h3>";
    foreach (['category','students','products','users','post'] as $tbl) {
        if (in_array($tbl, $tables, true)) {
            $res = $conn->query("SELECT COUNT(*) AS c FROM `" . $conn->real_escape_string($tbl) . "`");
            if ($res && ($row = $res->fetch_assoc())) {
                echo "<p>📊 " . htmlspecialchars($tbl) . ": " . (int)$row['c'] . " records</p>";
            }
        }
    }

    echo "<h3>✅ Database setup completed.</h3>";
    echo "<p>If you see your tables listed above, setup succeeded. You can now delete this file for security.</p>";

    $conn->close();
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
