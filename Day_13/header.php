<?php 
$menu = ["home", "about", "contact"];
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 13 of PHP</title>
    <link rel="stylesheet" href="transitions.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: rgba(79, 70, 229, 0.1);
            --dark: #1e293b;
            --white: #ffffff;
            --gray: #94a3b8;
            --transition: all 0.3s ease;
            --box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1rem 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .nav-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 3rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                      color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                      background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary);
            transform: translateY(-2px) scale(1.05);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--primary);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .active {
            color: var(--primary);
            background-color: var(--primary-light);
        }

        .active::after {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="page-transition"></div>
    <header class="header">
        <nav class="nav-container">
            <ul class="nav-list">
                <?php foreach($menu as $item): ?>
                    <li>
                        <a href="<?= $item ?>.php" 
                           class="nav-link <?= $current_page === $item.'.php' ? 'active' : '' ?>">
                            <?= ucfirst($item) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>
</body>
</html>