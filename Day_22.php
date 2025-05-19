<?php
/**
 * Day 22 - PHP Encoding & Decoding
 * This script demonstrates various encoding and decoding techniques in PHP
 * 
 * Learning Objectives:
 * 1. URL encoding and decoding
 * 2. HTML entity encoding
 * 3. Base64 encoding/decoding
 * 4. JSON encoding/decoding
 * 5. Character set encoding
 * 6. Security implications of encoding
 */

// Initialize variables for demonstrations
$originalText = "Hello World! This is a test with special characters: <>&\"'";
$urlText = "https://example.com/search?q=hello world&category=php programming";
$jsonData = [
    'name' => 'Farhan Alam',
    'email' => 'farhan@example.com',
    'skills' => ['PHP', 'JavaScript', 'MySQL'],
    'active' => true,
    'score' => 95.5
];
$binaryData = "This is some binary data that needs encoding";

// Process form submissions for interactive demonstrations
$encodingResults = [];
$userInput = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_input']) && !empty($_POST['user_input'])) {
        $userInput = $_POST['user_input'];
        
        // Perform various encoding operations
        $encodingResults = [
            'original' => $userInput,
            'url_encode' => urlencode($userInput),
            'html_encode' => htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8'),
            'base64_encode' => base64_encode($userInput),
            'json_encode' => json_encode($userInput),
            'md5_hash' => md5($userInput),
            'sha1_hash' => sha1($userInput)
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 22 - PHP Encoding & Decoding</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --info: #3b82f6;
            --warning: #f59e0b;
            --error: #ef4444;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .day-indicator {
            background-color: var(--primary-dark);
            color: var(--white);
            text-align: center;
            padding: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        h1 {
            color: var(--primary);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .demo-section {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .demo-section h2 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .demo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .demo-card {
            background-color: var(--light);
            border-radius: var(--border-radius);
            padding: 20px;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .demo-card h3 {
            color: var(--secondary);
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .code-block {
            background-color: var(--dark);
            color: var(--white);
            padding: 15px;
            border-radius: var(--border-radius);
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            margin: 10px 0;
        }

        .result-block {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
            padding: 15px;
            border-radius: var(--border-radius);
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            border-left: 4px solid var(--success);
            margin: 10px 0;
            word-break: break-all;
        }

        .interactive-form {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .btn {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            font-size: 16px;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .result-item {
            background-color: var(--light);
            padding: 15px;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--primary);
        }

        .result-item h4 {
            color: var(--primary);
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .result-item .result-value {
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            word-break: break-all;
            background-color: var(--white);
            padding: 8px;
            border-radius: 4px;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Learning section styles */
        .learning-section {
            margin-top: 60px;
            padding-top: 40px;
            border-top: 1px solid var(--gray);
        }

        .learning-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(79, 70, 229, 0.15);
        }

        .card h3 {
            color: var(--primary);
            margin-top: 0;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card p {
            color: var(--dark);
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .date-stamp {
            text-align: center;
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 40px;
        }

        .highlight {
            background-color: rgba(245, 158, 11, 0.2);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 500;
        }

        /* Footer styles */
        .footer {
            margin-top: 60px;
            padding: 30px 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            text-align: center;
        }

        .footer .title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .footer .dates {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .footer .navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .footer .nav-btn {
            padding: 8px 16px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .footer .nav-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .footer .day-counter {
            font-weight: 600;
            color: var(--dark);
            font-size: 1rem;
        }

        .footer .progress-section {
            margin-top: 20px;
        }

        .footer .progress-text {
            color: var(--dark);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .footer .progress-bar {
            width: 100%;
            max-width: 400px;
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 4px;
            margin: 0 auto;
            overflow: hidden;
        }

        .footer .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 4px;
            width: 88.00%;
            transition: width 0.5s ease;
        }

        .footer .progress-percentage {
            color: var(--primary);
            font-weight: 600;
            margin-top: 8px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="day-indicator">Day 22 of PHP</div>
    
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-code"></i> PHP Encoding & Decoding</h1>
            <p class="subtitle">Master various encoding techniques for data security, transmission, and storage</p>
        </div>

        <!-- Interactive Encoding Demo -->
        <div class="interactive-form">
            <h2><i class="fas fa-keyboard"></i> Interactive Encoding Demo</h2>
            <p>Enter any text below to see various encoding methods applied in real-time:</p>
            
            <form method="POST">
                <div class="form-group">
                    <label for="user_input">Your Text:</label>
                    <textarea name="user_input" id="user_input" rows="3" placeholder="Enter text to encode..." required><?= htmlspecialchars($userInput) ?></textarea>
                </div>
                <button type="submit" class="btn">
                    <i class="fas fa-magic"></i> Encode Text
                </button>
            </form>

            <?php if (!empty($encodingResults)): ?>
            <div class="results-grid">
                <div class="result-item">
                    <h4>Original Text</h4>
                    <div class="result-value"><?= htmlspecialchars($encodingResults['original']) ?></div>
                </div>
                <div class="result-item">
                    <h4>URL Encoded</h4>
                    <div class="result-value"><?= $encodingResults['url_encode'] ?></div>
                </div>
                <div class="result-item">
                    <h4>HTML Encoded</h4>
                    <div class="result-value"><?= htmlspecialchars($encodingResults['html_encode']) ?></div>
                </div>
                <div class="result-item">
                    <h4>Base64 Encoded</h4>
                    <div class="result-value"><?= $encodingResults['base64_encode'] ?></div>
                </div>
                <div class="result-item">
                    <h4>JSON Encoded</h4>
                    <div class="result-value"><?= htmlspecialchars($encodingResults['json_encode']) ?></div>
                </div>
                <div class="result-item">
                    <h4>MD5 Hash</h4>
                    <div class="result-value"><?= $encodingResults['md5_hash'] ?></div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- URL Encoding Demo -->
        <div class="demo-section">
            <h2><i class="fas fa-link"></i> URL Encoding</h2>
            <div class="demo-grid">
                <div class="demo-card">
                    <h3>URL Encoding</h3>
                    <div class="code-block">
$url = "<?= $urlText ?>";
echo urlencode($url);
                    </div>
                    <div class="result-block">
<?= urlencode($urlText) ?>
                    </div>
                </div>
                <div class="demo-card">
                    <h3>URL Decoding</h3>
                    <div class="code-block">
$encoded = "<?= urlencode($urlText) ?>";
echo urldecode($encoded);
                    </div>
                    <div class="result-block">
<?= urldecode(urlencode($urlText)) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- HTML Encoding Demo -->
        <div class="demo-section">
            <h2><i class="fas fa-shield-alt"></i> HTML Entity Encoding</h2>
            <div class="demo-grid">
                <div class="demo-card">
                    <h3>HTML Special Characters</h3>
                    <div class="code-block">
$text = "<?= $originalText ?>";
echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                    </div>
                    <div class="result-block">
<?= htmlspecialchars($originalText, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                </div>
                <div class="demo-card">
                    <h3>HTML Entity Decode</h3>
                    <div class="code-block">
$encoded = "<?= htmlspecialchars($originalText, ENT_QUOTES, 'UTF-8') ?>";
echo htmlspecialchars_decode($encoded, ENT_QUOTES);
                    </div>
                    <div class="result-block">
<?= htmlspecialchars_decode(htmlspecialchars($originalText, ENT_QUOTES, 'UTF-8'), ENT_QUOTES) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Base64 Encoding Demo -->
        <div class="demo-section">
            <h2><i class="fas fa-database"></i> Base64 Encoding</h2>
            <div class="demo-grid">
                <div class="demo-card">
                    <h3>Base64 Encode</h3>
                    <div class="code-block">
$data = "<?= $binaryData ?>";
echo base64_encode($data);
                    </div>
                    <div class="result-block">
<?= base64_encode($binaryData) ?>
                    </div>
                </div>
                <div class="demo-card">
                    <h3>Base64 Decode</h3>
                    <div class="code-block">
$encoded = "<?= base64_encode($binaryData) ?>";
echo base64_decode($encoded);
                    </div>
                    <div class="result-block">
<?= base64_decode(base64_encode($binaryData)) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- JSON Encoding Demo -->
        <div class="demo-section">
            <h2><i class="fas fa-brackets-curly"></i> JSON Encoding</h2>
            <div class="demo-grid">
                <div class="demo-card">
                    <h3>Array to JSON</h3>
                    <div class="code-block">
$data = <?= var_export($jsonData, true) ?>;
echo json_encode($data, JSON_PRETTY_PRINT);
                    </div>
                    <div class="result-block">
<?= json_encode($jsonData, JSON_PRETTY_PRINT) ?>
                    </div>
                </div>
                <div class="demo-card">
                    <h3>JSON to Array</h3>
                    <div class="code-block">
$json = '<?= json_encode($jsonData) ?>';
$decoded = json_decode($json, true);
print_r($decoded);
                    </div>
                    <div class="result-block">
<?php 
$decoded = json_decode(json_encode($jsonData), true);
echo "<pre>" . print_r($decoded, true) . "</pre>";
?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hashing Demo -->
        <div class="demo-section">
            <h2><i class="fas fa-fingerprint"></i> Hashing Functions</h2>
            <div class="demo-grid">
                <div class="demo-card">
                    <h3>MD5 Hash</h3>
                    <div class="code-block">
$text = "<?= $originalText ?>";
echo md5($text);
                    </div>
                    <div class="result-block">
<?= md5($originalText) ?>
                    </div>
                </div>
                <div class="demo-card">
                    <h3>SHA1 Hash</h3>
                    <div class="code-block">
$text = "<?= $originalText ?>";
echo sha1($text);
                    </div>
                    <div class="result-block">
<?= sha1($originalText) ?>
                    </div>
                </div>
                <div class="demo-card">
                    <h3>Password Hash</h3>
                    <div class="code-block">
$password = "mySecretPassword";
echo password_hash($password, PASSWORD_DEFAULT);
                    </div>
                    <div class="result-block">
<?= password_hash("mySecretPassword", PASSWORD_DEFAULT) ?>
                    </div>
                </div>
                <div class="demo-card">
                    <h3>SHA256 Hash</h3>
                    <div class="code-block">
$text = "<?= $originalText ?>";
echo hash('sha256', $text);
                    </div>
                    <div class="result-block">
<?= hash('sha256', $originalText) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Learning Section -->
        <div class="learning-section">
            <h2>Today's Learning Points</h2>
            <div class="learning-cards">
                <div class="card">
                    <h3><i class="fas fa-link"></i> URL Encoding</h3>
                    <p>We learned how to safely encode URLs using <span class="highlight">urlencode()</span> and <span class="highlight">urldecode()</span> functions to handle special characters in URLs and query parameters.</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-shield-alt"></i> HTML Entity Encoding</h3>
                    <p>We implemented XSS prevention using <span class="highlight">htmlspecialchars()</span> to convert special HTML characters into safe entities, protecting against code injection attacks.</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-database"></i> Base64 Encoding</h3>
                    <p>We explored Base64 encoding with <span class="highlight">base64_encode()</span> and <span class="highlight">base64_decode()</span> for safely transmitting binary data over text-based protocols.</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-brackets-curly"></i> JSON Encoding</h3>
                    <p>We mastered JSON data interchange using <span class="highlight">json_encode()</span> and <span class="highlight">json_decode()</span> for API communication and data storage.</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-fingerprint"></i> Hashing Functions</h3>
                    <p>We implemented various hashing algorithms including MD5, SHA1, SHA256, and secure password hashing using <span class="highlight">password_hash()</span> for data integrity and security.</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-lock"></i> Security Best Practices</h3>
                    <p>We learned when and why to use different encoding methods, understanding their security implications and proper use cases in web development.</p>
                </div>
            </div>
        </div>

        <!-- Enhanced Footer -->
        <div class="footer">
            <div class="title">
                📚 PHP Learning Journey - Day 22
            </div>
            
            <div class="dates">
                <p style="margin: 5px 0;">Created on: May 19, 2025</p>
                <p style="margin: 5px 0;">Last modified: <?= date("F j, Y g:i A") ?></p>
            </div>
            
            <div class="navigation">
                <a href="Day_21/index.php" class="nav-btn">← Day 21</a>
                <span class="day-counter">Day 22 of 25</span>
                <a href="Day_23.php" class="nav-btn">Day 23 →</a>
            </div>
            
            <div class="progress-section">
                <div class="progress-text">Journey Progress: 22/25 (88.00%)</div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 88.00%"></div>
                </div>
                <div class="progress-percentage">88.00% Complete</div>
            </div>
        </div>
    </div>
</body>
</html>