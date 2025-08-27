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
        // Database configuration for local development
        // $host = "localhost";
        // $user = "Farhan Alam";
        // $pass = "password@123";
        // $db = "bca-6th-sem";
        
        // Database configuration for production
        $host = "db";
        $user = "root";
        $pass = "example";
        $db = "php_journey";
        
        // Create connection
        $conn = new mysqli($host, $user, $pass, $db);
        
        // Check connection
        if ($conn->connect_error) {
            // Log the error (in a production environment, you might want to log to a file)
            error_log("Database connection failed: " . $conn->connect_error);
            
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
