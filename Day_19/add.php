<?php
    include "../db.php";
    $conn = db();

    // Initialize variables with better validation feedback
    $error = "";
    $success = "";
    $formData = [
        'username' => '',
        'email' => '',
        'status' => '1'
    ];

    // Handle form submission with improved validation
    if(isset($_POST['add'])) {
        $formData = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'status' => $_POST['status']
        ];
        
        // Enhanced validation with specific error messages
        if(empty($formData['username'])) {
            $error = "<i class='fas fa-exclamation-circle'></i> Username is required";
        } elseif(strlen($formData['username']) < 3) {
            $error = "<i class='fas fa-exclamation-circle'></i> Username must be at least 3 characters";
        } elseif(empty($formData['email'])) {
            $error = "<i class='fas fa-exclamation-circle'></i> Email is required";
        } elseif(!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $error = "<i class='fas fa-exclamation-circle'></i> Please enter a valid email address";
        } else {
            try {
                // Check if email already exists
                $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $checkStmt->bind_param("s", $formData['email']);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();
                
                if ($checkResult->num_rows > 0) {
                    $error = "<i class='fas fa-exclamation-circle'></i> This email is already registered";
                } else {
                    $query = "INSERT INTO `users` (`username`, `email`, `status`) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssi", $formData['username'], $formData['email'], $formData['status']);
                    
                    if ($stmt->execute()) {
                        header("Location: index.php?added=true");
                        exit;
                    } else {
                        throw new Exception($conn->error);
                    }
                }
            } catch (Exception $e) {
                $error = "<i class='fas fa-exclamation-circle'></i> Failed to add user: " . $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 19 of PHP - Add New User</title>
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
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-user-plus"></i> Add New User
            </h1>
            <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
        </div>

        <?php if(!empty($error)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="post" class="add-user-form">
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i> Username
                    </label>
                    <input type="text" 
                           class="form-control" 
                           name="username" 
                           id="username" 
                           required
                           placeholder="Enter username">
                </div>
                
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input type="email" 
                           class="form-control" 
                           name="email" 
                           id="email" 
                           required
                           placeholder="Enter email">
                </div>
                
                <div class="form-group">
                    <label for="status">
                        <i class="fas fa-toggle-on"></i> Status
                    </label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                
                <div class="form-actions">
                    <button type="submit" name="add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>PHP Learning Journey - Day 19: User Management System</p>
        <p>Created on: <?= date("F j, Y") ?></p>
    </footer>
</body>
</html>

