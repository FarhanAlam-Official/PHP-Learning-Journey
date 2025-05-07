<?php
/**
 * Day 12 - Main Entry Point
 * This script redirects to the main application in the Day_12 folder
 * 
 * Learning Objectives:
 * 1. Advanced Cookie Management
 * 2. User Authentication with Cookies
 * 3. Session-like behavior using cookies
 * 4. Conditional redirects based on user state
 */

// Ensure nothing has been output before redirect
ob_start();

// Display a message (optional)
echo "<p>Redirecting to Cookie Management System...</p>";

// Perform redirect to Day_12/index.php
header("Location: Day_12/index.php");

// Ensure the script stops executing after redirect
exit();
?>