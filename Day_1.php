<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Day of PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --dark: #1e293b;
            --light: #f8fafc;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            padding: 20px;
            padding-top: 40px; /* Adjusted for fixed header */
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        .card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .card-header {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .code-output {
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: var(--border-radius);
            font-family: monospace;
            margin: 15px 0;
            white-space: pre-wrap;
        }
        
        .code-explanation {
            background-color: rgba(14, 165, 233, 0.1);
            padding: 15px;
            border-radius: var(--border-radius);
            margin: 15px 0;
            font-size: 0.9rem;
        }
        
        .code-explanation h4 {
            color: var(--secondary);
            margin-bottom: 10px;
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

        .nav-btn:disabled,
        .nav-btn.disabled {
            background-color: #94a3b8;
            cursor: not-allowed;
            transform: none;
            pointer-events: none;
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
        
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .navigation {
                gap: 10px;
            }
            
            .nav-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Day Indicator -->
    <div class="day-indicator">Day 1 of PHP Learning Journey</div>
    
    <h1 class="page-header">Basics of PHP</h1>

    <div class="container">
        <!-- Basic PHP Syntax Section -->
        <div class="card">
            <h2 class="card-header">Basic PHP Syntax</h2>
            
            <div class="code-output">
                <?php
                // Variables and echo statements
                $msg = "Hey I am Farhan Alam";
                $response = "Hey, there I am Istaq Alam";
                
                echo "$msg <br>";
                echo "$response <br>";
                
                // String concatenation
                echo "<br>Using concatenation: " . $msg . " and " . $response . "<br>";
                
                // Variable types
                $name = "Farhan";  // String
                $age = 25;       // Integer
                $height = 5.9;   // Float
                $isStudent = true; // Boolean
                
                echo "<br>Different variable types:<br>";
                echo "Name (string): $name<br>";
                echo "Age (integer): $age<br>";
                echo "Height (float): $height<br>";
                echo "Is Student (boolean): " . ($isStudent ? 'true' : 'false') . "<br>";
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>What We Learned</h4>
                <ul>
                    <li>PHP code is enclosed within <code>&lt;?php</code> and <code>?&gt;</code> tags</li>
                    <li>Variables in PHP start with a $ symbol</li>
                    <li>Echo is used to output content to the browser</li>
                    <li>PHP supports different data types: strings, integers, floats, booleans</li>
                    <li>String concatenation is done using the dot (.) operator</li>
                </ul>
            </div>
        </div>
        
        <!-- Simple Interest Calculator -->
        <div class="card">
            <h2 class="card-header">Simple Interest Calculator</h2>
            
            <div class="code-output">
                <?php
                // Simple Interest Calculator
                echo "Simple Interest Calculator<br>";
                
                // Initialize variables
                $principal = 10000;
                $rate = 25;
                $time = 5;
                
                // Calculate simple interest
                $simpleInterest = ($principal * $rate * $time) / 100;
                
                // Display input values
                echo "<br>Principal: $principal<br>";
                echo "Rate: $rate%<br>";
                echo "Time: $time years<br>";
                
                // Display result
                echo "<br>Simple Interest: $simpleInterest";
                
                // Calculate total amount
                $totalAmount = $principal + $simpleInterest;
                echo "<br>Total Amount: $totalAmount";
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>How It Works</h4>
                <p>The simple interest formula is:</p>
                <p><strong>Simple Interest = (Principal × Rate × Time) / 100</strong></p>
                <p>In this example:</p>
                <ul>
                    <li>We set the principal amount to 10000</li>
                    <li>The interest rate is 25%</li>
                    <li>The time period is 5 years</li>
                    <li>The calculation gives us the interest earned</li>
                    <li>We also calculate the total amount (principal + interest)</li>
                </ul>
            </div>
        </div>
        
        <!-- Date and Time Functions -->
        <div class="card">
            <h2 class="card-header">Date and Time Functions</h2>
            
            <div class="code-output">
                <?php
                // Current date and time
                echo "Current Date and Time:<br>";
                echo "Date: " . date("Y-m-d") . "<br>";
                echo "Time: " . date("h:i:s A") . "<br>";
                echo "Day of Week: " . date("l") . "<br>";
                echo "Month: " . date("F") . "<br>";
                
                // Timestamp
                echo "<br>Current Timestamp: " . time() . "<br>";
                
                // Date calculations
                $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("Y"));
                echo "Tomorrow's Date: " . date("Y-m-d", $tomorrow) . "<br>";
                
                // Days in current month
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
                echo "Days in Current Month: " . $daysInMonth . "<br>";
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Date and Time Functions</h4>
                <ul>
                    <li><code>date()</code> - Formats a timestamp according to the specified format</li>
                    <li><code>time()</code> - Returns the current Unix timestamp</li>
                    <li><code>mktime()</code> - Creates a Unix timestamp for a specific date</li>
                    <li><code>cal_days_in_month()</code> - Returns the number of days in a month</li>
                </ul>
                <p>Date format characters:</p>
                <ul>
                    <li><code>Y</code> - Four-digit year (e.g., 2023)</li>
                    <li><code>m</code> - Month with leading zeros (01-12)</li>
                    <li><code>d</code> - Day with leading zeros (01-31)</li>
                    <li><code>l</code> - Full day name (e.g., Monday)</li>
                    <li><code>F</code> - Full month name (e.g., January)</li>
                    <li><code>h</code> - 12-hour format with leading zeros (01-12)</li>
                    <li><code>i</code> - Minutes with leading zeros (00-59)</li>
                    <li><code>s</code> - Seconds with leading zeros (00-59)</li>
                    <li><code>A</code> - AM or PM</li>
                </ul>
            </div>
        </div>
        
        <!-- Math Functions -->
        <div class="card">
            <h2 class="card-header">Math Functions</h2>
            
            <div class="code-output">
                <?php
                // Basic math operations
                echo "Basic Math Operations:<br>";
                $a = 10;
                $b = 3;
                
                echo "$a + $b = " . ($a + $b) . "<br>";
                echo "$a - $b = " . ($a - $b) . "<br>";
                echo "$a * $b = " . ($a * $b) . "<br>";
                echo "$a / $b = " . ($a / $b) . "<br>";
                echo "$a % $b = " . ($a % $b) . " (remainder)<br>";
                echo "$a ** $b = " . ($a ** $b) . " (exponentiation)<br>";
                
                // Math functions
                echo "<br>Math Functions:<br>";
                echo "Square root of 16: " . sqrt(16) . "<br>";
                echo "Round 3.7: " . round(3.7) . "<br>";
                echo "Ceiling 4.3: " . ceil(4.3) . "<br>";
                echo "Floor 4.8: " . floor(4.8) . "<br>";
                echo "Random number (1-100): " . rand(1, 100) . "<br>";
                echo "Absolute value of -42: " . abs(-42) . "<br>";
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Math Operations and Functions</h4>
                <p>PHP supports all standard mathematical operations:</p>
                <ul>
                    <li>Addition (+), Subtraction (-), Multiplication (*), Division (/)</li>
                    <li>Modulus (%) - Returns the remainder of a division</li>
                    <li>Exponentiation (**) - Raises a number to a power</li>
                </ul>
                <p>Common math functions:</p>
                <ul>
                    <li><code>sqrt()</code> - Square root</li>
                    <li><code>round()</code> - Rounds a number to the nearest integer</li>
                    <li><code>ceil()</code> - Rounds up to the nearest integer</li>
                    <li><code>floor()</code> - Rounds down to the nearest integer</li>
                    <li><code>rand()</code> - Generates a random number</li>
                    <li><code>abs()</code> - Returns the absolute value</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- HTML Output Section -->
    <div class="container">
        <div class="card">
            <h2 class="card-header">Displaying PHP Values in HTML</h2>
            
            <h3>Simple Interest Calculation Results</h3>
            <div class="code-output">
                <p>Principal: <?= $principal ?></p>
                <p>Rate: <?= $rate ?>%</p>
                <p>Time: <?= $time ?> years</p>
                <p>Simple Interest: <?= $simpleInterest ?></p>
                <p>Total Amount: <?= $totalAmount ?></p>
            </div>
            
            <div class="code-explanation">
                <h4>PHP Short Echo Tag</h4>
                <p>The <code>&lt;?= $variable ?&gt;</code> syntax is a shorthand for <code>&lt;?php echo $variable; ?&gt;</code></p>
                <p>This is useful for quickly outputting PHP variables within HTML content.</p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 1
        </div>
        
        <div class="footer-dates">
            <p>Created on: April 24, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <span class="nav-btn disabled">← Previous</span>
            <span class="day-counter">Day 1 of 25</span>
            <a href="Day_2.php" class="nav-btn">Day 2 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 1/25 (4.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 4.00%"></div>
            </div>
            <div class="progress-percentage">4.00% Complete</div>
        </div>
    </div>
</body>
</html>