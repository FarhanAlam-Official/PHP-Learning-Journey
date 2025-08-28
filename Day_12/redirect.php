<?php
// Check if logout button was clicked
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Unset cookies by setting expiration time to the past
    setcookie('user', '', time() - 3600); // Set expiration to 1 hour ago
    setcookie('time', '', time() - 3600); // Set expiration to 1 hour ago
    
    // Redirect back to Day_12.php
    header("Location: index.php?logout=success");
    exit;
}

// Check if user is logged in (cookie exists)
if (!isset($_COOKIE['user'])) {
    // If not logged in, redirect to login page
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 12 - User Dashboard</title>
    <?php include __DIR__ . '/../includes/head.php'; ?>
    <!-- Google Fonts integration -->
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
        
        /* Base styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 20px;
            color: var(--dark);
            line-height: 1.6;
        }
        
        /* Day indicator at the top of the page */
        .day-indicator {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: var(--primary);
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        /* Page title */
        h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }
        
        /* Decorative underline for the heading */
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
        
        /* Main container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        /* Top accent bar */
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        
        /* User info section */
        .user-info {
            background-color: var(--primary-light);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
        }
        
        .user-info h2 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        .user-info p {
            margin: 10px 0;
            font-size: 1rem;
            color: var(--gray);
        }
        
        .user-info .last-visit {
            font-weight: 600;
            color: var(--success);
        }
        
        /* User actions section */
        .user-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .user-actions a {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary);
            color: var(--white);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: background-color 0.3s;
        }
        
        .user-actions a:hover {
            background-color: var(--primary-dark);
        }
        
        .user-actions .logout {
            background-color: var(--error);
        }
        
        .user-actions .logout:hover {
            background-color: var(--error);
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
            color: var(--gray);
            font-size: 0.9rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>

<body>
    <div class="day-indicator">Day 12</div>
    <div class="container">
        <h1>User Dashboard</h1>
        <div class="user-info">
            <h2>Welcome! <?php echo htmlspecialchars($_COOKIE['user']); ?></h2>
            <p>Your last visit: <?php echo htmlspecialchars($_COOKIE['time']); ?></p>
        </div>
        <div class="user-actions">
            <a href="index.php">Refresh</a>
            <a href="redirect.php?logout=true" class="logout">Logout</a>
        </div>
    </div>
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 12</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>User Dashboard Design</h3>
                <p>We created a clean, modern dashboard interface that displays personalized user information retrieved from cookies.</p>
            </div>
            
            <div class="learning-card">
                <h3>Cookie Data Retrieval</h3>
                <p>We learned how to access and display cookie values using the $_COOKIE superglobal array to personalize the user experience.</p>
            </div>
            
            <div class="learning-card">
                <h3>User Session Management</h3>
                <p>We implemented a simple session management system using cookies to track user identity and visit timestamps.</p>
            </div>
            
            <div class="learning-card">
                <h3>Responsive Dashboard Layout</h3>
                <p>We designed a responsive dashboard that adapts to different screen sizes while maintaining a consistent visual hierarchy.</p>
            </div>
            
            <div class="learning-card">
                <h3>User Actions Interface</h3>
                <p>We created an intuitive action interface with refresh and logout options, demonstrating how to implement basic navigation in a user dashboard.</p>
            </div>
            
            <div class="learning-card">
                <h3>CSS Variables for Theming</h3>
                <p>We used CSS custom properties to create a consistent color scheme and styling across the application, making future theme changes easier.</p>
            </div>
        </div>
    </div>
    
    <!-- Footer with dynamic date -->
    <div class="footer">
        <p>PHP Learning Journey - Day 12: Advanced Cookie Management</p>
        <p>Created on: <?= date("F j, Y") ?></p>
    </div>
</body>

</html>
