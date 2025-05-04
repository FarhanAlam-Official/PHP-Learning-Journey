<?php
// Start the session at the very beginning of the file
// before ANY output (including HTML, whitespace, etc.)
session_start();

// Initialize variables
$username = "";
$password = "";
$loginMessage = "";
$messageClass = "";

// Check if logout was requested
if (isset($_GET['logout'])) {
    // Destroy the session
    $_SESSION = array(); // Clear all session variables
    
    // Destroy the session
    session_destroy();
    
    $loginMessage = "You have been successfully logged out.";
    $messageClass = "info";
}

// Check if form was submitted
if (isset($_POST['username'])) {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate credentials (in a real app, this would check a database)
    if ($username == "FarhanAlam" && $password == "password") {
        // Store username in session
        $_SESSION["username"] = $username;
        
        $loginMessage = "Login successful!";
        $messageClass = "success";
    } else {
        $loginMessage = "Incorrect username or password. Please try again.";
        $messageClass = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 9 of PHP - Sessions & Login System</title>
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
            --error: #ef4444;
            --success: #22c55e;
            --info: #3b82f6;
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
            max-width: 500px;
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
        
        .error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .info {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            border: 1px solid rgba(79, 70, 229, 0.2);
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
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        /* Input field styling */
        input[type="text"],
        input[type="password"] {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        /* Input focus state */
        input[type="text"]:focus,
        input[type="password"]:focus {
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
        
        /* Logout button */
        .logout-btn {
            display: inline-block;
            background-color: var(--gray);
            color: var(--white);
            border: none;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            text-align: center;
            margin-top: 15px;
            transition: background-color 0.3s;
        }
        
        .logout-btn:hover {
            background-color: var(--dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.3);
        }
        
        /* User info section */
        .user-info {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(79, 70, 229, 0.05);
            border-radius: var(--border-radius);
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
        
        /* Responsive design */
        @media (max-width: 640px) {
            .container {
                padding: 20px;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            input[type="text"],
            input[type="password"] {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
        <div class="day-indicator">Day 9 of PHP Learning Journey</div>
    
    <h1>PHP Sessions & Login System</h1>
    
    <div class="container">
        <?php if (!empty($loginMessage)): ?>
            <div class="message <?= $messageClass ?>">
                <?= $loginMessage ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['username'])): ?>
            <!-- User is logged in -->
            <div class="user-info">
                <h2>Welcome back, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
                <p>You are now logged in. Your session is active.</p>
                
                <!-- 
                WHAT WE LEARNED:
                - Sessions persist data across page requests
                - We can check if a user is logged in by checking session variables
                - We can display personalized content for logged-in users
                -->
                
                <a href="?logout=1" class="logout-btn">Logout</a>
            </div>
        <?php else: ?>
            <!-- User is not logged in, show login form -->
            <div class="form-container">
                <!-- 
                WHAT WE LEARNED:
                - Forms can submit to the same page (empty action attribute)
                - POST method keeps credentials out of the URL
                - We can validate credentials and set session variables
                -->
                <form action="" method="post">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>" placeholder="Enter username">
                    
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password">
                    
                    <input type="submit" value="Login">
                </form>
                
                <p style="text-align: center; margin-top: 15px; font-size: 0.9rem; color: var(--gray);">
                    Use username: <strong>FarhanAlam</strong> and password: <strong>password</strong>
                </p>
            </div>
        <?php endif; ?>
        
        <div style="margin-top: 30px; border-top: 1px solid var(--gray); padding-top: 20px;">
            <h3>What are PHP Sessions?</h3>
            <p>
                Sessions allow you to store user information on the server for later use across multiple pages.
                Unlike cookies that store data on the client's computer, sessions store data on the server and
                use a session ID (usually stored in a cookie) to identify the user.
            </p>
            
            <h4>Key Session Functions:</h4>
            <ul>
                <li><code>session_start()</code> - Starts a new session or resumes an existing one</li>
                <li><code>$_SESSION</code> - Superglobal array that stores session variables</li>
                <li><code>session_unset()</code> - Frees all session variables</li>
                <li><code>session_destroy()</code> - Destroys all data registered to a session</li>
            </ul>
        </div>
    </div>
    
    <!-- Learning Section with Cards -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 9</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>PHP Sessions</h3>
                <p>We learned how to use sessions to maintain state between different page requests. Sessions allow us to store user data on the server, making it accessible across multiple pages without having to pass it in the URL or through forms.</p>
            </div>
            
            <div class="learning-card">
                <h3>Session Management</h3>
                <p>We learned how to start a session with session_start(), store data in the $_SESSION superglobal, and destroy sessions when users log out using session_destroy().</p>
            </div>
            
            <div class="learning-card">
                <h3>Authentication</h3>
                <p>We implemented a basic login system that validates user credentials and stores the username in a session variable to keep the user logged in across page requests.</p>
            </div>
            
            <div class="learning-card">
                <h3>Conditional Rendering</h3>
                <p>We used PHP conditionals to display different content based on whether the user is logged in or not, creating a dynamic user experience tailored to the user's state.</p>
            </div>
            
            <div class="learning-card">
                <h3>Security Considerations</h3>
                <p>We learned about using POST for login forms to keep credentials out of the URL, and using htmlspecialchars() to prevent XSS attacks when displaying user data.</p>
            </div>
            
            <div class="learning-card">
                <h3>User Experience</h3>
                <p>We implemented feedback messages to inform users about login success or failure, and added a logout feature to end the session, providing a complete user flow.</p>
            </div>
            
            <div class="learning-card">
                <h3>Superglobals</h3>
                <p>We worked with the $_SESSION, $_POST, and $_GET superglobals to manage data across different contexts in our application, from form submissions to session storage.</p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 9
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 4, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_8.php" class="nav-btn">← Day 8</a>
            <span class="day-counter">Day 9 of 25</span>
            <a href="Day_10/index.php" class="nav-btn">Day 10 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 9/25 (36.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 36.00%"></div>
            </div>
            <div class="progress-percentage">36.00% Complete</div>
        </div>
    </div>
    
    <!-- 
    SUMMARY OF TODAY'S LEARNING:
    
    1. PHP Sessions:
       We learned how to use sessions to maintain state between different page requests.
       Sessions allow us to store user data on the server, making it accessible across
       multiple pages without having to pass it in the URL or through forms.
       
    2. Session Management:
       We learned how to start a session with session_start(), store data in the $_SESSION
       superglobal, and destroy sessions when users log out.
       
    3. Authentication:
       We implemented a basic login system that validates user credentials and stores
       the username in a session variable to keep the user logged in.
       
    4. Conditional Rendering:
       We used PHP conditionals to display different content based on whether the user
       is logged in or not, creating a dynamic user experience.
       
    5. Security Considerations:
       We learned about using POST for login forms to keep credentials out of the URL,
       and using htmlspecialchars() to prevent XSS attacks when displaying user data.
       
    6. User Experience:
       We implemented feedback messages to inform users about login success or failure,
       and added a logout feature to end the session.
       
    7. Superglobals:
       We worked with the $_SESSION, $_POST, and $_GET superglobals to manage data
       across different contexts in our application.
    -->
</body>
</html>
