<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Day 13 PHP</title>
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

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 0;
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
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="hero-section">
        <h1>About Us</h1>
        <p>Learning PHP File Organization and Includes</p>
    </div>

    <div class="container">
        <div class="learning-card">
            <h3>About This Project</h3>
            <p>This is Day 13 of our PHP learning journey. We're focusing on:</p>
            <ul>
                <li>File organization</li>
                <li>Include statements</li>
                <li>Header and footer reusability</li>
                <li>Clean navigation structure</li>
            </ul>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>