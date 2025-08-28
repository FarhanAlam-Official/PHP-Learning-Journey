<?php
// Start session to access session variables
session_start();

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
    
    // Query to fetch students
    $query = "SELECT * FROM `students`";
    $result = $conn->query($query);
    
    if (!$result) {
        $query_status = "<p class='error'>Query failed: " . $conn->error . "</p>";
    } else {
        $query_status = "<p class='success'>Query successful</p>";
    }
    
    $students = [];     // Initialize an empty array for students data
    if($result->num_rows > 0) {
        $students = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "<p>No students found in the database.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 16 of PHP </title>
    <?php include __DIR__ . '/../includes/head.php'; ?>
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
        
        /* Day Indicator styles */
        .day-indicator {
            background-color: var(--primary-dark);
            color: white;
            text-align: center;
            padding: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            letter-spacing: 1px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            margin: 0;
            padding: 20px;
            padding-top: 50px; /* Adjusted for fixed header */
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
            max-width: 1200px;  /* Increased from 1000px */
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
        
        .connection-status {
            max-width: 1000px;
            margin: 0 auto 20px;
            padding: 15px;
            border-radius: var(--border-radius);
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            width: 100%;
        }
        
        .success {
            color: var(--success);
            border-left: 4px solid var(--success);
            padding-left: 10px;
        }
        
        .error {
            color: var(--error);
            border-left: 4px solid var(--error);
            padding-left: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: var(--box-shadow);
            background-color: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            table-layout: fixed;  /* Added for better column width control */
        }
        
        th, td {
            padding: 10px 15px;  /* Reduced from 12px to 10px vertical padding */
            text-align: left;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            word-wrap: break-word;
            overflow: hidden;
        }
        
        th {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        tr:nth-child(even) {
            background-color: rgba(226, 232, 240, 0.3);
        }
        
        tr:hover {
            background-color: rgba(226, 232, 240, 0.5);
        }
        
        .actions {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        
        .actions button, .status-actions button {
            padding: 5px 12px;  /* Reduced vertical padding from 6px to 5px */
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-align: center;
            min-width: 70px;  /* Increased from 60px to 70px */
            cursor: pointer;
            border: none;
            outline: none;
        }
        
        .edit-btn {
            background-color: var(--info);
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(59, 130, 246, 0.3);
        }
        
        .delete-btn {
            background-color: var(--error);
            color: white;
        }
        
        .delete-btn:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(239, 68, 68, 0.3);
        }
        
        .status-active {
            background-color: rgba(34, 197, 94, 0.2);
            color: var(--success);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            text-align: center;
            display: inline-block;
        }
        
        .status-inactive {
            background-color: rgba(239, 68, 68, 0.2);
            color: var(--error);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            text-align: center;
            display: inline-block;
        }
        
        /* Learning section styles */
        .learning-section {
            margin-top: 40px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
            width: 100%;
        }
        
        .learning-title {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }
        
        .learning-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary-light);
            border-radius: 2px;
        }
        
        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .learning-card {
            background-color: var(--primary-light);
            border-radius: var(--border-radius);
            padding: 20px;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }
        
        .learning-card h3 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .learning-card p {
            margin: 0;
            color: var(--dark);
            font-size: 0.95rem;
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
        
        /* Status toggle button styles */
        .status-actions {
            text-align: center;
        }
        
        .activate-btn, .deactivate-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 12px;  /* Reduced vertical padding from 6px to 5px */
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            min-width: 110px;  /* Increased from 100px to 110px */
        }
        
        .activate-btn {
            background-color: var(--success);
            color: white;
        }
        
        .activate-btn:hover {
            background-color: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(34, 197, 94, 0.3);
        }
        
        .deactivate-btn {
            background-color: var(--warning);
            color: white;
        }
        
        .deactivate-btn:hover {
            background-color: #d97706;
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(245, 158, 11, 0.3);
        }
        
        .status-icon {
            margin-right: 5px;
            font-weight: bold;
        }
        
        /* Alert messages */
        .alert {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
        }
        
        .alert-success {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }
    </style>
</head>
<body>
        <div class="day-indicator">Day 16 of PHP Learning Journey</div>

    <div class="dashboard-header">
        <h1 class="dashboard-title">CRUD Operations and Status Management</h1>
        <p class="dashboard-subtitle">Learn how to manage student records effectively.</p>
    </div>
    
    <div class="container">
        <h2>Student Records</h2>
        
        <?php
        if(isset($result) && mysqli_num_rows($result) > 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 3%;">ID</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 8%;">Status</th>
                    <th style="width: 12%;">Phone</th>
                    <th style="width: 18%;">Address</th>
                    <th style="width: 18%;">Email</th>
                    <th style="width: 13%;">Actions</th>
                    <th style="width: 13%;">Active/Inactive</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($students as $student) {
                    echo "<tr>";
                    echo "<td style='text-align: center;'>".$student['id']."</td>";
                    echo "<td>".$student['Name']."</td>";
                    
                    $status = $student['Status'];
                    if($status == 1){
                        echo "<td style='text-align: center;'><span class='status-active'>Active</span></td>";
                    } else{
                        echo "<td style='text-align: center;'><span class='status-inactive'>Inactive</span></td>";
                    }
                    
                    echo "<td>".$student['Phone']."</td>";
                    echo "<td>".$student['Address']."</td>";
                    echo "<td>".$student['Email']."</td>";
                    echo "<td class='actions'>
                        <button onclick=\"window.location.href='edit.php?id=".$student['id']."'\" class='edit-btn'>Edit</button>
                        <button onclick=\"window.location.href='delete.php?id=".$student['id']."'\" class='delete-btn'>Delete</button>
                    </td>";
                    
                    // Improved status toggle button
                    $statusClass = ($student['Status'] == 1) ? 'deactivate-btn' : 'activate-btn';
                    $statusAction = ($student['Status'] == 1) ? 'Deactivate' : 'Activate';
                    $statusIcon = ($student['Status'] == 1) ? '&#10006;' : '&#10004;';
                    
                    echo "<td class='status-actions'>
                        <button onclick=\"window.location.href='toggle.php?id=".$student['id']."&status=".$student['Status']."'\" class='".$statusClass."'>
                            <span class='status-icon'>".$statusIcon."</span> ".$statusAction."
                        </button>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "<p>No student records found.</p>";
        }
        
        if(isset($conn)) {
            $conn->close();
        }
        ?>
    </div>
    
    <!-- Learning Section -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 16</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>PHP File Handling</h3>
                <p>We learned how to create, read, update, and delete files using PHP's file handling functions, enabling data persistence beyond database storage.</p>
            </div>
            
            <div class="learning-card">
                <h3>CRUD Operations</h3>
                <p>We implemented complete Create, Read, Update, and Delete operations for student records, including a status toggle feature for activating/deactivating records.</p>
            </div>
            
            <div class="learning-card">
                <h3>Database Integration</h3>
                <p>We connected PHP with MySQL to store and retrieve student data, using prepared statements for secure database operations.</p>
            </div>
            
            <div class="learning-card">
                <h3>User Feedback</h3>
                <p>We implemented session-based notifications to provide users with feedback after actions like toggling student status, enhancing the user experience.</p>
            </div>
            
            <div class="learning-card">
                <h3>Interactive UI</h3>
                <p>We created an interactive interface with styled buttons for edit, delete, and status toggle operations, making the application more user-friendly.</p>
            </div>
            
            <div class="learning-card">
                <h3>Responsive Design</h3>
                <p>We ensured the application is responsive and works well on different screen sizes by using flexible layouts and appropriate styling.</p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 16
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 12, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="../Day_15.php" class="nav-btn">← Day 15</a>
            <span class="day-counter">Day 16 of 25</span>
            <a href="../Day_17.php" class="nav-btn">Day 17 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 16/25 (64.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 64.00%"></div>
            </div>
            <div class="progress-percentage">64.00% Complete</div>
        </div>
    </div>
</body>
</html>
