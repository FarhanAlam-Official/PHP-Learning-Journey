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
        // Debug: Check what environment variables are available
        $env_vars = [
            'RAILWAY_ENVIRONMENT' => getenv('RAILWAY_ENVIRONMENT'),
            'DATABASE_URL' => getenv('DATABASE_URL'),
            'DB_HOST' => getenv('DB_HOST'),
            'DB_USER' => getenv('DB_USER'),
            'DB_PASSWORD' => getenv('DB_PASSWORD'),
            'DB_NAME' => getenv('DB_NAME')
        ];
        
        // Check if we're in Railway environment
        if (getenv('RAILWAY_ENVIRONMENT') || getenv('DATABASE_URL')) {
            // Railway environment - use environment variables
            $host = getenv('DB_HOST') ?: 'localhost';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASSWORD') ?: '';
            $db = getenv('DB_NAME') ?: 'php_journey';
            
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
        }
        
        // Debug: Log connection attempt (remove in production)
        error_log("Attempting database connection to: $host, user: $user, database: $db");
        
        // Create connection
        $conn = new mysqli($host, $user, $pass, $db);
        
        // Check connection
        if ($conn->connect_error) {
            // Log the error with more details
            error_log("Database connection failed: " . $conn->connect_error);
            error_log("Connection details - Host: $host, User: $user, Database: $db");
            error_log("Environment variables: " . print_r($env_vars, true));
            
            // Return the connection object even with error
            // This allows the calling code to handle the error appropriately
            return $conn;
        }
        
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
