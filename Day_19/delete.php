<?php
    include "../db.php";
    $conn = db();
    
    // Initialize variables
    $user = [];
    $error = "";
    $success = "";
    $deletion_complete = false;

    // Check if ID is provided in the URL
    if(isset($_GET['id']) && !isset($_POST['confirm_delete'])) {
        $id = $_GET['id'];
        
        // Fetch user data for confirmation
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            $error = "User not found.";
        }
        
        $stmt->close();
    } else if(!isset($_GET['id']) && !isset($_POST['confirm_delete'])) {
        $error = "No user ID provided.";
    }

    // Process deletion if confirmed
    if(isset($_POST['confirm_delete'])) {
        $id = $_POST['id'];
        
        // Delete user using prepared statement
        $stmt = $conn->prepare("DELETE FROM `users` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        
        if(!$result) {
            // In production, it's better to log the specific error and show a generic one.
            // error_log("Deletion failed: " . $stmt->error);
            $error = "Deletion failed. Please try again.";
        } else {
            $success = "User deleted successfully.";
            $deletion_complete = true;
        }
        
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 19 of PHP - Delete User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional styles specific to this page */
        .delete-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }
        
        .user-info {
            background-color: var(--light);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            margin: 1.5rem 0;
        }
        
        .user-info p {
            margin: 0.5rem 0;
            font-size: 1.1rem;
        }
        
        .user-info strong {
            color: var(--primary);
        }
        
        .warning-icon {
            font-size: 3rem;
            color: var(--warning);
            margin-bottom: 1rem;
        }
        
        .delete-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <!-- Day indicator at the top of the page -->
    <div class="day-indicator">Day 19 of PHP Learning Journey</div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Delete User</h1>
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
        </div>

        <?php if(!empty($error)): ?>
            <div class="alert alert-error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($user['id']) && !isset($_POST['confirm_delete']) && !$deletion_complete): ?>
            <div class="confirmation-box">
                <div class="confirmation-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h2 class="confirmation-title">Confirm Deletion</h2>
                <p class="confirmation-message">Are you sure you want to delete this user? This action cannot be undone.</p>
                
                <div class="user-info">
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Status:</strong> 
                        <?php if($user['status'] == 1): ?>
                            <span style="color: var(--success);">Active</span>
                        <?php else: ?>
                            <span style="color: var(--error);">Inactive</span>
                        <?php endif; ?>
                    </p>
                </div>
                
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <div class="button-group">
                        <button type="submit" name="confirm_delete" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Yes, Delete User
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        <?php elseif($deletion_complete): ?>
            <div class="confirmation-box">
                <div class="confirmation-icon" style="color: var(--success);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="confirmation-title">User Deleted Successfully</h2>
                <p class="confirmation-message">The user has been permanently removed from the database.</p>
                
                <div class="redirect-message">
                    <p>You will be redirected to the user list in <span class="countdown">5</span> seconds...</p>
                </div>
                
                <div class="button-group">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-list"></i> Return to User List
                    </a>
                </div>
            </div>
            
            <script>
                // Countdown and redirect
                let count = 5;
                const countdown = document.querySelector(".countdown");
                const timer = setInterval(function() {
                    count--;
                    countdown.textContent = count;
                    if (count <= 0) {
                        clearInterval(timer);
                        window.location.href = "index.php?deleted=true";
                    }
                }, 1000);
            </script>
        <?php else: ?>
            <div class="confirmation-box">
                <div class="confirmation-icon" style="color: var(--warning);">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h2 class="confirmation-title">Invalid Request</h2>
                <p class="confirmation-message">No valid user ID was provided or the user does not exist.</p>
                
                <div class="button-group">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-list"></i> Return to User List
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <p>PHP Learning Journey - Day 19: User Management System</p>
        <p>Created on: <?= date("F j, Y") ?></p>
    </footer>
</body>
</html>
