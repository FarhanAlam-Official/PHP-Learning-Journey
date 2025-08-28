<?php
    include "../db.php";
    $conn = db();
    
    // Handle messages
    $message = "";
    if(isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
        $message = "<div class='alert alert-success'><i class='fas fa-check-circle'></i> User deleted successfully!</div>";
    } elseif(isset($_GET['updated']) && $_GET['updated'] == 'true') {
        $message = "<div class='alert alert-success'><i class='fas fa-check-circle'></i> User updated successfully!</div>";
    } elseif(isset($_GET['added']) && $_GET['added'] == 'true') {
        $message = "<div class='alert alert-success'><i class='fas fa-check-circle'></i> User added successfully!</div>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 19 of PHP - User Management System</title>
    <?php include __DIR__ . '/../includes/head.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Footer Styles */
        .footer {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
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
            font-weight: 600;
            margin-bottom: 15px;
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
            font-size: 0.9rem;
            transition: all 0.3s ease;
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
    <!-- Day indicator at the top of the page -->
    <div class="day-indicator">Day 19 of PHP Learning Journey</div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-users"></i> User Management System</h1>
            <a href="add.php" class="add-user-btn">
                <i class="fas fa-user-plus"></i> Add New User
            </a>
        </div>
        
        <?php echo $message; ?>
        
        <div class="user-container">
            <div class="table-header">
                <h2 class="table-title">User List</h2>
                <?php
                    // Count total users
                    $countQuery = "SELECT COUNT(*) as total FROM users";
                    $countResult = $conn->query($countQuery);
                    $totalUsers = $countResult->fetch_assoc()['total'];
                    echo "<span class='user-count'>{$totalUsers} Users</span>";
                ?>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get all users
                    $query = "SELECT * FROM `users` ORDER BY id DESC";
                    $result = $conn->query($query);
                    
                    if (!$result) {
                        echo "<tr><td colspan='5'>Query failed: " . $conn->error . "</td></tr>";
                    } else if ($result->num_rows == 0) {
                        echo "<tr><td colspan='5' class='empty-state'>
                                <div class='empty-state-icon'><i class='fas fa-users-slash'></i></div>
                                <div class='empty-state-text'>No users found. Add your first user to get started!</div>
                                <a href='add.php' class='add-user-btn'>
                                    <i class='fas fa-user-plus'></i> Add New User
                                </a>
                              </td></tr>";
                    } else {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td>
                                    <span class='status-badge " . ($row['status'] ? 'active' : 'inactive') . "'>
                                        " . ($row['status'] ? 'Active' : 'Inactive') . "
                                    </span>
                                  </td>";
                            echo "<td class='actions'>
                                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='btn btn-delete' 
                                       onclick=\"return confirm('Are you sure you want to delete this user?')\">
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
                    <h3><i class="fas fa-database"></i> CRUD Foundations</h3>
                    <p>Built the core CRUD (Create, Read, Update, Delete) flows for users, establishing a solid base to iterate on in Day 20.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-shield-alt"></i> Input Hygiene</h3>
                    <p>Validated and sanitized inputs and outputs to mitigate XSS, and prepared the codebase for moving to prepared statements.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-layer-group"></i> Structure & Navigation</h3>
                    <p>Split pages by responsibility (list, add, edit, delete) and introduced consistent navigation and feedback messages.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-seedling"></i> UX Baseline</h3>
                    <p>Set the baseline styling for tables, actions, and states, paving the way for Day 20’s refinements and search.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 19
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 15, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="../Day_18.php" class="nav-btn">← Day 18</a>
            <span class="day-counter">Day 19 of 25</span>
            <a href="../Day_20.php" class="nav-btn">Day 20 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 19/25 (76.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 76.00%"></div>
            </div>
            <div class="progress-percentage">76.00% Complete</div>
        </div>
    </div>
    
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>
