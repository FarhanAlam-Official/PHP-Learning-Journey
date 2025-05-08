<?php
/**
 * Day 13 - Main Entry Point
 * This script redirects to the main application in the Day_13 folder
 * 
 * Learning Objectives:
 * 1. URL redirection in PHP
 * 2. Header manipulation
 * 3. Clean routing practices
 */

// Ensure nothing has been output before redirect
ob_start();

// Display a message (optional)
echo "<p>Redirecting to application...</p>";

// Perform redirect to Day_13/index.php
header("Location: Day_13/index.php");

// Ensure the script stops executing after redirect
exit();
?>