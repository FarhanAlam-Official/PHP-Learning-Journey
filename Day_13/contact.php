<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Day 13 PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="transitions.css">
    <style>
        /* Base Variables */
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
            --transition: all 0.3s ease;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                         0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Base Styles */
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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-light), rgba(6, 182, 212, 0.1));
            padding: 4rem 2rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        .hero-section h1 {
            color: var(--primary);
            font-size: 2.5rem;
            margin: 0 0 1rem;
            position: relative;
            display: inline-block;
        }

        .hero-section h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .hero-section p {
            color: var(--dark);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 1rem auto 0;
        }

        /* Learning Grid */
        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto 3rem;
        }

        .learning-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.6s ease forwards;
            opacity: 0;
        }

        .learning-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                       0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .learning-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            opacity: 0;
            transition: var(--transition);
        }

        .learning-card:hover::before {
            opacity: 1;
        }

        .learning-card h3 {
            color: var(--primary);
            margin: 0 0 1.5rem;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .learning-card p {
            color: var(--gray);
            line-height: 1.8;
            margin: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Enhanced Transitions */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .learning-card:nth-child(1) { animation-delay: 0.2s; }
        .learning-card:nth-child(2) { animation-delay: 0.4s; }
        .learning-card:nth-child(3) { animation-delay: 0.6s; }

        /* Icons and Emojis */
        .learning-card p::before {
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .learning-grid {
                padding: 1rem;
                gap: 1rem;
            }

            .learning-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-transition"></div>
    <?php include 'header.php'; ?>

    <div class="hero-section">
        <h1>Contact Us</h1>
        <p>Get in touch with our team</p>
    </div>

    <div class="learning-grid">
        <div class="learning-card">
            <h3>📞 Contact Information</h3>
            <p>📧 Email: demo@example.com</p>
            <p>📱 Phone: (123) 456-7890</p>
            <p>🏢 Address: 123 PHP Street</p>
        </div>
        
        <div class="learning-card">
            <h3>🎯 Learning Highlights</h3>
            <p>📁 File organization with PHP</p>
            <p>🔄 Component reusability</p>
            <p>🏗️ Clean code structure</p>
        </div>
        
        <div class="learning-card">
            <h3>⏰ Office Hours</h3>
            <p>📅 Monday - Friday: 9 AM - 5 PM</p>
            <p>🗓️ Saturday: 10 AM - 2 PM</p>
            <p>🔒 Sunday: Closed</p>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        // Page transition effect
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('a');
            const transition = document.querySelector('.page-transition');

            links.forEach(link => {
                link.addEventListener('click', e => {
                    if (link.hostname === window.location.hostname) {
                        e.preventDefault();
                        transition.classList.add('fade-out');
                        
                        setTimeout(() => {
                            window.location = link.href;
                        }, 500);
                    }
                });
            });
        });
    </script>
</body>
</html>