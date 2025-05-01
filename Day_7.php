<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 7 of PHP - Form Handling</title>
    <!-- Google Fonts integration for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* 
        * CSS Variables (Custom Properties)
        * Defining a color palette makes it easy to maintain consistent colors
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
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        /* Base styles for the entire page */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 30px;
            padding-top: 60px; /* Adjusted for fixed header */
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
        
        /* Page header styling */
        h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 2.2rem;
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
        
        /* Main container layout using CSS Grid */
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: 30px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            overflow: hidden;
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
        
        /* Form container styling */
        .form-container {
            padding: 20px;
            border-right: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        /* Form element styling */
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
        input[type="number"] {
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        /* Input focus state */
        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        /* Submit button styling */
        input[type="submit"] {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        
        /* Submit button hover state */
        input[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        /* Search input specific styling */
        input[name="txtSearch"] {
            margin-top: 10px;
            border-left: 3px solid var(--secondary);
        }
        
        /* Form data display area */
        .form-data {
            padding: 20px;
            background-color: var(--primary-light);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        /* Styling for the data display text */
        .form-data span {
            padding: 10px;
            margin-bottom: 10px;
            border-bottom: 1px dashed rgba(226, 232, 240, 0.8);
            font-size: 16px;
        }
        
        /* Highlight for data labels */
        .form-data span strong {
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        /* Empty data styling */
        .empty-data {
            color: var(--gray);
            font-style: italic;
        }
        
        /* Summary section at the bottom */
        .summary-section {
            grid-column: 1 / -1;
            margin-top: 30px;
            padding: 20px;
            background-color: var(--primary-light);
            border-radius: 8px;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }
        
        .summary-title {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.2rem;
            text-align: center;
        }
        
        .summary-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .summary-item {
            background-color: var(--white);
            padding: 15px;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
        }
        
        .summary-item h3 {
            margin-top: 0;
            color: var(--primary);
            font-size: 1rem;
        }
        
        /* Footer styling */
        .footer {
            text-align: center;
            margin-top: 40px;
            color: var(--gray);
            font-size: 0.9rem;
            max-width: 1000px;
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
        
        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .form-container {
                border-right: none;
                border-bottom: 1px solid rgba(226, 232, 240, 0.8);
                padding-bottom: 30px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
        <div class="day-indicator">Day 7 of PHP Learning Journey</div>
    
    <?php
    /*
     * DAY 7 LEARNING OBJECTIVES:
     * 
     * 1. Form Handling in PHP
     *    - Processing form submissions
     *    - Accessing form data through superglobals ($_GET, $_POST)
     * 
     * 2. PHP Superglobals
     *    - Understanding $_GET for query string parameters
     *    - How to check if form data exists with isset()
     * 
     * 3. Variable Initialization
     *    - Setting default values for variables
     *    - Preventing undefined variable errors
     * 
     * 4. Conditional Logic
     *    - Using if statements to check form submission
     *    - Processing data only when it's available
     * 
     * 5. PHP and HTML Integration
     *    - Embedding PHP variables in HTML
     *    - Using the shorthand echo tag <?= ?>
     */
    
    // Initialize variables with default empty values
    // This prevents undefined variable errors when the form hasn't been submitted yet
    $name = '';
    $address = '';
    $age = '';
    $phone = '';
    
    // Check if the form has been submitted by looking for the search parameter
    // isset() checks if a variable is set and is not NULL
    if(isset($_GET["txtSearch"])) {
        // If the form was submitted, retrieve the values from the $_GET superglobal
        // $_GET contains all parameters sent in the URL query string
        $searchQuery = $_GET["txtSearch"];
        $name = $_GET["name"];
        $address = $_GET["address"];
        $age = $_GET["age"];
        $phone = $_GET["phone"];
    }
    ?> 
    
    <h1>Form Handling in PHP</h1>
    
    <div class="container">
        <!-- Form Container -->
        <div class="form-container">
            <!-- 
            WHAT WE LEARNED:
            - The method="get" attribute makes form data appear in the URL
            - GET requests are visible in the browser address bar
            - No action attribute means the form submits to the same page
            -->
            <form method="get">
                <!-- Name field -->
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name">
                
                <!-- Address field -->
                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter your address">
                
                <!-- Age field -->
                <label for="age">Age</label>
                <input type="number" name="age" id="age" placeholder="Enter your age">
                
                <!-- Phone field -->
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone number">
                
                <!-- Search field -->
                <input type="text" placeholder="Type to search" name="txtSearch">
                
                <!-- Submit button -->
                <input type="submit" value="Submit Form">
            </form>
        </div>
        
        <!-- Data Display Area -->
        <div class="form-data">
            <!-- 
            WHAT WE LEARNED:
            - We can display PHP variables in HTML using <?= $variable ?>
            - This is a shorthand for <?php echo $variable; ?>
            - We can check if data exists and display appropriate messages
            -->
            <span>
                <strong>Name:</strong> 
                <?= !empty($name) ? $name : '<span class="empty-data">No name provided</span>' ?>
            </span>
            
            <span>
                <strong>Address:</strong> 
                <?= !empty($address) ? $address : '<span class="empty-data">No address provided</span>' ?>
            </span>
            
            <span>
                <strong>Age:</strong> 
                <?= !empty($age) ? $age : '<span class="empty-data">No age provided</span>' ?>
            </span>
            
            <span>
                <strong>Mobile Number:</strong> 
                <?= !empty($phone) ? $phone : '<span class="empty-data">No phone number provided</span>' ?>
            </span>
            
            <?php if(isset($_GET["txtSearch"])): ?>
            <span>
                <strong>Search Query:</strong> 
                <?= $searchQuery ?>
            </span>
            <?php endif; ?>
        </div>
        
        <!-- Summary Section -->
        <div class="summary-section">
            <h2 class="summary-title">What We Learned - Day 7</h2>
            <div class="summary-content">
                <div class="summary-item">
                    <h3>Form Handling</h3>
                    <p>We learned how to create and process HTML forms with PHP, accessing form data through the $_GET superglobal.</p>
                </div>
                <div class="summary-item">
                    <h3>Variable Initialization</h3>
                    <p>We initialized variables with default values to prevent undefined variable errors when the form hasn't been submitted.</p>
                </div>
                <div class="summary-item">
                    <h3>Conditional Logic</h3>
                    <p>We used isset() to check if form data exists before processing it, ensuring our code only runs when data is available.</p>
                </div>
                <div class="summary-item">
                    <h3>PHP in HTML</h3>
                    <p>We embedded PHP variables in HTML using the shorthand echo tag &lt;?= ?&gt; for cleaner, more readable code.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 7
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 1, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_6.php" class="nav-btn">← Day 6</a>
            <span class="day-counter">Day 7 of 25</span>
            <a href="Day_8.php" class="nav-btn">Day 8 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 7/25 (28.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 28.00%"></div>
            </div>
            <div class="progress-percentage">28.00% Complete</div>
        </div>
    </div>
    
    <!-- 
    SUMMARY OF TODAY'S LEARNING:
    
    1. Form Handling:
       We learned how to create and process HTML forms with PHP.
       
    2. GET Method:
       We used the GET method which adds form data to the URL as query parameters.
       
    3. Superglobals:
       We accessed form data using the $_GET superglobal array.
       
    4. Variable Initialization:
       We initialized variables with default values to prevent errors.
       
    5. Conditional Logic:
       We used isset() to check if form data exists before processing it.
       
    6. PHP in HTML:
       We embedded PHP variables in HTML using the shorthand syntax.
       
    7. Form Security:
       (Note: In a real application, we would need to validate and sanitize input)
       
    8. Dynamic Content:
       We displayed different content based on whether the form was submitted.
    -->
</body>
</html>
