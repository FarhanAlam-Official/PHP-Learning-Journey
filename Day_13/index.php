<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 13 - PHP Include & Navigation</title>
    <?php include __DIR__ . '/../includes/head.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
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
            --error: #ef4444;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                         0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 0;
            padding-top: 40px; /* Adjusted for fixed header */
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }

        .hero-section {
            background-color: var(--primary-light);
            padding: 60px 20px;
            text-align: center;
            margin-bottom: 40px;
        }

        .hero-section h1 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .learning-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
        }

        .learning-card h3 {
            color: var(--primary);
            margin-top: 0;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--primary);
            width: 100%;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
        <div class="day-indicator">Day 13 of PHP Learning Journey</div>

    <?php include 'header.php'; ?>

    <div class="hero-section">
        <h1>Multi-page Website and Navigation</h1>
        <p>Learning PHP Include, Navigation, and File Organization</p>
    </div>

    <div class="container">
        <div class="learning-grid">
            <div class="learning-card">
                <h3>File Organization</h3>
                <p>Learn how to structure PHP applications using multiple files and includes.</p>
            </div>
            <div class="learning-card">
                <h3>Navigation System</h3>
                <p>Create a clean and reusable navigation system using PHP includes.</p>
            </div>
            <div class="learning-card">
                <h3>Code Reusability</h3>
                <p>Understand how to make your code more maintainable using includes and requires.</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>