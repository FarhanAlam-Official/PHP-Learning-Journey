<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 5 of PHP</title>
    <?php include __DIR__ . '/includes/head.php'; ?>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary: #0ea5e9;
            --dark: #1e293b;
            --light: #f8fafc;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --border-radius: 8px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f0f2f5;
            color: var(--dark);
            line-height: 1.6;
            padding: 20px;
        }
        
        h1, h2, h3 {
            color: var(--primary);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 20px;
        }
        
        .dashboard-header {
            background-color: white;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .dashboard-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .dashboard-subtitle {
            color: #64748b;
            font-size: 1rem;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        thead {
            background-color: var(--primary);
            color: white;
        }
        
        th {
            padding: 15px 10px;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }
        
        tbody tr:hover {
            background-color: var(--primary-light);
        }
        
        .student-name {
            text-align: left;
            font-weight: 500;
            color: var(--primary);
        }
        
        .grade-A {
            background-color: rgba(16, 185, 129, 0.1);
            font-weight: 600;
            color: #047857;
        }
        
        .grade-B {
            background-color: rgba(14, 165, 233, 0.1);
            font-weight: 600;
            color: #0369a1;
        }
        
        .grade-C {
            background-color: rgba(245, 158, 11, 0.1);
            font-weight: 600;
            color: #b45309;
        }
        
        .grade-D {
            background-color: rgba(249, 115, 22, 0.1);
            font-weight: 600;
            color: #c2410c;
        }
        
        .grade-F {
            background-color: rgba(239, 68, 68, 0.1);
            font-weight: 600;
            color: #b91c1c;
        }
        
        .pass {
            color: #047857;
            font-weight: 600;
        }
        
        .fail {
            color: #b91c1c;
            font-weight: 600;
        }
        
        .summary-section {
            background-color: white;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .summary-title {
            font-size: 1.4rem;
            color: var(--primary);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .summary-card {
            background-color: var(--primary-light);
            padding: 15px;
            border-radius: var(--border-radius);
        }
        
        .summary-card h3 {
            font-size: 1.1rem;
            color: var(--primary);
            margin-bottom: 10px;
            text-align: left;
        }
        
        .summary-card p {
            font-size: 2rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .summary-card .subtitle {
            font-size: 0.9rem;
            color: #64748b;
        }
        
        .learning-section {
            background-color: white;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .learning-title {
            font-size: 1.4rem;
            color: var(--primary);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .learning-card {
            background-color: var(--primary-light);
            padding: 15px;
            border-radius: var(--border-radius);
        }
        
        .learning-card h3 {
            font-size: 1.1rem;
            color: var(--primary);
            margin-bottom: 10px;
            text-align: left;
        }
        
        .learning-card ul {
            padding-left: 20px;
        }
        
        .learning-card li {
            margin-bottom: 5px;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
        
        @media (max-width: 768px) {
            table {
                font-size: 0.8rem;
            }
            
            th, td {
                padding: 8px 5px;
            }
            
            .dashboard-title {
                font-size: 1.5rem;
            }
        }
        @media (max-width: 480px) {
            .summary-grid, .learning-grid {
                grid-template-columns: 1fr;
            }
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
    </style>
</head>

<body>
    <div class="day-indicator">Day 5: Student Performance Dashboard</div>
    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Student Performance Dashboard</h1>
            <p class="dashboard-subtitle">Implementing Pokhara University Grading System</p>
        </div>
        
        <?php
        /*
         * DAY 5 LEARNING OBJECTIVES:
         * 
         * 1. Working with Multidimensional Arrays
         *    - Creating and accessing nested associative arrays
         *    - Using arrays to store complex data structures
         * 
         * 2. PHP Loops with Arrays
         *    - Using foreach loops to iterate through arrays
         *    - Accessing both keys and values in associative arrays
         * 
         * 3. PHP Functions
         *    - Creating custom functions with parameters
         *    - Return values from functions
         *    - Function documentation with comments
         * 
         * 4. Conditional Logic
         *    - Using if-else statements for decision making
         *    - Complex conditions with logical operators (&&)
         * 
         * 5. PHP with HTML Tables
         *    - Generating dynamic HTML content with PHP
         *    - Creating tables with rowspan and colspan
         *    - Alternating row styles
         * 
         * 6. Data Processing
         *    - Calculating totals and percentages
         *    - Converting numeric data to grades
         *    - Determining pass/fail status based on criteria
         */

        // STUDENT DATA ARRAY
        // This is a multidimensional associative array containing student information
        // Each student is an array with keys for name and subject marks
        $student_marks = [
            [
                "name" => "Farhan Alam",
                "web-II" => 92,
                "stat" => 88,
                "dccn" => 95,
                "econ" => 89,
                "om" => 91
            ],
            [
                "name" => "Regina Magar",
                "web-II" => 85,
                "stat" => 92,
                "dccn" => 78,
                "econ" => 88,
                "om" => 90
            ],
            [
                "name" => "Citiz Shrestha",
                "web-II" => 75,
                "stat" => 82,
                "dccn" => 68,
                "econ" => 72,
                "om" => 77
            ],
            [
                "name" => "Keshu Regmi",
                "web-II" => 98,
                "stat" => 95,
                "dccn" => 92,
                "econ" => 35,  // Failed in one subject
                "om" => 88
            ],
            [
                "name" => "Binusha Kandel",
                "web-II" => 65,
                "stat" => 70,
                "dccn" => 62,
                "econ" => 68,
                "om" => 72
            ],
            [
                "name" => "Aakash Poudel",
                "web-II" => 55,
                "stat" => 60,
                "dccn" => 58,
                "econ" => 52,
                "om" => 62
            ],
            [
                "name" => "Suman Thapa",
                "web-II" => 78,
                "stat" => 82,
                "dccn" => 75,
                "econ" => 80,
                "om" => 38  // Failed in one subject
            ],
            [
                "name" => "Priya Sharma",
                "web-II" => 45,
                "stat" => 42,
                "dccn" => 48,
                "econ" => 52,
                "om" => 50
            ],
            [
                "name" => "Rohan Gurung",
                "web-II" => 32,  // Failed in multiple subjects
                "stat" => 45,
                "dccn" => 38,
                "econ" => 42,
                "om" => 48
            ],
            [
                "name" => "Anisha KC",
                "web-II" => 88,
                "stat" => 92,
                "dccn" => 85,
                "econ" => 78,
                "om" => 82
            ]
        ];

        // Calculate class statistics
        // Initialize counters and arrays for storing calculated values
        $total_students = count($student_marks);
        $pass_count = 0;
        $fail_count = 0;
        $subject_totals = [
            "web-II" => 0,
            "stat" => 0,
            "dccn" => 0,
            "econ" => 0,
            "om" => 0
        ];
        
        // Calculate subject totals and count pass/fail students
        foreach ($student_marks as $student) {
            // Add each student's marks to the subject totals
            $subject_totals["web-II"] += $student["web-II"];
            $subject_totals["stat"] += $student["stat"];
            $subject_totals["dccn"] += $student["dccn"];
            $subject_totals["econ"] += $student["econ"];
            $subject_totals["om"] += $student["om"];
            
            // Check if student passed or failed and update counters
            if (checkResult($student) == "Pass") {
                $pass_count++;
            } else {
                $fail_count++;
            }
        }
        
        // Calculate subject averages by dividing totals by number of students
        $subject_averages = [
            "web-II" => $subject_totals["web-II"] / $total_students,
            "stat" => $subject_totals["stat"] / $total_students,
            "dccn" => $subject_totals["dccn"] / $total_students,
            "econ" => $subject_totals["econ"] / $total_students,
            "om" => $subject_totals["om"] / $total_students
        ];
        
        // Find highest and lowest performing subjects
        $highest_subject = "";
        $highest_avg = 0;
        $lowest_subject = "";
        $lowest_avg = 100;
        
        // Loop through subject averages to find highest and lowest
        foreach ($subject_averages as $subject => $avg) {
            if ($avg > $highest_avg) {
                $highest_avg = $avg;
                $highest_subject = $subject;
            }
            if ($avg < $lowest_avg) {
                $lowest_avg = $avg;
                $lowest_subject = $subject;
            }
        }
        
        // Find top performer based on percentage
        $top_student = "";
        $top_percentage = 0;
        
        foreach ($student_marks as $student) {
            // Calculate total marks and percentage
            $total = $student["web-II"] + $student["stat"] + $student["dccn"] + $student["econ"] + $student["om"];
            $percentage = ($total / 500) * 100;
            
            // Update top performer if current student has higher percentage
            if ($percentage > $top_percentage) {
                $top_percentage = $percentage;
                $top_student = $student["name"];
            }
        }
        ?>
        
        <!-- Summary Cards Section -->
        <div class="summary-section">
            <h2 class="summary-title">Class Performance Summary</h2>
            
            <div class="summary-grid">
                <div class="summary-card">
                    <h3>Total Students</h3>
                    <p><?= $total_students ?></p>
                </div>
                
                <div class="summary-card">
                    <h3>Pass Rate</h3>
                    <p><?= number_format(($pass_count / $total_students) * 100, 1) ?>%</p>
                    <span class="subtitle"><?= $pass_count ?> passed, <?= $fail_count ?> failed</span>
                </div>
                
                <div class="summary-card">
                    <h3>Top Performer</h3>
                    <p><?= $top_student ?></p>
                    <span class="subtitle"><?= number_format($top_percentage, 1) ?>%</span>
                </div>
                
                <div class="summary-card">
                    <h3>Best Subject</h3>
                    <p><?= ucfirst(str_replace('-', ' ', $highest_subject)) ?></p>
                    <span class="subtitle">Avg: <?= number_format($highest_avg, 1) ?></span>
                </div>
            </div>
        </div>
        
        <!-- Main Results Table -->
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Student Name</th>
                    <th colspan="5">Subject Marks & Grades</th>
                    <th rowspan="2">Total</th>
                    <th rowspan="2">Percentage</th>
                    <th rowspan="2">GPA</th>
                    <th rowspan="2">Result</th>
                </tr>
                <tr>
                    <th>Web Tech II</th>
                    <th>DCCN</th>
                    <th>Org. Management</th>
                    <th>Economics</th>
                    <th>Statistics</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each student to create table rows
                foreach ($student_marks as $student) {
                    // Calculate total marks, percentage, GPA and result for current student
                    $total_marks = $student["web-II"] + $student["dccn"] + $student["om"] + $student["econ"] + $student["stat"];
                    $percentage = ($total_marks / 500) * 100;
                    $gpa = calculateGPA($percentage);
                    $result = checkResult($student);
                    
                    // Determine row styling based on result
                    $row_class = ($result == "Pass") ? "pass-row" : "fail-row";
                ?>
                    <tr class="<?= $row_class ?>">
                        <td class="student-name"><?= $student["name"] ?></td>
                        <td class="<?= getGradeClass($student["web-II"]) ?>">
                            <?= $student["web-II"] ?><br>
                            <small><?= calculateGrade($student["web-II"]) ?></small>
                        </td>
                        <td class="<?= getGradeClass($student["dccn"]) ?>">
                            <?= $student["dccn"] ?><br>
                            <small><?= calculateGrade($student["dccn"]) ?></small>
                        </td>
                        <td class="<?= getGradeClass($student["om"]) ?>">
                            <?= $student["om"] ?><br>
                            <small><?= calculateGrade($student["om"]) ?></small>
                        </td>
                        <td class="<?= getGradeClass($student["econ"]) ?>">
                            <?= $student["econ"] ?><br>
                            <small><?= calculateGrade($student["econ"]) ?></small>
                        </td>
                        <td class="<?= getGradeClass($student["stat"]) ?>">
                            <?= $student["stat"] ?><br>
                            <small><?= calculateGrade($student["stat"]) ?></small>
                        </td>
                        <td><?= $total_marks ?></td>
                        <td><?= number_format($percentage, 2) ?>%</td>
                        <td><?= number_format($gpa, 2) ?></td>
                        <td class="<?= ($result == "Pass") ? "pass" : "fail" ?>"><?= $result ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <?php
        /**
         * FUNCTION: calculateGrade
         * Converts numeric marks to letter grades according to Pokhara University grading system
         * 
         * @param int $marks - The numeric marks (0-100)
         * @return string - The letter grade (A, A-, B+, etc.)
         */
        function calculateGrade($marks) {
            // Pokhara University Grading System
            if ($marks >= 90) {
                return "A";
            } elseif ($marks >= 80) {
                return "A-";
            } elseif ($marks >= 70) {
                return "B+";
            } elseif ($marks >= 60) {
                return "B";
            } elseif ($marks >= 50) {
                return "B-";
            } elseif ($marks >= 45) {
                return "C+";
            } elseif ($marks >= 40) {
                return "C";
            } else {
                return "F";
            }
        }

        /**
         * FUNCTION: getGradeClass
         * Returns a CSS class based on the mark range for styling
         * 
         * @param int $marks - The numeric marks (0-100)
         * @return string - CSS class name for styling
         */
        function getGradeClass($marks) {
            if ($marks >= 80) {
                return "grade-A";
            } elseif ($marks >= 60) {
                return "grade-B";
            } elseif ($marks >= 45) {
                return "grade-C";
            } elseif ($marks >= 40) {
                return "grade-D";
            } else {
                return "grade-F";
            }
        }

        /**
         * FUNCTION: checkResult
         * Determines if a student has passed or failed based on Pokhara University criteria
         * Pass criteria: All subjects must have at least 40 marks
         * 
         * @param array $marks - Associative array of subject marks
         * @return string - "Pass" or "Fail"
         */
        function checkResult($marks) {
            // Check if any subject has marks less than 40 (failing grade)
            if (
                $marks["web-II"] >= 40 &&
                $marks["dccn"] >= 40 &&
                $marks["om"] >= 40 &&
                $marks["econ"] >= 40 &&
                $marks["stat"] >= 40
            ) {
                return "Pass";
            } else {
                return "Fail";
            }
        }

        /**
         * FUNCTION: calculateGPA
         * Converts percentage to GPA according to Pokhara University system
         * 
         * @param float $percentage - The percentage score (0-100)
         * @return float - The GPA score (0.0-4.0)
         */
        function calculateGPA($percentage) {
            // Pokhara University GPA System
            if ($percentage >= 90) {
                return 4.0;  // A
            } elseif ($percentage >= 80) {
                return 3.7;  // A-
            } elseif ($percentage >= 70) {
                return 3.3;  // B+
            } elseif ($percentage >= 60) {
                return 3.0;  // B
            } elseif ($percentage >= 50) {
                return 2.7;  // B-
            } elseif ($percentage >= 45) {
                return 2.3;  // C+
            } elseif ($percentage >= 40) {
                return 2.0;  // C
            } else {
                return 0.0;  // F
            }
        }
        ?>
        
        <!-- What We Learned Section -->
        <div class="learning-section">
            <h2 class="learning-title">What We Learned - Day 5</h2>
            
            <div class="learning-grid">
                <div class="learning-card">
                    <h3>1. Multidimensional Arrays</h3>
                    <ul>
                        <li>Created complex data structures using nested associative arrays</li>
                        <li>Stored student information with multiple subjects and marks</li>
                        <li>Accessed array elements using multiple keys</li>
                        <li>Used arrays to organize related data logically</li>
                    </ul>
                </div>
                
                <div class="learning-card">
                    <h3>2. PHP Loops with Arrays</h3>
                    <ul>
                        <li>Used foreach loops to iterate through multidimensional arrays</li>
                        <li>Processed each student's data individually</li>
                        <li>Calculated totals and averages using loops</li>
                        <li>Generated dynamic HTML table rows with PHP loops</li>
                    </ul>
                </div>
                
                <div class="learning-card">
                    <h3>3. PHP Functions</h3>
                    <ul>
                        <li>Created reusable functions with specific purposes</li>
                        <li>Implemented parameter passing to functions</li>
                        <li>Used return values to get results from functions</li>
                        <li>Added documentation comments to explain function behavior</li>
                        <li>Organized code into logical, reusable components</li>
                    </ul>
                </div>
                
                <div class="learning-card">
                    <h3>4. Conditional Logic</h3>
                    <ul>
                        <li>Used if-else statements for decision making</li>
                        <li>Implemented complex conditions with logical operators (&&)</li>
                        <li>Applied conditional logic to determine grades and pass/fail status</li>
                        <li>Used conditional expressions for dynamic styling</li>
                    </ul>
                </div>
                
                <div class="learning-card">
                    <h3>5. PHP with HTML Tables</h3>
                    <ul>
                        <li>Generated dynamic HTML content with PHP</li>
                        <li>Created complex tables with rowspan and colspan attributes</li>
                        <li>Applied conditional styling to table cells</li>
                        <li>Organized data presentation in a structured format</li>
                    </ul>
                </div>
                
                <div class="learning-card">
                    <h3>6. Pokhara University Grading System</h3>
                    <ul>
                        <li>Implemented the specific grading system used by Pokhara University</li>
                        <li>Converted numeric marks to letter grades</li>
                        <li>Calculated GPA based on percentage</li>
                        <li>Applied pass/fail criteria according to university standards</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Practical Applications Section -->
        <div class="learning-section">
            <h2 class="learning-title">Practical Applications</h2>
            
            <div class="learning-grid">
                <div class="learning-card">
                    <h3>Educational Management Systems</h3>
                    <p>The techniques learned today are fundamental to building educational management systems where:</p>
                    <ul>
                        <li>Student records need to be stored and processed</li>
                        <li>Grades need to be calculated automatically</li>
                        <li>Performance statistics need to be generated</li>
                        <li>Results need to be presented in a clear, organized manner</li>
                    </ul>
                </div>
                
                <div class="learning-card">
                    <h3>Data Analysis and Reporting</h3>
                    <p>The skills developed can be applied to:</p>
                    <ul>
                        <li>Processing large datasets</li>
                        <li>Generating statistical summaries</li>
                        <li>Creating dynamic reports</li>
                        <li>Visualizing data through conditional formatting</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 5
        </div>
        
        <div class="footer-dates">
            <p>Created on: April 29, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_4.php" class="nav-btn">← Day 4</a>
            <span class="day-counter">Day 5 of 25</span>
            <a href="Day_6.php" class="nav-btn">Day 6 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 5/25 (20.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 20.00%"></div>
            </div>
            <div class="progress-percentage">20.00% Complete</div>
        </div>
    </div>
</body>

</html>
