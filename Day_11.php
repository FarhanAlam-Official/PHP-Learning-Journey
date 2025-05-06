<?php
/**
 * Day 11 - PHP Cookies
 * 
 * This script demonstrates how to work with cookies in PHP:
 * - Setting cookies with various parameters
 * - Reading cookie values
 * - Updating cookie values
 * - Deleting cookies
 * - Tracking user visits
 * 
 * Cookie syntax:
 * setcookie(name, value, expire, path, domain, secure, httponly)
 */

// Initialize variables
$username = "Guest";
$visitCount = 1;
$isReturningUser = false;
$cookieMessage = "";

// Check if user cookie exists (returning user)
if (isset($_COOKIE['user'])) {
    $username = $_COOKIE['user'];
    $isReturningUser = true;
    
    // Update visit counter if it exists
    if (isset($_COOKIE['count'])) {
        // Get the current count from cookie
        $visitCount = (int)$_COOKIE['count'];
        
        // Increment for the next visit (cookie will be updated)
        $nextVisit = $visitCount + 1;
        
        // Update the counter cookie with new value for next visit
        // Parameters: name, value, expiration (1 hour from now)
        setcookie('count', $nextVisit, time() + 3600);
    }
    
    $cookieMessage = "Welcome back, $username! This is visit #$visitCount.";
} else {
    // First-time visitor - set initial cookies
    // Parameters: name, value, expiration (1 hour from now)
    setcookie('user', 'Farhan Alam', time() + 3600);
    setcookie('count', $visitCount, time() + 3600);
    
    $cookieMessage = "Welcome to our site! This is your first visit.";
}

// Handle cookie deletion if reset button is clicked
if (isset($_POST['reset_cookies'])) {
    // Delete cookies by setting expiration time in the past
    setcookie('user', '', time() - 3600);
    setcookie('count', '', time() - 3600);
    
    // Redirect to refresh the page and show the "first visit" experience
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 11 of PHP - Cookies</title>
    <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* CSS Variables for consistent theming */
        :root {
            --primary: #6366f1;      /* Main theme color */
            --primary-dark: #4f46e5; /* Darker shade for hover states */
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
        
        /* Base styles */
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
            font-family: 'Outfit', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 20px;
            padding-top: 50px; /* Adjusted for fixed header */
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
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
        
        /* Main container */
        .container {
            max-width: 1200px;
            width: 100%;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 40px;
        }
        
        /* Welcome message */
        .welcome-message {
            background-color: rgba(99, 102, 241, 0.1);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .welcome-message h2 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        /* Cookie info section */
        .cookie-info {
            background-color: rgba(6, 182, 212, 0.05);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
        }
        
        .cookie-info h3 {
            color: var(--secondary);
            margin-top: 0;
            margin-bottom: 15px;
        }
        
        /* Cookie table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--gray);
        }
        
        th {
            background-color: rgba(99, 102, 241, 0.05);
            font-weight: 500;
            color: var(--primary);
        }
        
        /* Form container */
        .form-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        /* Button styling */
        button, .button {
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
        
        button:hover, .button:hover {
            background-color: var(--primary-dark);
        }
        
        /* Reset button */
        .reset-button {
            background-color: var(--gray);
        }
        
        .reset-button:hover {
            background-color: var(--dark);
        }
        
        /* Code block styling */
        .code-block {
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: var(--border-radius);
            font-family: monospace;
            overflow-x: auto;
            margin-bottom: 20px;
        }
        
        /* Educational section */
        .education {
            margin-top: 30px;
        }
        
        .education h3 {
            color: var(--secondary);
            border-bottom: 1px solid var(--gray);
            padding-bottom: 10px;
        }

        /* Note about cookie behavior */
        .cookie-note {
            background-color: rgba(34, 197, 94, 0.1);
            padding: 15px;
            border-radius: var(--border-radius);
            margin-top: 20px;
            font-size: 0.9rem;
        }
        
        .cookie-note h4 {
            color: var(--success);
            margin-top: 0;
            margin-bottom: 10px;
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
        <div class="day-indicator">Day 11 of PHP Learning Journey </div>
    
    <h1>PHP Cookie Management and Tracking</h1>
    <p class="subtitle">Learn how to create, read, update, and delete cookies in PHP</p>
    
    <div class="container">
        <!-- Welcome message based on cookie status -->
        <div class="welcome-message">
            <h2><?= $isReturningUser ? "Welcome Back!" : "Hello, New Visitor!" ?></h2>
            <p><?= $cookieMessage ?></p>
        </div>
        
        <!-- Current cookie information -->
        <div class="cookie-info">
            <h3>Your Current Cookies</h3>
            <table>
                <thead>
                    <tr>
                        <th>Cookie Name</th>
                        <th>Value</th>
                        <th>Expires</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>user</td>
                        <td><?= isset($_COOKIE['user']) ? htmlspecialchars($_COOKIE['user']) : 'Not set' ?></td>
                        <td>1 hour from creation</td>
                    </tr>
                    <tr>
                        <td>count</td>
                        <td><?= isset($_COOKIE['count']) ? htmlspecialchars($_COOKIE['count']) : 'Not set' ?></td>
                        <td>1 hour from last update</td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Note about cookie behavior -->
            <div class="cookie-note">
                <h4>How Cookie Updates Work</h4>
                <p>
                    When you refresh the page, you'll see the current visit count. The cookie has already been 
                    set to increment for your next visit, but that new value won't be visible in the $_COOKIE array 
                    until your next page load.
                </p>
            </div>
            
            <!-- Form to reset cookies -->
            <div class="form-container">
                <form method="post">
                    <button type="submit" name="reset_cookies" class="reset-button">Reset Cookies</button>
                </form>
            </div>
        </div>
        
        <!-- Educational content about cookies -->
        <div class="education">
            <h3>Understanding PHP Cookies</h3>
            <p>
                Cookies are small pieces of data stored on the client's computer. They are used to remember 
                information about the user across browsing sessions.
            </p>
            
            <h4>Setting a Cookie</h4>
            <div class="code-block">
                setcookie(name, value, expire, path, domain, secure, httponly);
            </div>
            
            <ul>
                <li><strong>name:</strong> The name of the cookie</li>
                <li><strong>value:</strong> The value of the cookie</li>
                <li><strong>expire:</strong> When the cookie expires (in Unix timestamp)</li>
                <li><strong>path:</strong> The path on the server where the cookie will be available</li>
                <li><strong>domain:</strong> The domain where the cookie is available</li>
                <li><strong>secure:</strong> If TRUE, cookie will only be sent over secure connections</li>
                <li><strong>httponly:</strong> If TRUE, cookie will be accessible only through HTTP protocol</li>
            </ul>
            
            <h4>Reading a Cookie</h4>
            <div class="code-block">
                $value = $_COOKIE['cookie_name'];
            </div>
            
            <h4>Deleting a Cookie</h4>
            <div class="code-block">
                setcookie('cookie_name', '', time() - 3600);
            </div>
            
            <h4>Common Cookie Use Cases</h4>
            <ul>
                <li>Remembering user preferences</li>
                <li>Tracking user behavior</li>
                <li>Implementing "remember me" functionality</li>
                <li>Shopping carts for e-commerce sites</li>
                <li>Personalization based on previous visits</li>
            </ul>
            
            <h4>Cookie Security Best Practices</h4>
            <ul>
                <li>Use the HttpOnly flag to prevent JavaScript access</li>
                <li>Use the Secure flag to ensure cookies are only sent over HTTPS</li>
                <li>Set appropriate expiration times</li>
                <li>Don't store sensitive information in cookies</li>
                <li>Consider using SameSite attribute to prevent CSRF attacks</li>
            </ul>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 11
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 6, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_10.php" class="nav-btn">← Day 10</a>
            <span class="day-counter">Day 11 of 25</span>
            <a href="Day_12.php" class="nav-btn">Day 12 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 11/25 (44.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 44.00%"></div>
            </div>
            <div class="progress-percentage">44.00% Complete</div>
        </div>
    </div>
</body>
</html>
