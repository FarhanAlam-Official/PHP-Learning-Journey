<?php
session_start(); // Start the session at the very top of the script.

$host = "localhost";
$user = "Farhan Alam";
$pass = "password@123";
$db = "bca-6th-sem";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process status toggle
if(isset($_GET['id']) && isset($_GET['status'])) {
    // It's good practice to cast inputs to their expected type.
    $id = (int)$_GET['id'];
    $currentStatus = (int)$_GET['status'];
    
    // Toggle status (if 1 then 0, if 0 then 1)
    $newStatus = ($currentStatus == 1) ? 0 : 1;
    
    // Use prepared statements to prevent SQL injection.
    $stmt = $conn->prepare("UPDATE `students` SET `Status` = ? WHERE `id` = ?");
    $stmt->bind_param("ii", $newStatus, $id);
    $result = $stmt->execute();
    
    if (!$result) {
        // If update fails, store error in session
        // Avoid exposing detailed database errors to the user. Log them for your own review.
        // error_log("Toggle failed: " . $stmt->error);
        $_SESSION['toggle_error'] = "Failed to update status.";
    } else {
        // If update succeeds, store success message in session
        $action = ($newStatus == 1) ? "activated" : "deactivated";
        $_SESSION['toggle_success'] = "Student status successfully $action";
    }
}

// Close connection
$conn->close();

// Redirect back to the main page
header("Location: index.php");
exit;
?>