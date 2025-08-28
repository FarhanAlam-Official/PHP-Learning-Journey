<?php 
    // Include database connection file
    include "db.php";
    $conn = db(); // Get the database connection object
    
    // Initialize variables
    $query_status = "";
    
    // Check if the form is submitted and all fields are present
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        // Sanitize user inputs
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate inputs
        $errors = [];
        
        // Username validation
        if(empty($username)) {
            $errors[] = "Username is required";
        } elseif(strlen($username) < 3) {
            $errors[] = "Username must be at least 3 characters";
        }
        
        // Email validation
        if(empty($email)) {
            $errors[] = "Email is required";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        // Password validation
        if(empty($password)) {
            $errors[] = "Password is required";
        } elseif(strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters";
        }
        
        // Check if passwords match
        if($password !== $confirm_password) {
            $errors[] = "Passwords do not match";
        }
        
        // If there are errors, display them
        if(!empty($errors)) {
            $query_status = "<div class='error'>";
            foreach($errors as $error) {
                $query_status .= "<p>$error</p>";
            }
            $query_status .= "</div>";
        } else {
            // Hash password for security
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            // This is insecure practice it is more vulnerable
            // $query = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
            // $result = $conn->query($query);

            //This is more secured 
            $stmt=$conn->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            $result = $stmt->execute();
            
            // Check if the query was successful
            if(!$result) {
                $query_status = "<div class='error'><p>Registration failed: " . $conn->error . "</p></div>";
            } else {
                $query_status = "<div class='success'><p>Registration successful! You can now log in.</p></div>";
            }
            
            // Close the statement
            $stmt->close();
        }
    }
    
    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 18 - Secure User Registration</title>
    <?php include __DIR__ . '/includes/head.php'; ?>
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
            line-height: 1.6;
            margin: 0;
            padding: 0;
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
            text-align: center;
            margin-bottom: 40px;
        }

        h1 {
            color: var(--primary);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto 60px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark);
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .password-field {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray);
        }

        input[type="submit"] {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition);
            margin-top: 10px;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.2);
        }

        .success, .error {
            padding: 15px;
            margin-bottom: 25px;
            border-radius: var(--border-radius);
            font-weight: 500;
        }

        .success {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }

        .error p, .success p {
            margin: 5px 0;
        }

        /* Learning Cards Section */
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
    <div class="day-indicator">Day 18 of PHP Learning Journey</div>
    
    <div class="container">
        <div class="page-header">
            <h1>Secure User Registration</h1>
            <p class="subtitle">Learn how to implement a secure user registration system with PHP and MySQL</p>
        </div>
        
        <div class="form-container">
            <?php if(!empty($query_status)) { echo $query_status; } ?>
            
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                        <i class="toggle-password fas fa-eye"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
                        <i class="toggle-password fas fa-eye"></i>
                    </div>
                </div>
                
                <input type="submit" value="Register Account">
            </form>
        </div>
        
        <!-- Learning Section with Cards -->
        <div class="learning-section">
            <h2 class="learning-title">What We Learned - Day 18</h2>
            
            <div class="learning-grid">
                <div class="learning-card">
                    <h3><i class="fas fa-shield-alt"></i> Secure Password Handling</h3>
                    <p>We implemented secure password hashing using PHP's built-in password_hash() function with the PASSWORD_DEFAULT algorithm. This ensures that user passwords are never stored in plain text and are protected against various attacks.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-database"></i> Prepared Statements</h3>
                    <p>We used prepared statements with parameterized queries to protect against SQL injection attacks. This separates SQL logic from the data being inserted, making it impossible for malicious users to inject harmful SQL code.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-check-circle"></i> Input Validation</h3>
                    <p>We implemented comprehensive input validation to ensure that user data meets our requirements before processing. This includes checking for empty fields, validating email format, and ensuring password strength and match.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-exclamation-triangle"></i> Error Handling</h3>
                    <p>We added proper error handling to provide clear feedback to users when something goes wrong. This improves user experience by guiding them to correct their inputs and understand system responses.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-paint-brush"></i> Enhanced UI/UX</h3>
                    <p>We created a clean, responsive user interface with visual feedback for form interactions. The design includes focus states, error messages, and success notifications to guide users through the registration process.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-code"></i> Code Organization</h3>
                    <p>We structured our code with clear separation between PHP logic, HTML markup, and CSS styling. This makes the code more maintainable and easier to understand for future development.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 18
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 14, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_17.php" class="nav-btn">← Day 17</a>
            <span class="day-counter">Day 18 of 25</span>
            <a href="Day_19/index.php" class="nav-btn">Day 19 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 18/25 (72.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 72.00%"></div>
            </div>
            <div class="progress-percentage">72.00% Complete</div>
        </div>
    </div>
    
    <!-- JavaScript for password visibility toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const toggleButtons = document.querySelectorAll('.toggle-password');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const passwordField = this.previousElementSibling;
                    
                    // Toggle password visibility
                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        passwordField.type = 'password';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
</body>
</html>
