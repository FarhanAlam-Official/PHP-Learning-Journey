<?php
/**
 * Day 10 - Protected Dashboard Page
 * This script demonstrates a protected page that requires authentication
 * 
 * Learning Objectives:
 * 1. Session-based authentication
 * 2. Protected route implementation
 * 3. Logout functionality
 * 4. Security best practices
 */

// Continue the session from login page
session_start();

/**
 * AUTHENTICATION CHECK
 * Verify if user is logged in before allowing access
 * This is a crucial security measure for protected pages
 */
if (!isset($_SESSION['user'])) {
    header("Location: index.php");  // Redirect to login
    exit;
}

/**
 * SESSION SECURITY
 * Implement additional security measures for the session
 */
// Session hijacking prevention - regenerate ID periodically
if (!isset($_SESSION['last_regeneration']) || 
    (time() - $_SESSION['last_regeneration']) > 300) { // 5 minutes
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

// Calculate session duration
$sessionDuration = isset($_SESSION['login_time']) ? 
    time() - $_SESSION['login_time'] : 0;
$sessionMinutes = floor($sessionDuration / 60);
$sessionSeconds = $sessionDuration % 60;

/**
 * LOGOUT HANDLING
 * Process logout request when logout button is clicked
 * Demonstrates proper session destruction and redirect
 */
if (isset($_POST['logout'])) {
    // Clear all session variables
    $_SESSION = array();
    
    // Delete the session cookie if it exists
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();  // Remove all session data
    header("Location: index.php");  // Redirect to login
    exit;
}

// Get username from session for display
// Using session data to personalize user experience
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 10 - Dashboard</title>
    <?php include __DIR__ . '/../includes/head.php'; ?>
    <!-- Import Google Font for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /**
         * CSS Variables
         * Defining reusable values for consistent styling
         * These match our login page for design consistency
         */
        :root {
            --primary: #4f46e5;      /* Main theme color */
            --primary-dark: #4338ca; /* Darker shade for hover states */
            --primary-light: rgba(79, 70, 229, 0.1); /* Light shade for backgrounds */
            --secondary: #06b6d4;    /* Secondary accent color */
            --dark: #1e293b;         /* Text color */
            --light: #f8fafc;        /* Background color */
            --white: #ffffff;        /* Container background */
            --gray: #94a3b8;         /* Subtle text and borders */
            --success: #22c55e;      /* Success messages */
            --border-radius: 8px;    /* Consistent corner rounding */
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                         0 2px 4px -1px rgba(0, 0, 0, 0.06); /* Subtle elevation */
        }

        /* Base styles for body */
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 20px;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Container styling */
        .container {
            max-width: 800px;
            width: 100%;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-top: 40px;
        }

        /* User info section styling */
        .user-info {
            background-color: rgba(79, 70, 229, 0.05);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
        }

        .user-info h2 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 10px;
        }

        .user-info p {
            color: var(--dark);
            margin: 0;
            line-height: 1.6;
        }

        /* Session info styling */
        .session-info {
            background-color: rgba(6, 182, 212, 0.05);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
        }

        .session-info h3 {
            color: var(--secondary);
            margin-top: 0;
            margin-bottom: 10px;
        }

        .session-info p {
            margin: 5px 0;
        }

        .session-timer {
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--primary);
        }

        /* Logout form styling */
        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: var(--primary-dark);
        }

        /* Educational section styling */
        .education {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--gray);
        }

        .education h3 {
            color: var(--secondary);
        }

        .education ul {
            padding-left: 20px;
        }

        .education li {
            margin-bottom: 8px;
        }
        
        /* Learning section */
        .learning-section {
            margin-top: 40px;
            max-width: 800px;
            width: 100%;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .learning-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        
        .learning-title {
            color: var(--primary);
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.5rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
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
        
        /* Footer */
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
    <div class="container">
        <!-- User information display with welcome message -->
        <div class="user-info">
            <h2>Welcome back, <?= htmlspecialchars($username) ?>!</h2>
            <p>You are now logged in. Your session is active.</p>
        </div>

        <!-- Session information display -->
        <div class="session-info">
            <h3>Session Information</h3>
            <p>Login time: <?= date('Y-m-d H:i:s', $_SESSION['login_time'] ?? time()) ?></p>
            <p>Session duration: <span class="session-timer"><?= $sessionMinutes ?> minutes, <?= $sessionSeconds ?> seconds</span></p>
            <p>For security reasons, your session will automatically expire after inactivity.</p>
        </div>

        <!-- Logout form with styled button -->
        <form method="post">
            <input type="submit" name="logout" value="Logout">
        </form>

        <!-- Educational section about sessions -->
        <div class="education">
            <h3>What We've Learned About PHP Sessions</h3>
            <ul>
                <li><strong>Session Management:</strong> Using PHP's session functions to maintain user state across pages.</li>
                <li><strong>Authentication:</strong> Implementing login checks to protect sensitive pages.</li>
                <li><strong>Security:</strong> Properly handling session data and implementing logout functionality.</li>
                <li><strong>User Experience:</strong> Creating a personalized dashboard based on session data.</li>
                <li><strong>Session Regeneration:</strong> Periodically regenerating session IDs to prevent session fixation attacks.</li>
            </ul>
        </div>
    </div>

    <!-- Learning Section with Cards -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 10</h2>

        <div class="learning-grid">
            <div class="learning-card">
                <h3>Protected Routes</h3>
                <p>We implemented a protected dashboard that checks for an active session before allowing access, redirecting unauthenticated users to the login page.</p>
            </div>

            <div class="learning-card">
                <h3>Session Security</h3>
                <p>We enhanced security by implementing session ID regeneration to prevent session fixation attacks and properly destroying sessions during logout.</p>
            </div>

            <div class="learning-card">
                <h3>Session Data Usage</h3>
                <p>We used session data to personalize the user experience, displaying the username and tracking session duration since login.</p>
            </div>

            <div class="learning-card">
                <h3>Proper Logout</h3>
                <p>We implemented a secure logout process that clears session variables, destroys the session, and removes session cookies for complete session termination.</p>
            </div>

            <div class="learning-card">
                <h3>Real-time Updates</h3>
                <p>We used JavaScript to update the session timer in real-time without requiring page refreshes, enhancing the user experience.</p>
            </div>

            <div class="learning-card">
                <h3>Cookie Management</h3>
                <p>We learned how to properly handle session cookies, including setting expiration times and security parameters like httponly flags.</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 10
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 5, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="index.php" class="nav-btn">← Login</a>
            <span class="day-counter">Day 10 of 22</span>
            <a href="../Day_11.php" class="nav-btn">Day 11 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 10/22 (45.5%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 45.5%"></div>
            </div>
            <div class="progress-percentage">45.5% Complete</div>
        </div>
    </div>

    <script>
        // Simple script to update the session timer without page refresh
        // Initialize the timer variables once, outside the interval function.
        let minutes = <?= $sessionMinutes ?>;
        let seconds = <?= $sessionSeconds ?>;

        setInterval(function() {
            // Increment seconds
            seconds++;

            // Handle minute rollover
            if (seconds >= 60) {
                minutes++;
                seconds = 0;
            }

            // Update the display
            document.querySelector('.session-timer').textContent =
                minutes + ' minutes, ' + seconds + ' seconds';
        }, 1000);
    </script>
</body>
</html>