<?php
/**
 * Day 23 - PHP Email System
 * This script demonstrates email handling in PHP using the mail() function
 */

$message = '';
$messageClass = '';

// Add setup information as a side resource
$setupResource = "
    <div class='resource-panel'>
        <div class='resource-header'>
            <i class='fas fa-info-circle'></i> Resources & Tips
        </div>
        <div class='resource-content'>
            <div class='resource-section'>
                <h4>About PHP mail()</h4>
                <p>PHP's mail() function provides a simple way to send emails directly from your scripts.</p>
            </div>
            
            <div class='resource-section'>
                <h4>Development Setup</h4>
                <ul class='resource-list'>
                    <li>Mercury Mail Server (included in XAMPP)</li>
                    <li>Simple SMTP configuration</li>
                    <li>Perfect for local testing</li>
                </ul>
            </div>

            <div class='resource-section'>
                <h4>Production Options</h4>
                <ul class='resource-list'>
                    <li>PHPMailer for enhanced features</li>
                    <li>SMTP services (Gmail, SendGrid)</li>
                    <li>Cloud email services (AWS SES)</li>
                </ul>
            </div>

            <div class='resource-tip'>
                <i class='fas fa-lightbulb'></i>
                <span>Start with the simple mail() function for learning, then explore more advanced options for production!</span>
            </div>
        </div>
    </div>";

// Add CSS for warning note and additional styles
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 23 - PHP Email System</title>
    <?php include __DIR__ . '/includes/head.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Common Variables */
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #06b6d4;
            --success: #22c55e;
            --error: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
            --white: #ffffff;
            --gray: #94a3b8;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 20px;
            color: var(--dark);
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            color: var(--primary);
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        /* Email Form Styles */
        .email-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input[type="email"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            font-family: inherit;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        /* Message Styles */
        .message {
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
        }

        .success {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .error {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Learning Section Styles */
        .learning-section {
            background: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 40px;
        }

        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .learning-card {
            background: rgba(79, 70, 229, 0.1);
            padding: 20px;
            border-radius: var(--border-radius);
        }

        /* Footer Styles */
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
            box-sizing: border-box;
        }

        .footer-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .footer-dates {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 20px;
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

        .progress-section {
            margin-top: 20px;
        }

        .progress-bar {
            width: 100%;
            max-width: 400px;
            height: 12px;
            background: #e2e8f0;
            border-radius: 6px;
            margin: 0 auto;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 6px;
            width: 92.00%;
            transition: width 0.5s ease;
        }

        /* Warning Note Styles */
        .warning-note {
            background: rgba(251, 146, 60, 0.1);
            border: 1px solid rgba(251, 146, 60, 0.3);
            border-radius: var(--border-radius);
            padding: 20px;
            margin: 20px 0;
        }

        .warning-note h3 {
            color: #c2410c;
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .warning-note ol {
            margin: 10px 0;
            padding-left: 20px;
        }

        .warning-note p {
            margin: 10px 0;
            color: #9a3412;
        }

        /* Update Setup Note Styles */
        .setup-note {
            background-color: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            padding: 15px 20px;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(220, 38, 38, 0.2);
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.05);
        }

        .setup-note i {
            font-size: 1.1rem;
            color: #dc2626;
        }

        .learn-more-btn {
            margin-left: auto;
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
            color: #dc2626;
            padding: 6px 12px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .learn-more-btn:hover {
            background: rgba(220, 38, 38, 0.15);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.1);
        }

        .learn-more-btn i {
            font-size: 0.85rem;
        }

        /* Learning Section Styles */
        .learning-section {
            background: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 40px;
        }

        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .learning-card {
            background: rgba(79, 70, 229, 0.1);
            padding: 20px;
            border-radius: var(--border-radius);
        }

        /* Footer Styles */
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
            box-sizing: border-box;
        }

        .footer-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .footer-dates {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 20px;
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

        .progress-section {
            margin-top: 20px;
        }

        .progress-bar {
            width: 100%;
            max-width: 400px;
            height: 12px;
            background: #e2e8f0;
            border-radius: 6px;
            margin: 0 auto;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 6px;
            width: 92.00%;
            transition: width 0.5s ease;
        }

        /* Warning Note Styles */
        .warning-note {
            background: rgba(251, 146, 60, 0.1);
            border: 1px solid rgba(251, 146, 60, 0.3);
            border-radius: var(--border-radius);
            padding: 20px;
            margin: 20px 0;
        }

        .warning-note h3 {
            color: #c2410c;
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .warning-note ol {
            margin: 10px 0;
            padding-left: 20px;
        }

        .warning-note p {
            margin: 10px 0;
            color: #9a3412;
        }

        /* Additional Styles */
        .resource-panel {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .resource-header {
            padding: 15px 20px;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .resource-content {
            padding: 20px;
        }

        .resource-section {
            margin-bottom: 20px;
        }

        .resource-section h4 {
            color: var(--secondary);
            margin: 0 0 10px 0;
        }

        .resource-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .resource-list li {
            padding: 8px 0;
            border-bottom: 1px solid var(--primary-light);
            color: var(--dark);
        }

        .resource-list li:last-child {
            border: none;
        }

        .resource-tip {
            background: var(--primary-light);
            padding: 15px;
            border-radius: var(--border-radius);
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-top: 20px;
            font-size: 0.9rem;
            color: var(--primary-dark);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: var(--white);
            margin: 50px auto;
            max-width: 600px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            animation: modalSlide 0.3s ease;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--gray);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header h3 {
            margin: 0;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .close-btn {
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
        }

        .modal-body {
            padding: 20px;
        }

        .config-step {
            margin-bottom: 20px;
        }

        .config-step h4 {
            color: var(--secondary);
            margin: 0 0 10px 0;
        }

        .config-step pre {
            background: var(--dark);
            color: var(--light);
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
        }

        @keyframes modalSlide {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @media (max-width: 768px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }
            
            .resource-panel {
                position: static;
            }
        }
            /* Day Indicator styles */
        .day-indicator {
            background-color: var(--primary-dark);
            color: var(--white);
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
    <div class="main-container">
        <!-- Day Indicator -->
    <div class="day-indicator">Day 23 of PHP Learning Journey</div>
        <div class="page-header">
            <h1><i class="fas fa-envelope"></i> PHP Email System</h1>
        </div>

        <div class="content-wrapper">
            <!-- Main Email Section -->
            <div class="email-section">
                <div class="setup-note">
                    <i class="fas fa-exclamation-circle"></i>
                    Note: Email functionality requires proper mail server configuration
                    <button class="learn-more-btn" onclick="openModal()">
                        <i class="fas fa-external-link-alt"></i>
                        Learn more
                    </button>
                </div>

                <?php if ($message): ?>
                    <div class="message <?= $messageClass ?>"><?= $message ?></div>
                <?php endif; ?>

                <div class="email-form">
                    <form method="POST">
                        <div class="form-group">
                            <label for="to"><i class="fas fa-user"></i> To:</label>
                            <input type="email" id="to" name="to" required>
                        </div>

                        <div class="form-group">
                            <label for="subject"><i class="fas fa-heading"></i> Subject:</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>

                        <div class="form-group">
                            <label for="message"><i class="fas fa-pen"></i> Message:</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>

                        <button type="submit" class="btn">
                            <i class="fas fa-paper-plane"></i> Send Email
                        </button>
                    </form>
                </div>
            </div>

            <!-- Resource Panel -->
            <div class="resource-panel">
                <?= $setupResource ?>
            </div>
        </div>

        <!-- Learning Section -->
        <div class="learning-section">
            <h2>What We Learned - Day 23</h2>
            
            <div class="learning-grid">
                <div class="learning-card">
                    <h3><i class="fas fa-mail-bulk"></i> Email Functions</h3>
                    <p>We learned about PHP's native mail() function and its configuration requirements for sending emails.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-shield-alt"></i> Email Security</h3>
                    <p>We implemented proper email validation and sanitization to prevent email injection attacks.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-code"></i> HTML Emails</h3>
                    <p>We explored creating HTML email templates and setting proper headers for HTML email support.</p>
                </div>
                
                <div class="learning-card">
                    <h3><i class="fas fa-exclamation-triangle"></i> Error Handling</h3>
                    <p>We implemented comprehensive error handling for various email sending scenarios.</p>
                </div>
            </div>
        </div>

        <!-- Enhanced Footer -->
        <div class="footer">
            <div class="footer-title">
                📚 PHP Learning Journey - Day 23
            </div>
            
            <div class="footer-dates">
                <p>Created on: May 20, 2025</p>
                <p>Last modified: <?= date("F j, Y g:i A") ?></p>
            </div>
            
            <div class="navigation">
                <a href="Day_22.php" class="nav-btn">← Day 22</a>
                <span class="day-counter">Day 23 of 25</span>
                <a href="Day_24.php" class="nav-btn">Day 24 →</a>
            </div>
            
            <div class="progress-section">
                <div class="progress-text">Journey Progress: 23/25 (92.00%)</div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="progress-percentage">92.00% Complete</div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="setupModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-cog"></i> Mail Server Configuration</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="config-step">
                    <h4>1. Configure php.ini</h4>
                    <pre><code>[mail function]
SMTP = localhost
smtp_port = 25
sendmail_from = your-email@domain.com</code></pre>
                </div>
                <div class="config-step">
                    <h4>2. Start Mail Server (XAMPP)</h4>
                    <ul>
                        <li>Open XAMPP Control Panel</li>
                        <li>Start Mercury (Mail Server)</li>
                        <li>Wait for the service to initialize</li>
                    </ul>
                </div>
                <div class="config-step">
                    <h4>3. Test Configuration</h4>
                    <p>Send a test email to verify your setup is working correctly.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for modal -->
    <script>
        function openModal() {
            document.getElementById('setupModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('setupModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('setupModal')) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
