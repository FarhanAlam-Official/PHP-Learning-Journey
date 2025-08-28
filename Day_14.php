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
    
    // Query to fetch categories
    $query = "SELECT * FROM `category`";
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
    <title>Day 14 of PHP </title>
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
        
        h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        /* Subtitle */
        .subtitle {
            text-align: center;
            color: var(--gray);
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
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
        }
        
        th {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        tr:nth-child(even) {
            background-color: rgba(226, 232, 240, 0.3);
        }
        
        /* Learning section styles */
        .learning-section {
            margin-top: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
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
        
        /* Connection status messages */
        .connection-status {
            max-width: 800px;
            margin: 20px auto;
            padding: 15px;
            border-radius: var(--border-radius);
            background-color: var(--white);
            box-shadow: var(--box-shadow);
        }
        
        .success {
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .error {
            color: var(--error);
            border-left: 4px solid var(--error);
        }
    </style>
</head>
<body>
        <div class="day-indicator">Day 14 of PHP Learning Journey</div>

    <h1>PHP Database Connectivity</h1>
    <p class="subtitle">Learn how to connect to MySQL databases and perform queries using PHP</p>
    
    <div class="connection-status">
        <?php 
        echo $connection_status;
        if (isset($query_status)) {
            echo $query_status;
        }
        ?>
    </div>
    
    <div class="container">
        <?php
        if (isset($result) && $result->num_rows > 0) {
            echo "<table border='1'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                    </tr>
                </thead>
                <tbody>";
                
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["category_name"] . "</td>
                </tr>";
            }
            
            echo "</tbody></table>";
        } else {
            echo "<p>No categories found in the database.</p>";
        }
        
        if (isset($conn)) {
            $conn->close();
        }
        ?>
    </div>
    
    <!-- Learning Section with Cards -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 14</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>Database Connection</h3>
                <p>We learned how to establish a connection to a MySQL database using the mysqli_connect() function, providing the host, username, password, and database name.</p>
            </div>
            
            <div class="learning-card">
                <h3>SQL Queries</h3>
                <p>We executed SQL SELECT queries using mysqli_query() to retrieve data from database tables, demonstrating how to fetch information from a database.</p>
            </div>
            
            <div class="learning-card">
                <h3>Result Processing</h3>
                <p>We used mysqli_fetch_assoc() to process query results row by row, converting database records into PHP associative arrays for easy access.</p>
            </div>
            
            <div class="learning-card">
                <h3>Dynamic HTML Tables</h3>
                <p>We generated HTML tables dynamically using PHP to display database data in a structured format, showing how to integrate database content into web pages.</p>
            </div>
            
            <div class="learning-card">
                <h3>Error Handling</h3>
                <p>We implemented basic error handling to check if database connections and queries were successful, using conditional statements to provide appropriate feedback.</p>
            </div>
            
            <div class="learning-card">
                <h3>Resource Management</h3>
                <p>We properly closed the database connection using mysqli_close() when finished, demonstrating good practice for managing server resources.</p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 14
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 9, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_13.php" class="nav-btn">← Day 13</a>
            <span class="day-counter">Day 14 of 25</span>
            <a href="Day_15.php" class="nav-btn">Day 15 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 14/25 (56.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 56.00%"></div>
            </div>
            <div class="progress-percentage">56.00% Complete</div>
        </div>
    </div>
</body>
</html>
