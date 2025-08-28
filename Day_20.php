<?php
    include "db.php";
    $conn = db();
    
    // Handle delete confirmation
    $deleteMessage = "";
    if(isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
        $deleteMessage = "<div class='alert alert-success'>User deleted successfully!</div>";
    }
    
    // Handle status update confirmation
    $updateMessage = "";
    if(isset($_GET['updated']) && $_GET['updated'] == 'true') {
        $updateMessage = "<div class='alert alert-success'>User updated successfully!</div>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 19 of PHP - User Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        
        /* Day indicator at the top of the page */
        .day-indicator {
            background-color: var(--primary-dark);
            color: var(--white);
            text-align: center;
            padding: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .page-title {
            margin: 0;
            color: var(--dark);
            font-size: 2rem;
            font-weight: 700;
        }
        
        .add-user-btn {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .add-user-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .user-container {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-top: 20px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
        }
        
        .alert-success {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #f8fafc;
            font-weight: 600;
            color: var(--dark);
            position: relative;
        }
        
        th:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, var(--primary-light), transparent);
        }

        tr:hover {
            background-color: rgba(248, 250, 252, 0.7);
        }

        .status-active {
            color: var(--success);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-inactive {
            color: var(--error);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        
        .status-active .status-dot {
            background-color: var(--success);
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
        }
        
        .status-inactive .status-dot {
            background-color: var(--error);
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .edit-btn {
            background-color: var(--info);
            color: white;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
        }

        .delete-btn {
            background-color: var(--error);
            color: white;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
        }
        
        .edit-btn:hover, .delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state {
            padding: 40px;
            text-align: center;
        }
        
        .empty-state-icon {
            font-size: 3rem;
            color: var(--gray);
            margin-bottom: 20px;
        }
        
        .empty-state-text {
            color: var(--gray);
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        
        /* Learning section */
        .learning-section {
            margin-top: 60px;
        }
        
        .learning-title {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
            font-size: 1.8rem;
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .learning-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border-top: 4px solid var(--primary);
        }
        
        .learning-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
        }
        
        .learning-card h3 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .learning-card h3 i {
            color: var(--primary);
        }
        
        .learning-card p {
            margin: 0;
            color: var(--dark);
            font-size: 0.95rem;
            line-height: 1.7;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: var(--white);
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
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            th, td {
                padding: 10px;
            }
            
            .learning-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* For very small screens, make table scrollable */
        @media (max-width: 576px) {
            .user-container {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Day indicator at the top of the page -->
    <div class="day-indicator">Day 20 of PHP Learning Journey</div>
    
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">User Management System</h1>

            <!-- Search bar to be addded here on left of add new user button  -->
            <form method="get" style="display: inline;">
                <input class="search-bar" type="search" name="search" id="search" placeholder="Search for students" style="padding: 10px; border-radius: var(--border-radius); border: 1px solid #e2e8f0; width: 400px;">
                <button type="submit" style="padding: 10px 16px; border-radius: var(--border-radius); border: none; background: var(--primary); color: white; font-weight: 500; margin-left: 8px; cursor: pointer;">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>

            <?php 
                if(isset($_GET['search'])){
                    $searchQuery = htmlspecialchars($_GET['search']);
                    // Prepare the SQL query to prevent SQL injection
                    // Note: Using prepared statements is a good practice to prevent SQL injection
                    // $query = "SELECT * FROM `users` WHERE `username` LIKE '%$searchQuery%' OR `email` LIKE '%$searchQuery%'";
                    // $result = $conn->query($query);

                    // Using prepared statements for better security
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    // Prepare the SQL statement
                    $preparedStatement = $conn->prepare("SELECT * FROM `users` WHERE `username` LIKE ? OR `email` LIKE ?");
                    $searchTerm = "%" . $searchQuery . "%";
                    $preparedStatement->bind_param("ss", $searchTerm, $searchTerm);
                    $preparedStatement->execute();
                    $result = $preparedStatement->get_result();
                    $preparedStatement->close();
                    // Display search results
                    if ($result && $result->num_rows > 0) {
                        echo "<div class='alert alert-info'>Search results for: <strong>" . htmlspecialchars($searchQuery) . "</strong></div>";
                    } else {
                        echo "<div class='alert alert-warning'>No results found for: <strong>" . htmlspecialchars($searchQuery) . "</strong></div>";
                    }
                    // Display the search results in a table
                    
                }

            ?>

            <a href="Day_19_Add.php" class="add-user-btn">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>
        
        <?php 
            // Display success messages if any
            echo $deleteMessage;
            echo $updateMessage;
        ?>
        
        <div class="user-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    <?php
                    // Use search results if available, otherwise show all users
                    if (isset($result) && isset($_GET['search'])) {
                        // $result is already set by the search block above
                    } else {
                        $query = "SELECT * FROM `users`";
                        $result = $conn->query($query);
                    }
                    
                    if (!$result) {
                        echo "<tr><td colspan='5'>Query failed: " . $conn->error . "</td></tr>";
                    } else if ($result->num_rows == 0) {
                        echo "<tr><td colspan='5' class='empty-state'>
                                <div class='empty-state-icon'><i class='fas fa-users-slash'></i></div>
                                <div class='empty-state-text'>No users found. Add your first user to get started!</div>
                                <a href='Day_19_Add.php' class='add-user-btn'>
                                    <i class='fas fa-plus'></i> Add New User
                                </a>
                                </td></tr>";
                    } else {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            
                            if($row["status"] == 1){
                                echo "<td><span class='status-active'><span class='status-dot'></span> Active</span></td>";
                            } else{
                                echo "<td><span class='status-inactive'><span class='status-dot'></span> Inactive</span></td>";
                            }
                            
                            echo "<td class='action-buttons'>
                                    <a class='edit-btn' href='Day_19_Edit.php?id=".$row['id']."'>
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                    <a class='delete-btn' href='Day_19_Delete.php?id=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this user?\")'>
                                        <i class='fas fa-trash'></i> Delete
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                    }                    
                    ?>
                </tbody>
            </table>            
        </div>
        
        <!-- Learning Section with Cards -->
        <div class="learning-section">
            <h2 class="learning-title">What We Learned - Day 19</h2>
            
            <div class="learning-grid">
                <div class="learning-card">
                    <h3><i class="fas fa-database"></i> CRUD Operations</h3>
                    <p>We implemented a complete CRUD (Create, Read, Update, Delete) system for user management, allowing us to perform all necessary database operations through a user-friendly interface.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-shield-alt"></i> Data Security</h3>
                    <p>We used proper data sanitization with htmlspecialchars() to prevent XSS attacks and implemented confirmation dialogs for destructive actions to prevent accidental data loss.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-paint-brush"></i> UI/UX Design</h3>
                    <p>We created a clean, responsive user interface with visual status indicators, action buttons, and proper spacing to enhance usability and provide a better user experience.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-code"></i> Modular Code Structure</h3>
                    <p>We organized our code into separate files for different operations (view, add, edit, delete), making the codebase more maintainable and easier to understand.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 20
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 16, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_19.php" class="nav-btn">← Day 19</a>
            <span class="day-counter">Day 20 of 25</span>
            <a href="Day_21/index.php" class="nav-btn">Day 21 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 20/25 (80.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 80.00%"></div>
            </div>
            <div class="progress-percentage">80.00% Complete</div>
        </div>
    </div>
</body>
</html>
