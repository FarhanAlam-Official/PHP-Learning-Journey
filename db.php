<?php
/**
 * Database Connection Function
 * 
 * This file provides a reusable function to establish a connection to the MySQL database.
 * It encapsulates the database connection details and provides error handling.
 * 
 * @return mysqli A MySQL database connection object
 */
    function db() {
        //local development
        // $host = "localhost";
        // $user = "Farhan Alam";
        // $pass = "password@123";
        // $db = "bca-6th-sem";
        
        // Debug: Log what environment variables are available
        error_log("Checking environment variables...");
        error_log("MYSQLHOST: " . (getenv('MYSQLHOST') ?: 'NOT SET'));
        error_log("MYSQL_URL: " . (getenv('MYSQL_URL') ?: 'NOT SET'));
        error_log("RAILWAY_ENVIRONMENT: " . (getenv('RAILWAY_ENVIRONMENT') ?: 'NOT SET'));
        
        // Check for Railway MySQL environment variables first
        if (getenv('MYSQLHOST')) {
            // Railway MySQL environment
            $host = getenv('MYSQLHOST');
            $user = getenv('MYSQLUSER') ?: 'root';
            $pass = getenv('MYSQLPASSWORD');
            $db = getenv('MYSQLDATABASE') ?: 'railway';
            
            error_log("Using Railway MySQL variables: $host, $user, $db");
        }
        // Check for MYSQL_URL (Railway's preferred method)
        elseif (getenv('MYSQL_URL')) {
            // Parse Railway's MYSQL_URL
            $url = parse_url(getenv('MYSQL_URL'));
            if ($url) {
                $host = $url['host'];
                $user = $url['user'];
                $pass = $url['pass'];
                $db = ltrim($url['path'], '/');
                
                error_log("Using MYSQL_URL: $host, $user, $db");
            } else {
                error_log("Failed to parse MYSQL_URL");
                // Fallback to localhost
                $host = "localhost";
                $user = "root";
                $pass = "";
                $db = "php_journey";
            }
        }
        // Check for Docker environment variables
        elseif (getenv('PHP_DB_HOST')) {
            // Docker environment
            $host = getenv('PHP_DB_HOST') ?: 'db';
            $user = getenv('PHP_DB_USER') ?: 'root';
            $pass = getenv('PHP_DB_PASS') ?: 'example';
            $db = getenv('PHP_DB_NAME') ?: 'php_journey';
            
            error_log("Using Docker variables: $host, $user, $db");
        }
        // Check if we're in Railway environment
        elseif (getenv('RAILWAY_ENVIRONMENT') || getenv('DATABASE_URL')) {
            // Railway environment - use environment variables
            $host = getenv('DB_HOST') ?: 'localhost';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASSWORD') ?: '';
            $db = getenv('DB_NAME') ?: 'php_journey';
            
            error_log("Using Railway environment variables: $host, $user, $db");
            
            // If DATABASE_URL is provided, parse it
            if (getenv('DATABASE_URL')) {
                $url = parse_url(getenv('DATABASE_URL'));
                if ($url) {
                    $host = $url['host'] ?? $host;
                    $user = $url['user'] ?? $user;
                    $pass = $url['pass'] ?? $pass;
                    $db = ltrim($url['path'] ?? $db, '/');
                }
            }
        } else {
            // Local development environment
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "php_journey";
            
            error_log("Using local development: $host, $user, $db");
        }
        
        error_log("Final connection attempt: $host, $user, $db");
        
        // Create connection
        $conn = new mysqli($host, $user, $pass, $db);
        
        // Check connection
        if ($conn->connect_error) {
            // Log the error
            error_log("Database connection failed: " . $conn->connect_error);
            error_log("Attempted connection to: $host, user: $user, database: $db");
            
            // Return the connection object with error (pages can handle this gracefully)
            return $conn;
        }
        
        error_log("Database connection successful!");
        
        // Set character set to ensure proper handling of special characters
        $conn->set_charset("utf8mb4");
        
        // Return the connection object
        return $conn;
    }
    
    /**
     * Close Database Connection
     * 
     * A helper function to safely close a database connection.
     * 
     * @param mysqli $conn The database connection to close
     * @return void
     */
    function closeDb($conn) {
        if ($conn && !$conn->connect_error) {
            $conn->close();
        }
    }
?>
