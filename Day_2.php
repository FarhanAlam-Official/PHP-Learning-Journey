<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 2 PHP - Control Structures</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
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
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary);
            padding-bottom: 10px;
            margin-top: 20px;
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
            background-color: #4338ca;
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
        
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        
        .product-item {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 15px;
            width: calc(50% - 10px);
            margin-bottom: 20px;
        }
        
        .product-item h4 {
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .product-description {
            background-color: #f8fafc;
            padding: 10px;
            border-radius: var(--border-radius);
        }
        
        .product-price {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .product-item {
                width: 100%;
            }
        }
        /* Day Indicator styles */
        .day-indicator {
            background-color: var(--primary);
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
    </style>
</head>

<body>
    <!-- Day Indicator -->
    <div class="day-indicator">Day 2 of PHP Learning Journey</div>

    <h1 class="page-header">PHP Control Structures</h1>

    <div class="container">
        <!-- Switch Statement Section -->
        <div class="card">
            <h2 class="card-header">Switch Statement</h2>
            
            <div class="code-output">
                <?php
                $day = 5;
                echo "The value of \$day is: $day<br><br>";
                echo "Day of the week: ";
                
                switch ($day) {
                    case 1:
                        echo "Sunday";
                        break;
                    case 2:
                        echo "Monday";
                        break;
                    case 3:
                        echo "Tuesday";
                        break;
                    case 4:
                        echo "Wednesday";
                        break;
                    case 5:
                        echo "Thursday";
                        break;
                    case 6:
                        echo "Friday";
                        break;
                    case 7:
                        echo "Saturday";
                        break;
                    default:
                        echo "Invalid Input";
                }
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Switch Statement Explained</h4>
                <p>The switch statement is used to perform different actions based on different conditions.</p>
                <ul>
                    <li>It evaluates an expression once and compares it with multiple possible case values</li>
                    <li>The <code>break</code> statement prevents the code from running into the next case</li>
                    <li>The <code>default</code> statement is used when no case matches the expression</li>
                    <li>Switch is often more readable than multiple if-else statements when comparing a single variable against many values</li>
                </ul>
            </div>
        </div>
        
        <!-- For Loop Section -->
        <div class="card">
            <h2 class="card-header">For Loop</h2>
            
            <div class="code-output">
                <?php
                echo "Basic For Loop:<br>";
                for ($i = 0; $i < 5; $i++) {
                    echo "Iteration #" . ($i + 1) . ": Hello BCA <br/>";
                }
                
                echo "<br>For Loop with Conditions:<br>";
                for ($i = 1; $i <= 10; $i++) {
                    // Skip even numbers
                    if ($i % 2 == 0) {
                        continue;
                    }
                    echo "Odd number: $i<br>";
                    
                    // Stop after reaching 7
                    if ($i >= 7) {
                        echo "Reached 7, breaking the loop<br>";
                        break;
                    }
                }
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>For Loop Explained</h4>
                <p>The for loop is used when you know in advance how many times you want to execute a block of code.</p>
                <p>For loop syntax: <code>for (initialization; condition; increment) { code to be executed }</code></p>
                <ul>
                    <li><strong>Initialization:</strong> Sets a variable before the loop starts (e.g., $i = 0)</li>
                    <li><strong>Condition:</strong> Defines the condition for the loop to run (e.g., $i < 5)</li>
                    <li><strong>Increment:</strong> Increases a value each time the code block is executed (e.g., $i++)</li>
                    <li>The <code>continue</code> statement skips the current iteration</li>
                    <li>The <code>break</code> statement exits the loop completely</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Product Display Section -->
    <div class="container">
        <div class="card" style="grid-column: span 2;">
            <h2 class="card-header">PHP in HTML: Product Display</h2>
            
            <div class="code-explanation">
                <h4>Using PHP within HTML</h4>
                <p>This example demonstrates how to use PHP loops to generate HTML content dynamically.</p>
                <p>We're using a for loop to create multiple product cards without repeating HTML code.</p>
            </div>
            
            <div class="product-container">
                <?php for ($i = 0; $i < 4; $i++) { ?>
                <div class="product-item">
                    <h4>Demo Product <?= $i + 1 ?></h4>
                    <div class="product-description">
                        <p class="product-price">Price: ₹<?= 70000 + ($i * 5000) ?></p>
                        <p>This is demo product #<?= $i + 1 ?>. It demonstrates using PHP variables inside HTML.</p>
                    </div>
                </div>
                <?php } ?>
            </div>
            
            <div class="code-output" style="margin-top: 20px;">
                <pre>
&lt;div class="product-container"&gt;
    &lt;?php for ($i = 0; $i < 4; $i++) { ?&gt;
    &lt;div class="product-item"&gt;
        &lt;h4&gt;Demo Product &lt;?= $i + 1 ?&gt;&lt;/h4&gt;
        &lt;div class="product-description"&gt;
            &lt;p class="product-price"&gt;Price: ₹&lt;?= 70000 + ($i * 5000) ?&gt;&lt;/p&gt;
            &lt;p&gt;This is demo product #&lt;?= $i + 1 ?&gt;.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;?php } ?&gt;
&lt;/div&gt;
                </pre>
            </div>
        </div>
    </div>
    
    <!-- Additional Control Structures -->
    <div class="container">
        <!-- While Loop Section -->
        <div class="card">
            <h2 class="card-header">While Loop</h2>
            
            <div class="code-output">
                <?php
                echo "While Loop Example:<br>";
                $counter = 1;
                
                while ($counter <= 5) {
                    echo "Counter value: $counter<br>";
                    $counter++;
                }
                
                echo "<br>Do-While Loop Example:<br>";
                $counter = 1;
                
                do {
                    echo "Counter value: $counter<br>";
                    $counter++;
                } while ($counter <= 5);
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>While and Do-While Loops</h4>
                <p><strong>While Loop:</strong> Executes a block of code as long as the specified condition is true.</p>
                <p><strong>Do-While Loop:</strong> Similar to while loop, but it will execute the code block at least once, even if the condition is false.</p>
                <p>Use while loops when you don't know exactly how many times the loop should run.</p>
            </div>
        </div>
        
        <!-- If-Else Section -->
        <div class="card">
            <h2 class="card-header">If-Else Statements</h2>
            
            <div class="code-output">
                <?php
                echo "If-Else Examples:<br><br>";
                
                $score = 85;
                echo "Score: $score<br>";
                
                if ($score >= 90) {
                    echo "Grade: A (Excellent)<br>";
                } elseif ($score >= 80) {
                    echo "Grade: B (Good)<br>";
                } elseif ($score >= 70) {
                    echo "Grade: C (Average)<br>";
                } elseif ($score >= 60) {
                    echo "Grade: D (Below Average)<br>";
                } else {
                    echo "Grade: F (Fail)<br>";
                }
                
                // Ternary operator example
                $age = 20;
                echo "<br>Age: $age<br>";
                $status = ($age >= 18) ? "Adult" : "Minor";
                echo "Status: $status<br>";
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Conditional Statements</h4>
                <p><strong>If Statement:</strong> Executes code if a condition is true.</p>
                <p><strong>If-Else Statement:</strong> Executes one block of code if a condition is true and another if it's false.</p>
                <p><strong>If-Elseif-Else Statement:</strong> Tests multiple conditions and executes different code blocks accordingly.</p>
                <p><strong>Ternary Operator:</strong> A shorthand for if-else, syntax: <code>condition ? value_if_true : value_if_false</code></p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 2
        </div>
        
        <div class="footer-dates">
            <p>Created on: April 25, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_1.php" class="nav-btn">← Day 1</a>
            <span class="day-counter">Day 2 of 25</span>
            <a href="Day_3.php" class="nav-btn">Day 3 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 2/25 (8.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 8.00%"></div>
            </div>
            <div class="progress-percentage">8.00% Complete</div>
        </div>
    </div>
</body>

</html>
