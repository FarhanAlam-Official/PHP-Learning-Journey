<?php
    // Database connection
    include __DIR__ . '/../db.php';

    //local development
    // $host = "localhost";
    // $user = "Farhan Alam";
    // $pass = "password@123";
    // $db = "bca-6th-sem";

    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        $connection_status = "<p class='error'>Connection failed: " . $conn->connect_error . "</p>";
    } else {
        $connection_status = "<p class='success'>Connection successful</p>";
        
        // Query to fetch student data for editing
        if(isset($_GET['id'])) {
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
        
        // Handle form submission for updating student data
        if(isset($_POST['update'])) {
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $status = $_POST['status'];
            
            // Make sure we have an ID before updating
            if(!empty($id)) {
                $query = "UPDATE `students` SET `Name`='$name', `Phone`='$phone', `Address`='$address', `Email`='$email', `Status`='$status' WHERE `id` = $id";
                $result = $conn->query($query);
                
                if (!$result) {
                    $query_status = "<p class='error'>Update failed: " . $conn->error . "</p>";
                } else {
                    $query_status = "<p class='success'>Update successful</p>";
                    header("Location: index.php");
                    exit;
                }
            } else {
                $query_status = "<p class='error'>Update failed: Student ID is missing</p>";
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
            padding: 20px;
        }
        
        /* Status messages */
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            text-align: center;
            font-weight: 500;
        }
        
        .success {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }
        
        .error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }
        
        /* Form styles */
        form {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--dark);
            font-weight: 500;
        }
        
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            background-color: var(--primary-light);
        }
        
        .form-group select option {
            background-color: var(--white);
            color: var(--dark);
        }
        
        .form-group button {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .form-group button:hover {
            background-color: var(--primary-dark);
        }
        
        /* Footer styles */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--primary);
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .footer-dates {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .footer-dates p {
            margin: 5px 0;
        }

        .navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .nav-btn {
            padding: 8px 16px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .nav-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .day-counter {
            font-weight: 600;
            color: var(--dark);
            font-size: 1rem;
        }

        .progress-section {
            margin-top: 20px;
        }

        .progress-text {
            color: var(--dark);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .progress-bar {
            width: 100%;
            max-width: 400px;
            height: 12px;
            background-color: #e2e8f0;
            border-radius: 6px;
            margin: 0 auto;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 6px;
            transition: width 0.5s ease;
        }

        .progress-percentage {
            color: var(--primary);
            font-weight: 600;
            margin-top: 8px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1 class="dashboard-title">Day 16: Edit Student</h1>
        <p class="dashboard-subtitle">Update student information in the database</p>
    </div>
    
    <div class="container">
        <?php echo $connection_status; ?>
        <?php if (isset($query_status)) {
            echo $query_status;
        } ?>
        <form method="post">
            <!-- Add hidden input for ID -->
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo isset($student['Name']) ? $student['Name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo isset($student['Phone']) ? $student['Phone'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="<?php echo isset($student['Address']) ? $student['Address'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo isset($student['Email']) ? $student['Email'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="Active" <?php if(isset($student['Status']) && $student['Status'] == 'Active') echo 'selected'; ?>>Active</option>
                    <option value="Inactive" <?php if(isset($student['Status']) && $student['Status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="update">Update</button>
            </div>
        </form>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 16
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 11, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="../Day_15.php" class="nav-btn">← Day 15</a>
            <span class="day-counter">Day 16 of 22</span>
            <a href="../Day_17.php" class="nav-btn">Day 17 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 16/22 (72.7%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 72.7%"></div>
            </div>
            <div class="progress-percentage">72.7% Complete</div>
        </div>
    </div>
</body>
</html>
