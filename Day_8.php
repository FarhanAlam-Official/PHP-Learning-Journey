<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 8 of PHP - POST Method & Form Processing</title>
    <?php include __DIR__ . '/includes/head.php'; ?>
    <!-- Google Fonts integration -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* 
        * CSS Variables for consistent theming
        */
        :root {
            --primary: #4f46e5;
            --primary-light: rgba(79, 70, 229, 0.1);
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --dark: #1e293b;
            --light: #f8fafc;
            --white: #ffffff;
            --gray: #94a3b8;
            --error: #ef4444;
            --success: #22c55e;
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
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
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
        
        /* Form container */
        .form-container {
            padding-bottom: 20px;
            border-bottom: 1px solid var(--light);
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
        input[type="number"] {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        /* Input focus state */
        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
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
            margin-top: 10px;
        }
        
        /* Button hover effect */
        input[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        /* Result container */
        .result-container {
            background-color: var(--primary-light);
            padding: 20px;
            border-radius: var(--border-radius);
            text-align: center;
        }
        
        /* Result text */
        .result {
            font-size: 18px;
            font-weight: 500;
            color: var(--primary-dark);
        }
        
        /* Error message */
        .error-message {
            color: var(--error);
            font-weight: 500;
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: rgba(239, 68, 68, 0.1);
            border-radius: var(--border-radius);
        }
        
        /* Success message */
        .success-message {
            color: var(--success);
            font-weight: 500;
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: rgba(34, 197, 94, 0.1);
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
            color: var(--gray);
            font-size: 0.9rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

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
            
            input[type="number"] {
                padding: 10px;
            }
            
            .learning-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
        <div class="day-indicator">Day 8 of PHP Learning Journey</div>
    
    <?php
    /*
     * DAY 8 LEARNING OBJECTIVES:
     * 
     * 1. POST Method in Forms
     *    - Understanding the difference between GET and POST
     *    - Using POST for form submissions
     *    - Accessing form data with $_POST superglobal
     * 
     * 2. Form Data Validation
     *    - Checking if form fields are empty
     *    - Displaying error messages
     *    - Preventing calculations with invalid data
     * 
     * 3. Type Casting in PHP
     *    - Converting strings to integers with (int)
     *    - Why type casting is important for calculations
     * 
     * 4. Conditional Logic
     *    - Using isset() to check if form was submitted
     *    - Using logical operators for validation
     * 
     * 5. PHP Output in HTML
     *    - Displaying dynamic results
     *    - Using the shorthand echo tag <?= ?>
     */
    
    // Initialize variables
    $sum = "";
    $errorMessage = "";
    $successMessage = "";
    
    // Check if the form has been submitted
    // isset() checks if a variable exists and is not NULL
    if(isset($_POST['submit'])) {
        // Retrieve form data from the $_POST superglobal
        // The $_POST array contains all data sent with the POST method
        $num1 = $_POST['firstNumber'];
        $num2 = $_POST['secondNumber'];
        
        // Validate form data
        // The ! operator negates the result, so !$num1 means "if $num1 is empty"
        if (!$num1 || !$num2) {
            // Display error message if fields are empty
            $errorMessage = "Both fields are required";
        } else {
            // Process valid data
            // (int) casts the values to integers to ensure proper addition
            $sum = (int)$num1 + (int)$num2;
            $successMessage = "Calculation completed successfully!";
        }
    }
    ?>
    
    <h1>PHP Calculator with POST Method</h1>
    
    <?php if($errorMessage): ?>
        <div class="error-message"><?= $errorMessage ?></div>
    <?php endif; ?>
    
    <?php if($successMessage): ?>
        <div class="success-message"><?= $successMessage ?></div>
    <?php endif; ?>
    
    <div class="container">
        <!-- Form Container -->
        <div class="form-container">
            <!-- 
            WHAT WE LEARNED:
            - method="post" sends data in the HTTP request body (not visible in URL)
            - POST is more secure than GET for sensitive data
            - POST has no size limitations unlike GET
            - No action attribute means the form submits to the same page
            -->
            <form method="post">
                <!-- First Number Input -->
                <label for="firstNumber">First Number</label>
                <input type="number" name="firstNumber" id="firstNumber" 
                       value="<?= isset($_POST['firstNumber']) ? htmlspecialchars($_POST['firstNumber']) : '' ?>" 
                       placeholder="Enter first number">
                
                <!-- Second Number Input -->
                <label for="secondNumber">Second Number</label>
                <input type="number" name="secondNumber" id="secondNumber" 
                       value="<?= isset($_POST['secondNumber']) ? htmlspecialchars($_POST['secondNumber']) : '' ?>" 
                       placeholder="Enter second number">
                
                <!-- Submit Button -->
                <input type="submit" name="submit" value="Calculate">
            </form>
        </div>
        
        <!-- Result Container -->
        <div class="result-container">
            <span class="result">
                <!-- 
                WHAT WE LEARNED:
                - We can display dynamic PHP values directly in HTML
                - We only show the result if it exists
                -->
                Sum: <?= $sum !== "" ? $sum : "Waiting for input..." ?>
            </span>
        </div>
    </div>
    
    <!-- Learning Section with Cards -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 8</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>POST Method</h3>
                <p>We learned how to use the POST method for form submissions, which is more secure than GET because the data is not visible in the URL. POST requests send data in the HTTP request body and have no size limitations.</p>
            </div>
            
            <div class="learning-card">
                <h3>Form Processing</h3>
                <p>We processed form data using the $_POST superglobal array, which contains all data submitted through a POST request. This allows us to access form field values by their name attributes.</p>
            </div>
            
            <div class="learning-card">
                <h3>Data Validation</h3>
                <p>We implemented basic validation to check if form fields are empty before performing calculations. This prevents errors and ensures that our application only processes valid input.</p>
            </div>
            
            <div class="learning-card">
                <h3>Type Casting</h3>
                <p>We used (int) to convert string input values to integers for mathematical operations. This ensures that values are treated as numbers rather than strings when performing calculations.</p>
            </div>
            
            <div class="learning-card">
                <h3>Conditional Logic</h3>
                <p>We used isset() to check if the form was submitted and conditional statements to validate input and display appropriate messages based on the validation results.</p>
            </div>
            
            <div class="learning-card">
                <h3>Error Handling</h3>
                <p>We displayed error messages when validation failed and success messages when operations completed successfully, providing feedback to the user about the status of their submission.</p>
            </div>
            
            <div class="learning-card">
                <h3>PHP in HTML</h3>
                <p>We used PHP to dynamically generate HTML content and display calculated results. The shorthand echo tag <?php echo '<?= ?>'; ?> makes it easy to embed PHP values directly in HTML.</p>
            </div>
            
            <div class="learning-card">
                <h3>Form State Persistence</h3>
                <p>We maintained form values after submission to improve user experience, allowing users to see their previous inputs and make adjustments without having to re-enter all data.</p>
            </div>
            
            <div class="learning-card">
                <h3>Security Considerations</h3>
                <p>We used htmlspecialchars() to prevent XSS attacks when displaying user input, ensuring that any HTML or script tags in user input are rendered as text rather than being executed.</p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 8
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 2, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_7.php" class="nav-btn">← Day 7</a>
            <span class="day-counter">Day 8 of 25</span>
            <a href="Day_9.php" class="nav-btn">Day 9 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 8/25 (32.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 32.00%"></div>
            </div>
            <div class="progress-percentage">32.00% Complete</div>
        </div>
    </div>
    
    <!-- 
    SUMMARY OF TODAY'S LEARNING:
    
    1. POST Method:
       We learned how to use the POST method for form submissions, which is more
       secure than GET because the data is not visible in the URL.
       
    2. Form Processing:
       We processed form data using the $_POST superglobal array, which contains
       all data submitted through a POST request.
       
    3. Data Validation:
       We implemented basic validation to check if form fields are empty before
       performing calculations.
       
    4. Type Casting:
       We used (int) to convert string input values to integers for mathematical
       operations.
       
    5. Conditional Logic:
       We used isset() to check if the form was submitted and conditional statements
       to validate input and display appropriate messages.
       
    6. Error Handling:
       We displayed error messages when validation failed and success messages when
       operations completed successfully.
       
    7. PHP in HTML:
       We used PHP to dynamically generate HTML content and display calculated results.
       
    8. Form State Persistence:
       We maintained form values after submission to improve user experience.
       
    9. Security Considerations:
       We used htmlspecialchars() to prevent XSS attacks when displaying user input.
    -->
</body>
</html>
