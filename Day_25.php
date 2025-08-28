<?php
/**
 * Day 25 - Final Project Integration & Portfolio Completion
 * 
 * This is the culmination of our 25-day PHP learning journey!
 * 
 * Learning Objectives:
 * 1. Project portfolio overview and organization
 * 2. Code review and best practices implementation
 * 3. Security audit and vulnerability assessment
 * 4. Performance optimization techniques
 * 5. Deployment preparation and environment configuration
 * 6. Documentation and code maintainability
 * 7. Next steps for continued learning
 * 
 * Skills Demonstrated:
 * - Complete web application development lifecycle
 * - Database design and management
 * - User authentication and authorization
 * - File handling and data processing
 * - API development and integration
 * - Security implementation
 * - Responsive web design
 */

// Include database connection
include "db.php";
$conn = db();

// Calculate overall statistics for the portfolio
$stats = [
    'total_days' => 25,
    'completed_days' => 25,
    'completion_percentage' => 100,
    'total_files' => 0,
    'total_lines_of_code' => 0,
    'concepts_learned' => []
];

// Get list of all Day files for portfolio analysis
$dayFiles = glob("Day_*.php");
$stats['total_files'] = count($dayFiles);

// Define the learning progression
$learning_progression = [
    'Week 1 (Days 1-5)' => [
        'focus' => 'PHP Fundamentals',
        'topics' => ['PHP Syntax', 'Variables & Data Types', 'Arrays', 'Control Structures', 'Functions']
    ],
    'Week 2 (Days 6-10)' => [
        'focus' => 'Web Development',
        'topics' => ['Product Showcase', 'Form Handling', 'POST Method', 'Sessions', 'Login Systems']
    ],
    'Week 3 (Days 11-15)' => [
        'focus' => 'Data Management',
        'topics' => ['Cookies', 'Cookie Management', 'Multi-page Websites', 'Database Connectivity', 'CRUD Operations']
    ],
    'Week 4 (Days 16-20)' => [
        'focus' => 'Advanced Features',
        'topics' => ['File Management', 'User Registration', 'User Management', 'Advanced CRUD', 'Search & Filtering']
    ],
    'Week 5 (Days 21-25)' => [
        'focus' => 'Professional Development',
        'topics' => ['File Upload Systems', 'Encoding & Decoding', 'Email Integration', 'API Development', 'Portfolio Integration']
    ]
];

// Portfolio highlights
$portfolio_highlights = [
    [
        'title' => 'User Management System',
        'description' => 'Complete CRUD operations with authentication, search functionality, and status management',
        'technologies' => ['PHP', 'MySQL', 'HTML5', 'CSS3', 'JavaScript'],
        'features' => ['User Registration', 'Login/Logout', 'Profile Management', 'Search & Filter', 'Status Toggle']
    ],
    [
        'title' => 'Product Showcase Platform',
        'description' => 'Dynamic product display with filtering, categories, and responsive design',
        'technologies' => ['PHP', 'CSS Grid', 'Responsive Design', 'Array Processing'],
        'features' => ['Product Catalog', 'Category Filtering', 'Search Functionality', 'Responsive Layout']
    ],
    [
        'title' => 'File Management System',
        'description' => 'Secure file upload, processing, and management with validation',
        'technologies' => ['PHP File Handling', 'Security Validation', 'File Processing'],
        'features' => ['File Upload', 'File Validation', 'Directory Management', 'Security Controls']
    ],
    [
        'title' => 'RESTful API Services',
        'description' => 'Professional API endpoints with JSON responses and authentication',
        'technologies' => ['REST Architecture', 'JSON', 'API Security', 'CORS'],
        'features' => ['CRUD Endpoints', 'Authentication', 'Error Handling', 'Documentation']
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 25 of PHP - Portfolio Completion & Journey Summary</title>
    <?php include __DIR__ . '/includes/head.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS Variables for consistent theming */
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
            --info: #3b82f6;
            --warning: #f59e0b;
            --error: #ef4444;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        /* Day Indicator styles */
        .day-indicator {
            background: linear-gradient(135deg, var(--success), #10b981);
            color: white;
            text-align: center;
            padding: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f9fc 0%, #eef2ff 100%);
            margin: 0;
            padding: 0;
            padding-top: 60px; /* Adjusted for fixed header */
            color: var(--dark);
            min-height: 100vh;
            line-height: 1.6;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 60px;
            background: linear-gradient(135deg, var(--primary-light), rgba(6, 182, 212, 0.1));
            padding: 60px 40px;
            border-radius: var(--border-radius);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--success), #10b981);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--gray);
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .completion-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            margin: 30px 0;
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: var(--border-radius);
            text-align: center;
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--primary);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .stat-label {
            font-weight: 500;
            color: var(--gray);
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .progression-section {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 40px;
            margin: 40px 0;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .section-title {
            font-size: 2rem;
            color: var(--primary);
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .week-timeline {
            display: grid;
            gap: 30px;
        }

        .week-card {
            background: linear-gradient(135deg, var(--white), var(--primary-light));
            border-radius: var(--border-radius);
            padding: 30px;
            border-left: 6px solid var(--primary);
            transition: var(--transition);
        }

        .week-card:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.15);
        }

        .week-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .week-number {
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .week-info h3 {
            margin: 0;
            color: var(--primary-dark);
            font-size: 1.3rem;
        }

        .week-focus {
            color: var(--gray);
            font-size: 0.9rem;
            margin: 5px 0 0 0;
        }

        .topics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
        }

        .topic-tag {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            text-align: center;
            font-weight: 500;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .portfolio-section {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 40px;
            margin: 40px 0;
            box-shadow: var(--box-shadow);
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .portfolio-card {
            background: linear-gradient(135deg, var(--white), rgba(6, 182, 212, 0.05));
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--secondary);
            transition: var(--transition);
        }

        .portfolio-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .portfolio-card h3 {
            color: var(--secondary);
            margin: 0 0 15px 0;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 15px 0;
        }

        .tech-tag {
            background: var(--secondary);
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }

        .feature-list li {
            padding: 5px 0;
            color: var(--dark);
            position: relative;
            padding-left: 20px;
        }

        .feature-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--success);
            font-weight: bold;
        }

        .achievement-section {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(16, 185, 129, 0.05));
            border-radius: var(--border-radius);
            padding: 40px;
            margin: 40px 0;
            border: 2px solid rgba(34, 197, 94, 0.2);
        }

        .achievement-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .achievement-item {
            background: var(--white);
            padding: 20px;
            border-radius: var(--border-radius);
            text-align: center;
            box-shadow: var(--box-shadow);
        }

        .achievement-icon {
            font-size: 2rem;
            color: var(--success);
            margin-bottom: 15px;
        }

        .achievement-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .achievement-desc {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .next-steps-section {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 40px;
            margin: 40px 0;
            box-shadow: var(--box-shadow);
            border-left: 6px solid var(--warning);
        }

        .next-steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .next-step-card {
            background: rgba(245, 158, 11, 0.05);
            border-radius: var(--border-radius);
            padding: 25px;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .next-step-card h3 {
            color: var(--warning);
            margin: 0 0 15px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .celebration-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-align: center;
            padding: 60px 40px;
            border-radius: var(--border-radius);
            margin: 40px 0;
            position: relative;
            overflow: hidden;
        }

        .celebration-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: sparkle 3s ease-in-out infinite;
        }

        @keyframes sparkle {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(180deg); }
        }

        .celebration-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .celebration-text {
            font-size: 1.2rem;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .certificate-style {
            background: var(--white);
            color: var(--dark);
            padding: 20px 40px;
            border-radius: 50px;
            display: inline-block;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--success);
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-title {
            font-size: 1.2rem;
            color: var(--success);
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
            background-color: var(--success);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .nav-btn:hover {
            background-color: #15803d;
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
            height: 15px;
            background-color: #e2e8f0;
            border-radius: 8px;
            margin: 0 auto;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--success), #10b981);
            border-radius: 8px;
            transition: width 0.5s ease;
            animation: progressGlow 2s ease-in-out infinite;
        }

        @keyframes progressGlow {
            0%, 100% { box-shadow: 0 0 5px rgba(34, 197, 94, 0.5); }
            50% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.8); }
        }

        .progress-percentage {
            color: var(--success);
            font-weight: 700;
            margin-top: 8px;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .portfolio-grid {
                grid-template-columns: 1fr;
            }
            
            .page-wrapper {
                padding: 20px;
            }
            
            .hero-section {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="day-indicator">🎉 Day 25: Journey Complete - Portfolio Showcase! 🎉</div>
    
    <div class="page-wrapper">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">Journey Complete!</h1>
            <p class="hero-subtitle">
                Congratulations! You've successfully completed a comprehensive 25-day PHP learning journey, 
                building real-world applications and mastering modern web development practices.
            </p>
            <div class="completion-badge">
                🏆 PHP Learning Journey Completed
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= $stats['total_days'] ?></div>
                <div class="stat-label">Days Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $stats['total_files'] ?></div>
                <div class="stat-label">PHP Files Created</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Course Progress</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div class="stat-label">Concepts Learned</div>
            </div>
        </div>

        <!-- Learning Progression Section -->
        <div class="progression-section">
            <h2 class="section-title">Learning Progression Overview</h2>
            
            <div class="week-timeline">
                <?php foreach ($learning_progression as $week => $content): ?>
                <div class="week-card">
                    <div class="week-header">
                        <div class="week-number">
                            <?= substr($week, 5, 1) ?>
                        </div>
                        <div class="week-info">
                            <h3><?= $week ?></h3>
                            <p class="week-focus">Focus: <?= $content['focus'] ?></p>
                        </div>
                    </div>
                    <div class="topics-grid">
                        <?php foreach ($content['topics'] as $topic): ?>
                        <div class="topic-tag"><?= $topic ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Portfolio Highlights Section -->
        <div class="portfolio-section">
            <h2 class="section-title">Portfolio Highlights</h2>
            
            <div class="portfolio-grid">
                <?php foreach ($portfolio_highlights as $project): ?>
                <div class="portfolio-card">
                    <h3><?= $project['title'] ?></h3>
                    <p><?= $project['description'] ?></p>
                    
                    <div class="tech-tags">
                        <?php foreach ($project['technologies'] as $tech): ?>
                        <span class="tech-tag"><?= $tech ?></span>
                        <?php endforeach; ?>
                    </div>
                    
                    <ul class="feature-list">
                        <?php foreach ($project['features'] as $feature): ?>
                        <li><?= $feature ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Achievements Section -->
        <div class="achievement-section">
            <h2 class="section-title">Key Achievements</h2>
            
            <div class="achievement-grid">
                <div class="achievement-item">
                    <div class="achievement-icon">💻</div>
                    <div class="achievement-title">Full-Stack Development</div>
                    <div class="achievement-desc">Built complete web applications from frontend to database</div>
                </div>
                
                <div class="achievement-item">
                    <div class="achievement-icon">🔐</div>
                    <div class="achievement-title">Security Implementation</div>
                    <div class="achievement-desc">Learned authentication, data validation, and security best practices</div>
                </div>
                
                <div class="achievement-item">
                    <div class="achievement-icon">🗄️</div>
                    <div class="achievement-title">Database Mastery</div>
                    <div class="achievement-desc">Mastered CRUD operations, prepared statements, and database design</div>
                </div>
                
                <div class="achievement-item">
                    <div class="achievement-icon">🌐</div>
                    <div class="achievement-title">API Development</div>
                    <div class="achievement-desc">Created RESTful APIs with proper JSON responses and authentication</div>
                </div>
                
                <div class="achievement-item">
                    <div class="achievement-icon">📱</div>
                    <div class="achievement-title">Responsive Design</div>
                    <div class="achievement-desc">Built mobile-friendly interfaces with modern CSS techniques</div>
                </div>
                
                <div class="achievement-item">
                    <div class="achievement-icon">🎨</div>
                    <div class="achievement-title">Professional UI/UX</div>
                    <div class="achievement-desc">Designed clean, intuitive user interfaces with consistent styling</div>
                </div>
            </div>
        </div>

        <!-- Next Steps Section -->
        <div class="next-steps-section">
            <h2 class="section-title">Next Steps in Your PHP Journey</h2>
            
            <div class="next-steps-grid">
                <div class="next-step-card">
                    <h3><i class="fas fa-rocket"></i> Advanced PHP Frameworks</h3>
                    <p>Explore Laravel, Symfony, or CodeIgniter to build enterprise-level applications with modern PHP practices and MVC architecture.</p>
                </div>
                
                <div class="next-step-card">
                    <h3><i class="fas fa-cloud"></i> Cloud Deployment</h3>
                    <p>Learn to deploy your PHP applications to cloud platforms like AWS, DigitalOcean, or Heroku for production environments.</p>
                </div>
                
                <div class="next-step-card">
                    <h3><i class="fas fa-cogs"></i> DevOps & CI/CD</h3>
                    <p>Implement automated testing, continuous integration, and deployment pipelines for professional development workflows.</p>
                </div>
                
                <div class="next-step-card">
                    <h3><i class="fas fa-database"></i> Advanced Database</h3>
                    <p>Dive deeper into database optimization, indexing, complex queries, and alternative databases like MongoDB or Redis.</p>
                </div>
                
                <div class="next-step-card">
                    <h3><i class="fas fa-mobile-alt"></i> Frontend Integration</h3>
                    <p>Learn JavaScript frameworks like React or Vue.js to create dynamic frontends that consume your PHP APIs.</p>
                </div>
                
                <div class="next-step-card">
                    <h3><i class="fas fa-shield-alt"></i> Security Specialization</h3>
                    <p>Deepen your security knowledge with OWASP standards, penetration testing, and advanced security implementations.</p>
                </div>
            </div>
        </div>

        <!-- Celebration Section -->
        <div class="celebration-section">
            <h2 class="celebration-title">🎊 Congratulations! 🎊</h2>
            <p class="celebration-text">
                You've transformed from a PHP beginner to a competent web developer capable of building 
                complete, secure, and professional web applications. This portfolio demonstrates your 
                dedication, growth, and readiness for real-world development challenges.
            </p>
            <div class="certificate-style">
                Certificate of Completion - PHP Web Development Mastery
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            🎓 PHP Learning Journey - Day 25 (COMPLETE!)
        </div>
        
        <div class="footer-dates">
            <p>Journey started: May 22, 2025</p>
            <p>Completed on: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_24.php" class="nav-btn">← Day 24</a>
            <span class="day-counter">Day 25 of 25</span>
            <a href="index.php" class="nav-btn">🏠 Portfolio Home</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 25/25 (100.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 100.00%"></div>
            </div>
            <div class="progress-percentage">🎉 100.00% Complete! 🎉</div>
        </div>
    </div>

    <script>
        // Add some celebratory animation
        document.addEventListener('DOMContentLoaded', function() {
            const title = document.querySelector('.celebration-title');
            if (title) {
                title.style.animation = 'bounce 2s infinite';
            }
        });

        // Add bounce animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
                40% { transform: translateY(-10px); }
                60% { transform: translateY(-5px); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
