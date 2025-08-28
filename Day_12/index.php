<?php
// Start with PHP code at the very top of the file - no whitespace before this
// Process form submission
if (isset($_POST['username'])) {
    $name = $_POST['username'];

    // Check if user cookie exists (returning user)
    if (isset($_COOKIE['user'])) {
        // Set status message to be displayed later
        $welcomeMessage = '<div class="message success">Welcome back! Redirecting to dashboard...</div>';

        // Use output buffering to prevent "headers already sent" error
        ob_start();
        // Redirect to dashboard page
        header("Location: redirect.php");
        ob_end_flush();
        exit;
    } else {
        // First-time visitor
        $welcomeMessage = '<div class="message warning">New user detected. Setting cookies...</div>';
        $welcomeMessage .= '<div class="message info">Username submitted: ' . htmlspecialchars($name) . '</div>';

        // Set username cookie (expires in 1 hour)
        setcookie("user", $name, time() + 3600);

        // Set timestamp cookie for tracking last visit
        $currenttime = date("Y-m-d H:i:s");
        $welcomeMessage .= '<div class="message info">Current time: ' . $currenttime . '</div>';
        setcookie("time", $currenttime, time() + 3600);
    }
} else {
    $welcomeMessage = ''; // No message if form not submitted
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 12 of PHP - Advanced Cookies</title>
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
            padding-top: 50px; /* Adjusted for fixed header */
            color: var(--dark);
            line-height: 1.6;
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
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .info {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Form container */
        .form-container {
            padding: 20px 0;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Label styling */
        label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark);
        }

        /* Input field styling */
        input[type="text"] {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        /* Input focus state */
        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        /* Submit button */
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
        }

        /* Button hover effect */
        input[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* Cookie info section */
        .cookie-info {
            margin-top: 30px;
            padding: 20px;
            background-color: var(--primary-light);
            border-radius: var(--border-radius);
        }

        .cookie-info h3 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 15px;
        }

        /* Learning section */
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

        /* Footer - Day 1 style */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--primary);
            max-width: 1000px;
            /* Adjusted for consistency */
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
        <div class="day-indicator">Day 12 of PHP Learning Journey</div>

    <h1>Advanced Cookie Management</h1>

    <?php echo $welcomeMessage; ?>

    <div class="container">
        <div class="form-container">
            <h2>User Login</h2>
            <p>Enter your username to continue. If you're a returning user, you'll be redirected to the dashboard.</p>

            <form method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username">
                <input type="submit" value="Submit">
            </form>
        </div>

        <div class="cookie-info">
            <h3>How This Works</h3>
            <p>When you submit your username:</p>
            <ol>
                <li>We check if a cookie named 'user' exists in your browser</li>
                <li>If it exists, you're recognized as a returning user and redirected to the dashboard</li>
                <li>If it doesn't exist, we set two cookies:
                    <ul>
                        <li>'user' - stores your username</li>
                        <li>'time' - stores the current timestamp of your visit</li>
                    </ul>
                </li>
                <li>Both cookies expire after 1 hour (3600 seconds)</li>
            </ol>
        </div>
    </div>

    <!-- Learning Section with Cards -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 12</h2>

        <div class="learning-grid">
            <div class="learning-card">
                <h3>Cookie-Based Authentication</h3>
                <p>We implemented a simple authentication system that recognizes returning users through cookies, providing a personalized experience without requiring database storage.</p>
            </div>

            <div class="learning-card">
                <h3>Multiple Cookies</h3>
                <p>We learned how to set and manage multiple cookies simultaneously, storing both user identification and timestamp information for different purposes.</p>
            </div>

            <div class="learning-card">
                <h3>Conditional Redirects</h3>
                <p>We implemented conditional page redirects based on cookie existence, creating different user flows for new and returning visitors.</p>
            </div>

            <div class="learning-card">
                <h3>Time-Based Cookies</h3>
                <p>We stored timestamp information in cookies to track when users last visited the site, allowing us to display this information on return visits.</p>
            </div>

            <div class="learning-card">
                <h3>Cookie Expiration</h3>
                <p>We set cookies with a specific expiration time (one hour from creation), demonstrating how to control cookie lifetime for security and user experience purposes.</p>
            </div>

            <div class="learning-card">
                <h3>User Recognition</h3>
                <p>We implemented a system that recognizes returning users without requiring them to re-enter information, enhancing the user experience through persistence.</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 12
        </div>

        <div class="footer-dates">
            <p>Created on: May 7, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>

        <div class="navigation">
            <a href="../Day_11.php" class="nav-btn">← Day 11</a>
            <span class="day-counter">Day 12 of 25</span>
            <a href="../Day_13.php" class="nav-btn">Day 13 →</a>
        </div>

        <div class="progress-section">
            <div class="progress-text">Journey Progress: 12/25 (48.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 48.00%"></div>
            </div>
            <div class="progress-percentage">48.00% Complete</div>
        </div>
    </div>
</body>

</html>