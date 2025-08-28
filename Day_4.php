<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 4 of PHP - Working with Tables</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <?php include __DIR__ . '/includes/head.php'; ?>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: rgba(79, 70, 229, 0.1);
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
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 20px;
        }
        
        h1, h2, h3 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 20px;
        }
        
        .section {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.4rem;
            color: var(--primary);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .code-example {
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: var(--border-radius);
            font-family: monospace;
            margin: 15px 0;
            white-space: pre-wrap;
        }
        
        .explanation {
            background-color: var(--primary-light);
            padding: 15px;
            border-radius: var(--border-radius);
            margin: 15px 0;
        }
        
        /* Table Styles */
        table {
            border: 2px solid var(--primary);
            border-collapse: collapse;
            margin: auto;
            margin-top: 25px;
            margin-bottom: 25px;
            width: 100%;
            background-color: white;
            box-shadow: var(--box-shadow);
        }
        
        th {
            background-color: var(--primary);
            color: white;
            font-size: 1rem;
            padding: 12px;
            text-align: center;
        }
        
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        tr:hover {
            background-color: var(--primary-light);
        }
        
        .student-name {
            font-weight: 500;
            text-align: left;
        }
        
        .mark-excellent {
            background-color: rgba(16, 185, 129, 0.2);
            font-weight: 600;
        }
        
        .mark-good {
            background-color: rgba(14, 165, 233, 0.2);
        }
        
        .mark-average {
            background-color: rgba(245, 158, 11, 0.2);
        }
        
        .mark-poor {
            background-color: rgba(239, 68, 68, 0.2);
        }
        
        .total-row {
            background-color: var(--primary-light);
            font-weight: 600;
        }
        
        .average-row {
            background-color: rgba(16, 185, 129, 0.1);
            font-weight: 600;
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
        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
            }
            
            th, td {
                padding: 8px 5px;
            }
        }
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .section {
                padding: 15px;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            h2 {
                font-size: 1.2rem;
            }
        }
                /* Day Indicator styles */
        .day-indicator {
            background-color: var(--primary);
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
    <div class="day-indicator">Day 4: PHP Tables and Data Presentation</div>
    <div class="container">
        <h1>PHP Tables and Data Presentation</h1>
        
        <div class="section">
            <h2 class="section-title">Working with Arrays and Foreach Loops</h2>
            
            <div class="explanation">
                <p>In this example, we'll demonstrate how to use PHP to process and display data in HTML tables. We'll work with:</p>
                <ul>
                    <li>Multidimensional associative arrays to store student data</li>
                    <li>Foreach loops to iterate through array elements</li>
                    <li>HTML tables with proper structure (thead, tbody, tfoot)</li>
                    <li>Dynamic styling based on data values</li>
                    <li>Calculations for totals and averages</li>
                </ul>
            </div>
            
            <div class="code-example">
                <?php
                // Simple array example
                $array = ["Farhan Alam", "Regina Gharti Magar", "Citiz Shrestha", "Keshu Regmi", "Binusha Kandel"];
                
                echo "Basic foreach loop example:<br>";
                foreach($array as $name) {
                    echo "Name: " . $name . "<br>";
                }
                
                echo "<br>Foreach with key and value:<br>";
                foreach ($array as $key => $value) {
                    echo "Index: " . $key . ", Name: " . $value . "<br>";
                }
                ?>
            </div>
        </div>
        
        <?php
        // Student marks data - multidimensional associative array
        $student_marks = [
            [
                "name" => "Farhan Alam",
                "web-II" => 98,
                "stat" => 100,
                "dccn" => 95,
                "econ" => 99,
                "om" => 96
            ],
            [
                "name" => "Regina Magar",
                "web-II" => 92,
                "stat" => 88,
                "dccn" => 90,
                "econ" => 85,
                "om" => 94
            ],
            [
                "name" => "Citiz Shrestha",
                "web-II" => 85,
                "stat" => 92,
                "dccn" => 88,
                "econ" => 90,
                "om" => 87
            ],
            [
                "name" => "Keshu Regmi",
                "web-II" => 78,
                "stat" => 82,
                "dccn" => 75,
                "econ" => 80,
                "om" => 85
            ],
            [
                "name" => "Binusha Kandel",
                "web-II" => 95,
                "stat" => 97,
                "dccn" => 92,
                "econ" => 94,
                "om" => 90
            ],
            [
                "name" => "Anil Kumar",
                "web-II" => 88,
                "stat" => 85,
                "dccn" => 82,
                "econ" => 87,
                "om" => 84
            ],
            [
                "name" => "Priya Sharma",
                "web-II" => 91,
                "stat" => 94,
                "dccn" => 89,
                "econ" => 92,
                "om" => 88
            ],
            [
                "name" => "Rahul Singh",
                "web-II" => 82,
                "stat" => 78,
                "dccn" => 85,
                "econ" => 80,
                "om" => 83
            ]
        ];
        
        // Function to calculate total marks for a student
        function calculateTotal($student) {
            return $student["web-II"] + $student["stat"] + $student["dccn"] + $student["econ"] + $student["om"];
        }
        
        // Function to calculate average marks for a student
        function calculateAverage($student) {
            return calculateTotal($student) / 5;
        }
        
        // Function to get CSS class based on marks
        function getMarkClass($mark) {
            if ($mark >= 90) {
                return "mark-excellent";
            } elseif ($mark >= 80) {
                return "mark-good";
            } elseif ($mark >= 70) {
                return "mark-average";
            } else {
                return "mark-poor";
            }
        }
        
        // Calculate subject totals and averages
        $subject_totals = [
            "web-II" => 0,
            "stat" => 0,
            "dccn" => 0,
            "econ" => 0,
            "om" => 0
        ];
        
        foreach ($student_marks as $student) {
            $subject_totals["web-II"] += $student["web-II"];
            $subject_totals["stat"] += $student["stat"];
            $subject_totals["dccn"] += $student["dccn"];
            $subject_totals["econ"] += $student["econ"];
            $subject_totals["om"] += $student["om"];
        }
        
        $num_students = count($student_marks);
        $subject_averages = [
            "web-II" => $subject_totals["web-II"] / $num_students,
            "stat" => $subject_totals["stat"] / $num_students,
            "dccn" => $subject_totals["dccn"] / $num_students,
            "econ" => $subject_totals["econ"] / $num_students,
            "om" => $subject_totals["om"] / $num_students
        ];
        ?>
        
        <div class="section">
            <h2 class="section-title">Student Marks Table</h2>
            
            <div class="explanation">
                <p>This table displays student marks with the following features:</p>
                <ul>
                    <li>Color-coded marks based on performance (excellent, good, average, poor)</li>
                    <li>Calculated total and average for each student</li>
                    <li>Subject-wise totals and averages in the footer</li>
                    <li>Proper table structure with thead, tbody, and tfoot</li>
                </ul>
            </div>
            
            <table border="1">
                <thead>
                    <tr>
                        <th rowspan="2">Student Name</th>
                        <th colspan="5">Marks</th>
                        <th rowspan="2">Total</th>
                        <th rowspan="2">Average</th>
                    </tr>
                    <tr>
                        <th>Web Technologies II</th>
                        <th>DCCN</th>
                        <th>Organization Management</th>
                        <th>Economics</th>
                        <th>Statistics</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($student_marks as $student) { 
                        $total = calculateTotal($student);
                        $average = calculateAverage($student);
                    ?>
                    <tr>
                        <td class="student-name"><?= $student["name"] ?></td>
                        <td class="<?= getMarkClass($student["web-II"]) ?>"><?= $student["web-II"] ?></td>
                        <td class="<?= getMarkClass($student["dccn"]) ?>"><?= $student["dccn"] ?></td>
                        <td class="<?= getMarkClass($student["om"]) ?>"><?= $student["om"] ?></td>
                        <td class="<?= getMarkClass($student["econ"]) ?>"><?= $student["econ"] ?></td>
                        <td class="<?= getMarkClass($student["stat"]) ?>"><?= $student["stat"] ?></td>
                        <td><strong><?= $total ?></strong></td>
                        <td><strong><?= number_format($average, 1) ?></strong></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td><strong>Total</strong></td>
                        <td><?= $subject_totals["web-II"] ?></td>
                        <td><?= $subject_totals["dccn"] ?></td>
                        <td><?= $subject_totals["om"] ?></td>
                        <td><?= $subject_totals["econ"] ?></td>
                        <td><?= $subject_totals["stat"] ?></td>
                        <td><?= array_sum($subject_totals) ?></td>
                        <td><?= number_format(array_sum($subject_totals) / (5 * $num_students), 1) ?></td>
                    </tr>
                    <tr class="average-row">
                        <td><strong>Average</strong></td>
                        <td><?= number_format($subject_averages["web-II"], 1) ?></td>
                        <td><?= number_format($subject_averages["dccn"], 1) ?></td>
                        <td><?= number_format($subject_averages["om"], 1) ?></td>
                        <td><?= number_format($subject_averages["econ"], 1) ?></td>
                        <td><?= number_format($subject_averages["stat"], 1) ?></td>
                        <td><?= number_format(array_sum($subject_averages), 1) ?></td>
                        <td><?= number_format(array_sum($subject_averages) / 5, 1) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="section">
            <h2 class="section-title">Student Performance Analysis</h2>
            
            <?php
            // Find top performer
            $top_student = null;
            $top_average = 0;
            
            foreach ($student_marks as $student) {
                $avg = calculateAverage($student);
                if ($avg > $top_average) {
                    $top_average = $avg;
                    $top_student = $student;
                }
            }
            
            // Find subject with highest average
            $highest_subject = "";
            $highest_subject_avg = 0;
            
            foreach ($subject_averages as $subject => $avg) {
                if ($avg > $highest_subject_avg) {
                    $highest_subject_avg = $avg;
                    $highest_subject = $subject;
                }
            }
            
            // Count performance categories
            $excellent_count = 0;
            $good_count = 0;
            $average_count = 0;
            $poor_count = 0;
            
            foreach ($student_marks as $student) {
                $avg = calculateAverage($student);
                if ($avg >= 90) {
                    $excellent_count++;
                } elseif ($avg >= 80) {
                    $good_count++;
                } elseif ($avg >= 70) {
                    $average_count++;
                } else {
                    $poor_count++;
                }
            }
            ?>
            
            <div class="explanation">
                <h3>Class Performance Summary</h3>
                <p><strong>Top Performer:</strong> <?= $top_student["name"] ?> with an average of <?= number_format($top_average, 1) ?></p>
                <p><strong>Highest Performing Subject:</strong> <?= ucfirst($highest_subject) ?> with an average of <?= number_format($highest_subject_avg, 1) ?></p>
                <p><strong>Performance Distribution:</strong></p>
                <ul>
                    <li>Excellent (90+): <?= $excellent_count ?> students</li>
                    <li>Good (80-89): <?= $good_count ?> students</li>
                    <li>Average (70-79): <?= $average_count ?> students</li>
                    <li>Needs Improvement (below 70): <?= $poor_count ?> students</li>
                </ul>
            </div>
            
            <div class="code-example">
                <p>// Example code for calculating student average</p>
                <pre>function calculateAverage($student) {
    return ($student["web-II"] + $student["stat"] + 
            $student["dccn"] + $student["econ"] + 
            $student["om"]) / 5;
}

// Example code for determining mark styling
function getMarkClass($mark) {
    if ($mark >= 90) {
        return "mark-excellent";
    } elseif ($mark >= 80) {
        return "mark-good";
    } elseif ($mark >= 70) {
        return "mark-average";
    } else {
        return "mark-poor";
    }
}</pre>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 4
        </div>
        
        <div class="footer-dates">
            <p>Created on: April 28, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_3.php" class="nav-btn">← Day 3</a>
            <span class="day-counter">Day 4 of 25</span>
            <a href="Day_5.php" class="nav-btn">Day 5 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 4/25 (16.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 16.00%"></div>
            </div>
            <div class="progress-percentage">16.00% Complete</div>
        </div>
    </div>
</body>
</html>
