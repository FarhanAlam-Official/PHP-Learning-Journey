<?php
    include "../db.php";
    $conn = db();
    
    // Initialize variables
    $user = [];
    $error = "";
    $success = "";

    // Check if ID is provided in the URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt=$conn->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            $error = "User not found.";
        }
        
        $stmt->close();
    } else {
        $error = "No user ID provided.";
    }

    // Handle form submission
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $status = $_POST['status'];
        
        // Validate inputs
        if(empty($username)) {
            $error = "Username is required.";
        } elseif(empty($email)) {
            $error = "Email is required.";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            // Update user using prepared statement
            $query = "UPDATE `users` SET `username`=?, `email`=?, `status`=? WHERE `id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssii", $username, $email, $status, $id);
            $result = $stmt->execute();

            if (!$result) {
                $error = "Update failed: " . $conn->error;
            } else {
                // Redirect with success message
                header("Location: index.php?updated=true");
                exit;
            }
            
            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 19 of PHP - Edit User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional styles specific to this page */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!-- Day indicator at the top of the page -->
    <div class="day-indicator">Day 19 of PHP Learning Journey</div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Edit User</h1>
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
        </div>

        <div class="form-container">
            <h2 class="form-title">Update User Information</h2>
            
            <?php if(!empty($error)): ?>
                <div class="alert alert-error">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="post">
                <input type="hidden" name="id" value="<?php echo isset($user['id']) ? $user['id'] : ''; ?>">
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo isset($user['username']) ? htmlspecialchars($user['username']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="1" <?php if(isset($user['status']) && $user['status'] == 1) echo 'selected'; ?>>Active</option>
                        <option value="0" <?php if(isset($user['status']) && $user['status'] == 0) echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
                
                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update User
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <p>PHP Learning Journey - Day 19: User Management System</p>
        <p>Created on: <?= date("F j, Y") ?></p>
    </footer>
</body>
</html>





