<?php
/**
 * Day 10 - PHP Login System
 * This script demonstrates a secure login system using PHP sessions
 * 
 * Learning Objectives:
 * 1. Understanding session management in PHP
 * 2. Form handling and validation
 * 3. Security best practices
 * 4. User authentication flow
 */

// Initialize session - Required for maintaining user state across pages
session_start();

// Initialize variables for form handling and messages
$username = "";        // Stores user input for username field
$password = "";        // Stores user input for password field
$loginMessage = "";    // Stores feedback messages (success/error)
$messageClass = "";    // CSS class for styling messages

/**
 * SESSION MANAGEMENT
 * Check if user is already logged in to prevent redundant logins
 * $_SESSION['user'] contains the username if user is authenticated
 */
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");  // Redirect to dashboard
    exit;  // Terminate script execution
}

/**
 * FORM HANDLING
 * Process login form submission
 * $_SERVER["REQUEST_METHOD"] checks if form was submitted via POST
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = trim(htmlspecialchars($_POST['username']));  // Get submitted username
    $password = $_POST['password'];  // Get submitted password
    
    // Basic validation - Check if fields are empty
    if (empty($username) || empty($password)) {
        $loginMessage = "Both username and password are required.";
        $messageClass = "error";
    } else {
        /**
         * AUTHENTICATION LOGIC
         * Compare credentials against known values
         * Note: In real applications, always use:
         * - Password hashing (e.g., password_hash() and password_verify())
         * - Secure database storage
         * - Protection against SQL injection
         */
        if ($username == "Farhan" && $password == "password") {
            // Successful login
            $_SESSION['user'] = $username;  // Set session variable
            $_SESSION['login_time'] = time();  // Record login time
            
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            // Failed login
            $loginMessage = "Incorrect username or password. Please try again.";
            $messageClass = "error";  // CSS class for error styling
            
            // For security, you might want to log failed login attempts
            // logFailedLogin($username, $_SERVER['REMOTE_ADDR']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 10 - PHP Login System</title>
    <!-- Import Google Font for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
    /* CSS Variables for consistent theming */
    :root {
        --primary: #4f46e5;
        /* Main theme color */
        --primary-dark: #4338ca;
        /* Darker shade for hover states */
        --primary-light: rgba(79, 70, 229, 0.1);
        /* Light shade for backgrounds */
        --secondary: #06b6d4;
        /* Secondary accent color */
        --dark: #1e293b;
        /* Text color */
        --light: #f8fafc;
        /* Background color */
        --white: #ffffff;
        /* Container background */
        --gray: #94a3b8;
        /* Subtle text and borders */
        --error: #ef4444;
        /* Error messages */
        --success: #22c55e;
        /* Success messages */
        --border-radius: 8px;
        /* Consistent corner rounding */
        --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06);
        /* Subtle elevation */
    }

    /* Add Day Indicator styles */
    .day-indicator {
        background-color: var(--primary-dark);
        color: var(--white);
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
        font-family: 'Outfit', sans-serif;
        background-color: var(--light);
        margin: 0;
        padding: 20px;
        color: var(--dark);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 40px; /* Adjusted for fixed header */
    }

    h1 {
        color: var(--primary);
        text-align: center;
        margin-bottom: 30px;
    }

    .container {
        max-width: 400px;
        width: 100%;
        background-color: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 30px;
    }

    .message {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: var(--border-radius);
        text-align: center;
        font-weight: 500;
    }

    .error {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--error);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-weight: 500;
        color: var(--dark);
    }

    input[type="text"],
    input[type="password"] {
        padding: 12px 15px;
        border: 1px solid var(--gray);
        border-radius: var(--border-radius);
        font-size: 16px;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }

    input[type="submit"] {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-weight: 500;
        font-size: 16px;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    input[type="submit"]:hover {
        background-color: var(--primary-dark);
    }

    .helper-text {
        text-align: center;
        margin-top: 15px;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .security-note {
        margin-top: 30px;
        padding: 15px;
        background-color: rgba(6, 182, 212, 0.1);
        border-radius: var(--border-radius);
        font-size: 0.9rem;
    }

    .security-note h3 {
        margin-top: 0;
        color: var(--secondary);
    }

    .security-note ul {
        margin-bottom: 0;
        padding-left: 20px;
    }

    /* Learning section styles */
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
    /* Footer (Day 1 style) */
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

    .progress-section { margin-top: 20px; }
    .progress-text { color: var(--dark); font-weight: 500; margin-bottom: 10px; }
    .progress-bar { width: 100%; max-width: 400px; height: 12px; background-color: #e2e8f0; border-radius: 6px; margin: 0 auto; overflow: hidden; }
    .progress-fill { height: 100%; background: linear-gradient(90deg, var(--primary), var(--secondary)); border-radius: 6px; transition: width 0.5s ease; }
    .progress-percentage { color: var(--primary); font-weight: 600; margin-top: 8px; font-size: 0.9rem; }
    </style>
</head>

<body>
        <div class="day-indicator">Day 10 of PHP Learning Journey</div>

    <h1>Login System</h1>

    <div class="container">
        <!-- Display error/success messages if they exist -->
        <?php if (!empty($loginMessage)): ?>
        <div class="message <?= $messageClass ?>">
            <?= $loginMessage ?>
        </div>
        <?php endif; ?>

        <!-- Login form with security measures -->
        <form method="post" autocomplete="off">
            <!-- Username field with XSS prevention -->
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>"
                placeholder="Enter username" required>

            <!-- Password field -->
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>

            <input type="submit" value="Login">
        </form>

        <!-- Helper text for demo credentials -->
        <p class="helper-text">
            Use username: <strong>Farhan</strong> and password: <strong>password</strong>
        </p>

        <!-- Educational section about security -->
        <div class="security-note">
            <h3>Security Best Practices</h3>
            <ul>
                <li>Always use HTTPS for login forms</li>
                <li>Hash passwords with password_hash()</li>
                <li>Implement rate limiting for failed attempts</li>
                <li>Use prepared statements for database queries</li>
                <li>Set secure and HttpOnly flags on session cookies</li>
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
            <a href="../Day_9.php" class="nav-btn">← Day 9</a>
            <span class="day-counter">Day 10 of 25</span>
            <a href="../Day_11.php" class="nav-btn">Day 11 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 10/25 (40.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 40.00%"></div>
            </div>
            <div class="progress-percentage">40.00% Complete</div>
        </div>
    </div>
</body>
</html>