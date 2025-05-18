<?php
/**
 * Day 21 - Main Entry Point
 * This script redirects to the main application in the Day_21 folder
 * 
 * Learning Objectives:
 * 1. Advanced File Handling Operations
 * 2. File upload with security validation
 * 3. File management (create, read, delete)
 * 4. Text editor functionality
 * 5. Directory operations
 * 6. File security and path validation
 */

// Ensure nothing has been output before redirect
ob_start();

// Display a message (optional)
echo "<p>Redirecting to File Management System...</p>";

// Perform redirect to Day_21/index.php
header("Location: Day_21/index.php");

// Ensure the script stops executing after redirect
exit();
?>