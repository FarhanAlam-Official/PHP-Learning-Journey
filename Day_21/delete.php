<?php
session_start();

// Prevent direct URL access without file parameter
if(!isset($_GET['file'])) {
    $_SESSION['message'] = "<div class='alert alert-error'>No file specified for deletion</div>";
    header('Location: index.php');
    exit();
}

$filename = $_GET['file'];
$filepath = "uploads/" . $filename;

// Basic security checks
if(strpos($filename, '..') !== false || strpos($filename, '/') !== false) {
    $_SESSION['message'] = "<div class='alert alert-error'>Invalid file path</div>";
    header('Location: index.php');
    exit();
}

// Check if file exists and is within uploads directory
if(file_exists($filepath) && is_file($filepath)) {
    // Delete the file
    if(unlink($filepath)) {
        $_SESSION['message'] = "<div class='alert alert-success'>File deleted successfully!</div>";
    } else {
        $_SESSION['message'] = "<div class='alert alert-error'>Failed to delete file</div>";
    }
} else {
    $_SESSION['message'] = "<div class='alert alert-error'>File not found</div>";
}

header('Location: index.php');
exit();
?> 