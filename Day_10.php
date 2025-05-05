<?php
/**
 * Day 10 - Main Entry Point
 * This script redirects to the main application in the Day_10 folder
 *
 * Learning Objectives:
 * 1. Session-based authentication system
 * 2. Protected routes implementation
 * 3. Login and logout functionality
 * 4. Session security best practices
 */

// Ensure nothing has been output before redirect
ob_start();

// Display a message (optional)
echo "<p>Redirecting to login system...</p>";

// Perform redirect to Day_10/index.php
header("Location: Day_10/index.php");

// Ensure the script stops executing after redirect
exit();
?>