<?php
/**
 * Day 19 - Main Entry Point
 * This script redirects to the main application in the Day_19 folder
 * 
 * Learning Objectives:
 * 1. Advanced User Management System
 * 2. Secure CRUD operations with prepared statements
 * 3. Input validation and sanitization
 * 4. Professional UI/UX design
 * 5. Modular code structure
 * 6. Error handling and user feedback
 */

// Ensure nothing has been output before redirect
ob_start();

// Display a message (optional)
echo "<p>Redirecting to User Management System...</p>";

// Perform redirect to Day_19/index.php
header("Location: Day_19/index.php");

// Ensure the script stops executing after redirect
exit();
?>