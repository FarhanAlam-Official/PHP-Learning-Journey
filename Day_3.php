<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 3 of PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <?php include __DIR__ . '/includes/head.php'; ?>
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
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 20px;
            color: var(--primary);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
            
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .card-header {
            font-size: 1.4rem;
            color: var(--primary);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .card-subheader {
            font-size: 1.2rem;
            color: var(--secondary);
            margin: 20px 0 10px 0;
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
        
        .array-visual {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 15px 0;
        }
        
        .array-item {
            background-color: var(--primary);
            color: white;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
        }
        
        .array-item-assoc {
            background-color: var(--secondary);
            color: white;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
        }
        
        .array-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 15px 0;
        }
        
        @media (max-width: 768px) {
            .array-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--primary);
            max-width: 1200px;
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
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
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
            color: var(--light);
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
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Day Indicator -->
    <div class="day-indicator">Day 3 of PHP Learning Journey</div>
    <h1 class="page-header">Arrays in PHP</h1>

    <div class="container">
        <div class="card">
            <h2 class="card-header">Introduction to Arrays in PHP</h2>
            
            <div class="code-explanation">
                <h4>What is an Array?</h4>
                <p>An array is a special variable that can hold multiple values under a single name. In PHP, arrays can store values of different types, and the keys can be either numeric or string.</p>
                <p>PHP supports three types of arrays:</p>
                <ul>
                    <li><strong>Indexed Arrays</strong> - Arrays with numeric keys</li>
                    <li><strong>Associative Arrays</strong> - Arrays with named keys</li>
                    <li><strong>Multidimensional Arrays</strong> - Arrays containing one or more arrays</li>
                </ul>
            </div>
            
            <h3 class="card-subheader">1. Indexed Arrays</h3>
            
            <div class="code-output">
                <?php
                // Defining an indexed array
                $cities = ["Bharatpur", "Narayanghat", "Kamalnagar", "Gaindakot"];
                
                echo "Cities Array Contents:<br>";
                for ($i = 0; $i < count($cities); $i++) { 
                    echo "City no: " . $i . " " . $cities[$i] . "<br>";
                }
                
                // Alternative way to create an indexed array
                $fruits = array("Apple", "Banana", "Orange", "Mango");
                
                echo "<br>Fruits Array using foreach loop:<br>";
                foreach ($fruits as $index => $fruit) {
                    echo "Index: $index, Fruit: $fruit<br>";
                }
                
                // Array functions
                echo "<br>Array Functions:<br>";
                echo "Number of elements in fruits array: " . count($fruits) . "<br>";
                echo "First element: " . $fruits[0] . "<br>";
                echo "Last element: " . $fruits[count($fruits) - 1] . "<br>";
                
                // Adding elements
                $fruits[] = "Strawberry"; // Add to the end
                array_push($fruits, "Grapes"); // Also adds to the end
                array_unshift($fruits, "Pineapple"); // Add to the beginning
                
                echo "<br>After adding elements:<br>";
                print_r($fruits);
                ?>
            </div>
            
            <div class="array-visual">
                <?php
                foreach ($cities as $city) {
                    echo "<div class='array-item'>$city</div>";
                }
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Indexed Arrays Explained</h4>
                <p>Indexed arrays use numeric keys that start from 0 by default.</p>
                <ul>
                    <li>You can create arrays using the array() function or the short array syntax []</li>
                    <li>Access elements using square brackets and the index number: $array[0]</li>
                    <li>Add elements by assigning a value to a new index or using array_push()</li>
                    <li>Use count() to get the number of elements in an array</li>
                    <li>Use foreach or for loops to iterate through array elements</li>
                </ul>
            </div>
            
            <h3 class="card-subheader">2. Associative Arrays</h3>
            
            <div class="code-output">
                <?php
                // Defining an associative array
                $student = [
                    "name" => "Farhan Alam",
                    "age" => 21,
                    "Mobile no" => "9807225586"
                ];
                
                echo "Student Information:<br>";
                echo "Name: " . $student["name"] . "<br>";
                echo "Age: " . $student["age"] . "<br>";
                echo "Mobile: " . $student["Mobile no"] . "<br>";
                
                // Alternative way to create an associative array
                $product = array(
                    "id" => "P001",
                    "name" => "Laptop",
                    "price" => 75000,
                    "in_stock" => true
                );
                
                echo "<br>Product Information using foreach:<br>";
                foreach ($product as $key => $value) {
                    echo ucfirst($key) . ": " . $value . "<br>";
                }
                
                // Adding and modifying elements
                $student["course"] = "BCA"; // Add new key-value pair
                $student["age"] = 22; // Modify existing value
                
                echo "<br>Updated Student Information:<br>";
                var_dump($student);
                echo "<br>";
                print_r($student);
                ?>
            </div>
            
            <div class="array-visual">
                <?php
                foreach ($student as $key => $value) {
                    echo "<div class='array-item-assoc'>$key: $value</div>";
                }
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Associative Arrays Explained</h4>
                <p>Associative arrays use named keys instead of numeric indexes.</p>
                <ul>
                    <li>Keys are strings that you define (e.g., "name", "age")</li>
                    <li>Access elements using square brackets and the key name: $array["key"]</li>
                    <li>Useful for storing related data with descriptive keys</li>
                    <li>Use foreach loops to iterate through associative arrays</li>
                    <li>var_dump() and print_r() are useful for debugging array contents</li>
                </ul>
            </div>
            
            <h3 class="card-subheader">3. Multidimensional Arrays</h3>
            
            <div class="code-output">
                <?php
                // Defining a multidimensional indexed array
                $array = array(
                    array(1, 2, 3, 4, 5),
                    array(6, 7, 8, 9, 10),
                    array(11, 12, 13, 14, 15)
                );
                
                echo "Accessing specific elements:<br>";
                echo "Element at [2][3]: " . $array[2][3] . "<br>";
                
                // Alternative syntax
                $array2 = [
                    [0, 1, 2, 3],
                    [4, 5, 6, 7],
                    [8, 9, 10, 11]
                ];
                
                echo "Element at [2][3]: " . $array2[2][3] . "<br>";
                
                // Multidimensional associative array
                $student_record = [
                    "Farhan" => [
                        "name" => "Farhan Alam",
                        "age" => 22,
                        "mobile" => "9807225586"
                    ],
                    "Regina" => [
                        "name" => "Regina Gharti Magar",
                        "age" => 88,
                        "mobile" => "9807225586"
                    ]
                ];
                
                echo "<br>Student Records:<br>";
                echo "Farhan's age: " . $student_record["Farhan"]["age"] . "<br>";
                echo "Regina's name: " . $student_record["Regina"]["name"] . "<br>";
                
                // Iterating through multidimensional arrays
                echo "<br>All Student Records:<br>";
                foreach ($student_record as $key => $info) {
                    echo "Student ID: $key<br>";
                    foreach ($info as $field => $value) {
                        echo "- $field: $value<br>";
                    }
                    echo "<br>";
                }
                ?>
            </div>
            
            <div class="array-grid">
                <?php
                foreach ($array as $row) {
                    foreach ($row as $value) {
                        echo "<div class='array-item'>$value</div>";
                    }
                }
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Multidimensional Arrays Explained</h4>
                <p>Multidimensional arrays are arrays containing one or more arrays. They are useful for representing complex data structures like tables or nested information.</p>
                <ul>
                    <li>Access elements using multiple square brackets: $array[0][1]</li>
                    <li>Can mix indexed and associative arrays</li>
                    <li>Useful for organizing hierarchical data</li>
                    <li>Use nested loops to iterate through all elements</li>
                    <li>Can have any number of dimensions, but 2-3 levels are most common</li>
                </ul>
            </div>
        </div>
        
        <div class="card">
            <h2 class="card-header">Common Array Functions in PHP</h2>
            
            <div class="code-output">
                <?php
                $numbers = [5, 3, 8, 1, 9, 4];
                
                echo "Original array: ";
                print_r($numbers);
                echo "<br>";
                
                // Sorting
                sort($numbers); // Sort in ascending order
                echo "After sort(): ";
                print_r($numbers);
                echo "<br>";
                
                rsort($numbers); // Sort in descending order
                echo "After rsort(): ";
                print_r($numbers);
                echo "<br>";
                
                // Array operations
                $numbers = [5, 3, 8, 1, 9, 4];
                echo "Sum of all values: " . array_sum($numbers) . "<br>";
                echo "Maximum value: " . max($numbers) . "<br>";
                echo "Minimum value: " . min($numbers) . "<br>";
                
                // Checking if element exists
                echo "Does 8 exist in the array? " . (in_array(8, $numbers) ? "Yes" : "No") . "<br>";
                echo "Does 7 exist in the array? " . (in_array(7, $numbers) ? "Yes" : "No") . "<br>";
                
                // Finding index of an element
                echo "Index of value 8: " . array_search(8, $numbers) . "<br>";
                
                // Merging arrays
                $array1 = ["red", "green"];
                $array2 = ["blue", "yellow"];
                $colors = array_merge($array1, $array2);
                echo "Merged arrays: ";
                print_r($colors);
                echo "<br>";
                
                // Removing elements
                $fruits = ["apple", "banana", "orange", "grape"];
                array_pop($fruits); // Remove last element
                echo "After array_pop(): ";
                print_r($fruits);
                echo "<br>";
                
                array_shift($fruits); // Remove first element
                echo "After array_shift(): ";
                print_r($fruits);
                echo "<br>";
                
                // Slicing arrays
                $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                $slice = array_slice($numbers, 3, 4); // Start at index 3, take 4 elements
                echo "Slice of numbers array: ";
                print_r($slice);
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>Useful Array Functions</h4>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <tr style="background-color: #e2e8f0;">
                        <th style="padding: 8px; text-align: left; border: 1px solid #cbd5e1;">Function</th>
                        <th style="padding: 8px; text-align: left; border: 1px solid #cbd5e1;">Description</th>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">count()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Returns the number of elements in an array</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">sort(), rsort()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Sort arrays in ascending or descending order</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">asort(), arsort()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Sort associative arrays by value</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">ksort(), krsort()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Sort associative arrays by key</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">array_push(), array_pop()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Add/remove elements from the end of an array</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">array_unshift(), array_shift()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Add/remove elements from the beginning of an array</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">array_merge()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Merge two or more arrays</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">array_slice()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Extract a portion of an array</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">in_array()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Check if a value exists in an array</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">array_search()</td>
                        <td style="padding: 8px; border: 1px solid #cbd5e1;">Search for a value and return its key</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card">
            <h2 class="card-header">Practical Example: Student Grade Tracker</h2>
            
            <div class="code-output">
                <?php
                // Student grades multidimensional array
                $students = [
                    "S001" => [
                        "name" => "Farhan Alam",
                        "grades" => [85, 92, 78, 88, 95]
                    ],
                    "S002" => [
                        "name" => "Regina Magar",
                        "grades" => [75, 82, 90, 85, 88]
                    ],
                    "S003" => [
                        "name" => "Anil Kumar",
                        "grades" => [92, 95, 89, 78, 85]
                    ]
                ];
                
                // Function to calculate average grade
                function calculateAverage($grades) {
                    return array_sum($grades) / count($grades);
                }
                
                // Display student grades and averages
                echo "<h3>Student Grade Report</h3>";
                
                foreach ($students as $id => $student) {
                    $average = calculateAverage($student["grades"]);
                    $maxGrade = max($student["grades"]);
                    $minGrade = min($student["grades"]);
                    
                    echo "<strong>Student ID:</strong> $id<br>";
                    echo "<strong>Name:</strong> " . $student["name"] . "<br>";
                    echo "<strong>Grades:</strong> " . implode(", ", $student["grades"]) . "<br>";
                    echo "<strong>Average:</strong> " . number_format($average, 2) . "<br>";
                    echo "<strong>Highest Grade:</strong> $maxGrade<br>";
                    echo "<strong>Lowest Grade:</strong> $minGrade<br>";
                    
                    // Determine letter grade
                    if ($average >= 90) {
                        echo "<strong>Letter Grade:</strong> A (Excellent)<br>";
                    } elseif ($average >= 80) {
                        echo "<strong>Letter Grade:</strong> B (Good)<br>";
                    } elseif ($average >= 70) {
                        echo "<strong>Letter Grade:</strong> C (Average)<br>";
                    } elseif ($average >= 60) {
                        echo "<strong>Letter Grade:</strong> D (Below Average)<br>";
                    } else {
                        echo "<strong>Letter Grade:</strong> F (Fail)<br>";
                    }
                    
                    echo "<hr>";
                }
                
                // Find the student with the highest average
                $highestAvg = 0;
                $topStudent = "";
                
                foreach ($students as $id => $student) {
                    $avg = calculateAverage($student["grades"]);
                    if ($avg > $highestAvg) {
                        $highestAvg = $avg;
                        $topStudent = $student["name"];
                    }
                }
                
                echo "<br><strong>Top Student:</strong> $topStudent with average " . number_format($highestAvg, 2);
                ?>
            </div>
            
            <div class="code-explanation">
                <h4>What This Example Demonstrates</h4>
                <ul>
                    <li>Creating and using multidimensional associative arrays to store complex data</li>
                    <li>Iterating through nested arrays with foreach loops</li>
                    <li>Using array functions like array_sum(), max(), min(), and implode()</li>
                    <li>Calculating statistics from array data</li>
                    <li>Combining arrays with conditional logic</li>
                    <li>Creating a simple function to process array data</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 3
        </div>
        
        <div class="footer-dates">
            <p>Created on: April 27, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_2.php" class="nav-btn">← Day 2</a>
            <span class="day-counter">Day 3 of 25</span>
            <a href="Day_4.php" class="nav-btn">Day 4 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 3/25 (12.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 12.00%"></div>
            </div>
            <div class="progress-percentage">12.00% Complete</div>
        </div>
    </div>
</body>

</html>
