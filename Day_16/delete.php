<?php
//local development
// $host = "localhost";
// $user = "Farhan Alam";
// $pass = "password@123";
// $db = "bca-6th-sem";

// $conn = mysqli_connect($host, $user, $pass, $db);

// Production connection
include __DIR__ . '/../db.php';

// Use the db() function to get connection
$conn = db();

// Check connection
if ($conn->connect_error) {
    $connection_status = "<p class='error'>Connection failed: " . $conn->connect_error . "</p>";
} else {
    $connection_status = "<p class='success'>Connection successful</p>";
    
    // Fetch student data for confirmation
    if(isset($_GET['id']) && !isset($_POST['confirm_delete'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM `students` WHERE `id` = $id";
        $result = $conn->query($query);
        
        if (!$result) {
            $query_status = "<p class='error'>Query failed: " . $conn->error . "</p>";
        } else {
            $query_status = "<p class='success'>Query successful</p>";
            $student = $result->fetch_assoc();
        }
    }
    
    // Process deletion if confirmed
    if(isset($_POST['confirm_delete'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM `students` WHERE `id` = $id";
        $result = $conn->query($query);
        
        if (!$result) {
            $query_status = "<p class='error'>Deletion failed: " . $conn->error . "</p>";
        } else {
            $query_status = "<p class='success'>Deletion successful</p>";
            $deletion_complete = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 16 of PHP </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* CSS Variables for consistent theming */
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary: #06b6d4;
            --dark: #1e293b;
            --light: #f8fafc;
            --white: #ffffff;
            --gray: #94a3b8;
            --success: #22c55e;
            --info: #3b82f6;
            --warning: #f59e0b;
            --error: #ef4444;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            margin: 0;
            padding: 20px;
        }
        
        .dashboard-header {
            background-color: white;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .dashboard-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--primary);
            text-align: center;
            font-weight: 600;
        }
        
        .dashboard-subtitle {
            color: var(--gray);
            font-size: 1rem;
            text-align: center;
            margin-bottom: 0;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
            width: 100%;
        }
        
        .success {
            color: var(--success);
            border-left: 4px solid var(--success);
            padding-left: 10px;
            margin-bottom: 20px;
        }
        
        .error {
            color: var(--error);
            border-left: 4px solid var(--error);
            padding-left: 10px;
            margin-bottom: 20px;
        }
        
        .confirmation-box {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .confirmation-box h3 {
            color: var(--error);
            margin-top: 0;
        }
        
        .student-info {
            background-color: var(--primary-light);
            border-radius: var(--border-radius);
            padding: 15px;
            margin: 20px 0;
        }
        
        .student-info p {
            margin: 5px 0;
        }
        
        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .delete-btn {
            background-color: var(--error);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .delete-btn:hover {
            background-color: #dc2626;
        }
        
        .cancel-btn {
            background-color: var(--gray);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .cancel-btn:hover {
            background-color: #64748b;
        }
        
        .redirect-message {
            text-align: center;
            margin: 20px 0;
            font-size: 1.1rem;
            color: var(--primary);
        }
        
        .countdown {
            font-weight: bold;
            color: var(--primary-dark);
        }
        
        /* Footer styles */
        .footer {
            text-align: center;
            margin-top: 40px;
            color: var(--gray);
            font-size: 0.9rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1 class="dashboard-title">Day 16: Delete Student</h1>
        <p class="dashboard-subtitle">Remove student information from the database</p>
    </div>
    
    <div class="container">
        <?php 
        if(isset($connection_status)) {
            echo $connection_status;
        }
        if(isset($query_status)) {
            echo $query_status;
        }
        
        // Show deletion confirmation
        if(isset($_GET['id']) && !isset($_POST['confirm_delete']) && !isset($deletion_complete) && isset($student)) {
        ?>
            <div class="confirmation-box">
                <h3>Confirm Deletion</h3>
                <p>Are you sure you want to delete the following student record? This action cannot be undone.</p>
                
                <div class="student-info">
                    <p><strong>ID:</strong> <?php echo $student['id']; ?></p>
                    <p><strong>Name:</strong> <?php echo $student['Name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $student['Email']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $student['Phone']; ?></p>
                </div>
                
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                    <div class="button-group">
                        <button type="submit" name="confirm_delete" class="delete-btn">Yes, Delete</button>
                        <a href="Day_16.php" class="cancel-btn">Cancel</a>
                    </div>
                </form>
            </div>
        <?php
        } elseif(isset($deletion_complete)) {
            // Show success message and redirect countdown
            echo '<div class="redirect-message">';
            echo '<p>Student record has been successfully deleted.</p>';
            echo '<p>You will be redirected to the student list in <span class="countdown">5</span> seconds...</p>';
            echo '</div>';
            echo '<script>
                let count = 5;
                const countdown = document.querySelector(".countdown");
                const timer = setInterval(function() {
                    count--;
                    countdown.textContent = count;
                    if (count <= 0) {
                        clearInterval(timer);
                        window.location.href = "Day_16.php";
                    }
                }, 1000);
            </script>';
        } else {
            echo '<p>Invalid request. Please return to the <a href="Day_16.php">student list</a>.</p>';
        }
        ?>
    </div>
    
    <!-- Footer with dynamic date -->
    <div class="footer">
        <p>PHP Learning Journey - Day 16: Delete Student</p>
        <p>Created on: <?= date("F j, Y") ?></p>
    </div>
</body>
</html>

