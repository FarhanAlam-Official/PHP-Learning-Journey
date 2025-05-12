<?php
/**
 * Day 16 - Main Entry Point
 * This script redirects to the main application in the Day_16 folder
 * 
 * Learning Objectives:
 * 1. Complete CRUD Operations (Create, Read, Update, Delete)
 * 2. Student Management System
 * 3. Database interactions with MySQL
 * 4. Status toggle functionality
 * 5. Form handling and validation
 */

// Ensure nothing has been output before redirect
ob_start();

// Display a message (optional)
echo "<p>Redirecting to Student Management System...</p>";

// Perform redirect to Day_16/index.php
header("Location: Day_16/index.php");

// Ensure the script stops executing after redirect
exit();
?>