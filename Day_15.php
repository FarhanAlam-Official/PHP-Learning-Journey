<?php

    //local development
    // $host = "localhost";
    // $user = "Farhan Alam";
    // $pass = "password@123";
    // $db = "bca-6th-sem";

    // $conn = mysqli_connect($host, $user, $pass, $db);

    // Production connection
    include __DIR__ . '/db.php';

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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 15 of PHP </title>
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
            padding-top: 50px; /* Adjusted for fixed header */
            display: flex;
            flex-direction: column;
            align-items: center;
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
        
        /* Page title */
        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        /* Subtitle */
        .subtitle {
            text-align: center;
            color: var(--gray);
            margin-bottom: 30px;
            max-width: 600px;
        }
        
        .container {
            max-width: 1200px;
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
            max-width: 1200px;
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
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
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
            gap: 10px;
        }
        
        .actions a {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: var(--border-radius);
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .edit-btn {
            background-color: var(--info);
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #2563eb;
        }
        
        .delete-btn {
            background-color: var(--error);
            color: white;
        }
        
        .delete-btn:hover {
            background-color: #dc2626;
        }
        
        .status-active {
            background-color: rgba(34, 197, 94, 0.2);
            color: var(--success);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-inactive {
            background-color: rgba(239, 68, 68, 0.2);
            color: var(--error);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        /* Learning section styles */
        .learning-section {
            margin-top: 40px;
            max-width: 1200px;
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
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--primary);
            width: 100%;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
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
    <div class="day-indicator">Day 15 of PHP Learning Journey</div>
    <!-- Replace day indicator button with dashboard header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">PHP CRUD Operations</h1>
        <p class="dashboard-subtitle">Learn how to Create, Read, Update, and Delete data from a MySQL database using PHP</p>
    </div>
    
    <div class="connection-status">
        <?php 
        echo $connection_status;
        if (isset($query_status)) {
            echo $query_status;
        }
        ?>
    </div>
    
    <div class="container">
        <h2>Student Records</h2>
        
        <?php
        if(isset($result) && $result->num_rows > 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['Name']."</td>";
                    
                    $status = $row['Status'];
                    if($status == 1){
                        echo "<td><span class='status-active'>Active</span></td>";
                    } else{
                        echo "<td><span class='status-inactive'>Inactive</span></td>";
                    }
                    
                    echo "<td>".$row['Phone']."</td>";
                    echo "<td>".$row['Address']."</td>";
                    echo "<td>".$row['Email']."</td>";
                    echo "<td class='actions'>
                        <a href='edit.php?id=".$row['id']."' class='edit-btn'>Edit</a>
                        <a href='delete.php?id=".$row['id']."' class='delete-btn'>Delete</a>
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
    
    <!-- Learning Section with Cards -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 15</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>Database Retrieval</h3>
                <p>We learned how to retrieve data from a MySQL database using SELECT queries and display it in a structured HTML table.</p>
            </div>
            
            <div class="learning-card">
                <h3>Data Formatting</h3>
                <p>We implemented conditional formatting to display status values as user-friendly labels with appropriate styling.</p>
            </div>
            
            <div class="learning-card">
                <h3>Action Links</h3>
                <p>We created edit and delete links that pass record IDs via URL parameters to enable CRUD operations on specific records.</p>
            </div>
            
            <div class="learning-card">
                <h3>Table Styling</h3>
                <p>We applied responsive table styling with alternating row colors, hover effects, and proper spacing for better readability.</p>
            </div>
            
            <div class="learning-card">
                <h3>Error Handling</h3>
                <p>We implemented proper error handling for database connections and queries, displaying user-friendly messages.</p>
            </div>
            
            <div class="learning-card">
                <h3>Resource Management</h3>
                <p>We ensured proper resource management by closing the database connection after completing all operations.</p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 15
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 11, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_14.php" class="nav-btn">← Day 14</a>
            <span class="day-counter">Day 15 of 25</span>
            <a href="Day_16.php" class="nav-btn">Day 16 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 15/25 (60.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 60.00%"></div>
            </div>
            <div class="progress-percentage">60.00% Complete</div>
        </div>
    </div>
</body>
</html>
