<?php
// Start session at the very beginning to avoid headers already sent error
session_start();

/******************************************
 * PHP File Handling Tutorial - Day 21
 * This script demonstrates various file operations:
 * 1. Creating and writing to text files
 * 2. Reading from text files
 * 3. Uploading files
 * 4. Managing uploaded files
 ******************************************/

// Initialize variables we'll use throughout the script
$uploadMessage = "";  // Store success/error messages
$fileContent = "";    // Store content read from files
$maxFileSize = 5 * 1024 * 1024;  // Maximum file size (5MB = 5 * 1024 * 1024 bytes)

// Define which types of files are allowed to be uploaded
// MIME types for common file formats
$allowedTypes = [
    'image/jpeg',  // .jpg and .jpeg files
    'image/png',   // .png files
    'image/gif',   // .gif files
    'application/pdf',  // .pdf files
    'text/plain'   // .txt files
];

// Step 1: Create uploads directory if it doesn't exist, with writable fallback
// Prefer local project dir; if not writable (e.g., Railway immutable FS), fall back to system temp
$uploadsDir = __DIR__ . '/uploads';
$createdPrimary = true;
if(!is_dir($uploadsDir)) {
    // Suppress warnings and check result explicitly
    $createdPrimary = @mkdir($uploadsDir, 0755, true);
}

$canWrite = is_dir($uploadsDir) && is_writable($uploadsDir);

if(!$canWrite) {
    // Fallback to system temp directory
    $tempBase = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);
    $fallbackDir = $tempBase . DIRECTORY_SEPARATOR . 'php_uploads_day21';
    if(!is_dir($fallbackDir)) {
        @mkdir($fallbackDir, 0755, true);
    }
    if(is_dir($fallbackDir) && is_writable($fallbackDir)) {
        $uploadsDir = $fallbackDir;
        $canWrite = true;
        $uploadMessage .= "<div class='alert alert-success'>Using temporary writable folder: " . htmlspecialchars($uploadsDir) . "</div>";
    } else {
        $uploadMessage .= "<div class='alert alert-error'>Storage is read-only. File save/upload features are disabled on this environment.</div>";
    }
}

// Step 2: Handle saving text to file
// This happens when user clicks the "Save Text" button
if(isset($_POST['save_text'])) {
    $content = $_POST['file_content'];
    $mode = $_POST['file_mode'];  // Get selected mode
    
    // Choose file mode based on user selection
    switch($mode) {
        case 'write':
            // 'w' mode overwrites the entire file
            $fileMode = 'w';
            break;
        case 'append':
            // 'a' mode adds to the end of file
            $fileMode = 'a';
            break;
        default:
            $fileMode = 'w';  // Default to write mode
    }
    
    if($canWrite) {
        // Open file in selected mode
        $textFile = @fopen($uploadsDir . "/notes.txt", $fileMode);
        
        if($textFile) {
            // Add a timestamp to each entry
            $timestamp = date('Y-m-d H:i:s');
            $formattedContent = "[$timestamp] " . $content . "\n";
            
            fwrite($textFile, $formattedContent);
            fclose($textFile);
            
            // Show success message with mode info
            $uploadMessage .= "<div class='alert alert-success'>Text " . 
                ($mode == 'append' ? 'appended' : 'saved') . " successfully!</div>";
        } else {
            $uploadMessage .= "<div class='alert alert-error'>Error saving text. Please check file permissions.</div>";
        }
    } else {
        $uploadMessage .= "<div class='alert alert-error'>Cannot save text: storage is not writable in this environment.</div>";
    }
}

// Step 3: Read existing content from the text file
// This shows previously saved content in the textarea
if(file_exists($uploadsDir . "/notes.txt")) {
    // Open file in "read" mode
    $textFile = @fopen($uploadsDir . "/notes.txt", "r");
    
    if($textFile) {
        // filesize() gets the size of the file in bytes
        // fread() reads that many bytes from the file
        $size = filesize($uploadsDir . "/notes.txt");
        if($size > 0) {
            $fileContent = fread($textFile, $size);
        } else {
            $fileContent = '';
        }
        
        // Always close the file after using it
        fclose($textFile);
    }
}

// Step 4: Handle file uploads
// This happens when user clicks the "Upload File" button
if(isset($_POST['upload'])) {
    if(!$canWrite) {
        $uploadMessage .= "<div class='alert alert-error'>Uploads are disabled: storage is not writable in this environment.</div>";
    } else {
        // Check if a file was actually uploaded and there are no errors
        if(isset($_FILES['myfile']) && $_FILES['myfile']['error'] === 0) {
            // Get information about the uploaded file
            $myfile = $_FILES['myfile']['tmp_name'];  // Temporary location of uploaded file
            $filename = $_FILES['myfile']['name'];     // Original name of the file
            $filesize = $_FILES['myfile']['size'];     // Size in bytes
            $filetype = $_FILES['myfile']['type'];     // MIME type of the file
            
            // Check 1: Is the file too big?
            if($filesize > $maxFileSize) {
                $uploadMessage .= "<div class='alert alert-error'>File is too large. Maximum size is 5MB.</div>";
            }
            // Check 2: Is this type of file allowed?
            elseif(!in_array($filetype, $allowedTypes)) {
                $uploadMessage .= "<div class='alert alert-error'>Invalid file type. Allowed types: JPEG, PNG, GIF, PDF, TXT</div>";
            }
            else {
                // Generate a unique filename to prevent overwriting existing files
                // uniqid() creates a unique ID based on the current time
                $newFilename = uniqid() . '_' . $filename;
                
                // Move the uploaded file from temporary location to our uploads folder
                if(@move_uploaded_file($myfile, $uploadsDir . "/" . $newFilename)) {
                    $uploadMessage .= "<div class='alert alert-success'>File uploaded successfully!</div>";
                } else {
                    $uploadMessage .= "<div class='alert alert-error'>Error uploading file. Please try again.</div>";
                }
            }
        } else {
            $uploadMessage .= "<div class='alert alert-error'>Please select a file to upload.</div>";
        }
    }
}

// Step 5: Handle file deletion
// This happens when user clicks the "Delete" button
if(isset($_GET['delete'])) {
    $filename = $_GET['delete'];
    $filepath = $uploadsDir . "/" . $filename;
    
    // Security check: Make sure the file is in our uploads directory
    if(file_exists($filepath) && strpos(realpath($filepath), realpath($uploadsDir)) === 0) {
        if(@unlink($filepath)) {
            $_SESSION['message'] = "<div class='alert alert-success'>File deleted successfully!</div>";
        } else {
            $_SESSION['message'] = "<div class='alert alert-error'>Error deleting file.</div>";
        }
    } else {
        $_SESSION['message'] = "<div class='alert alert-error'>Invalid file.</div>";
    }
    
    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// This is used to display the list of files in the interface
$uploadedFiles = [];
if(is_dir($uploadsDir)) {
    // scandir() gets all files in a directory
    // array_diff() removes '.' and '..' which represent current and parent directories
    $scanned = @scandir($uploadsDir);
    if($scanned !== false) {
        $uploadedFiles = array_diff($scanned, array('.', '..'));
    }
}

// Check for messages in session
if(isset($_SESSION['message'])) {
    $uploadMessage = $_SESSION['message'] . $uploadMessage;
    // Clear the message from session immediately
    unset($_SESSION['message']);
}

/*********************************************
 * Common PHP File Functions Used:
 * 
 * fopen($filename, $mode) - Opens a file
 *   Modes: "r" (read), "w" (write), "a" (append)
 * 
 * fwrite($file, $content) - Writes to a file
 * 
 * fread($file, $length) - Reads from a file
 * 
 * fclose($file) - Closes a file
 * 
 * file_exists() - Checks if file/directory exists
 * 
 * mkdir() - Creates a directory
 * 
 * unlink() - Deletes a file
 * 
 * move_uploaded_file() - Moves uploaded file
 * 
 * scandir() - Lists files in directory
 *********************************************/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 21 - Advanced File Handling</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#4f46e5">
    <meta name="description" content="Day 21: Advanced PHP file handling - uploads, text editing, and more.">
    <meta property="og:title" content="PHP Learning Journey - Day 21">
    <meta property="og:description" content="Learn advanced file handling in PHP with uploads and editing.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://farhan-php-journey.up.railway.app/Day_21/index.php">
    <meta property="og:image" content="https://farhan-php-journey.up.railway.app/assets/product.png">
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
            max-width: 800px;
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

        .upload-container {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
            margin-bottom: 30px;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .file-input-wrapper input[type="file"] {
            display: none;
        }

        .file-input-trigger {
            display: block;
            padding: 30px;
            border: 2px dashed var(--gray);
            border-radius: var(--border-radius);
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .file-input-trigger:hover {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }

        .file-input-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .upload-btn {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            font-size: 1rem;
        }

        .upload-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .alert.fade-out {
            opacity: 0;
        }

        .alert-success {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }

        .files-list {
            margin-top: 40px;
        }

        .files-list h2 {
            color: var(--dark);
            margin-bottom: 20px;
        }

        .file-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            margin-bottom: 10px;
            box-shadow: var(--box-shadow);
        }

        .file-icon {
            font-size: 1.5rem;
            color: var(--primary);
            margin-right: 15px;
        }

        .file-name {
            flex-grow: 1;
            font-weight: 500;
        }

        .file-actions {
            display: flex;
            gap: 10px;
        }

        .file-action-btn {
            padding: 8px;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .download-btn {
            background-color: var(--info);
            color: var(--white);
        }

        .delete-btn {
            background-color: var(--error);
            color: var(--white);
        }

        .file-action-btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        /* Additional styles for text editor and learning cards */
        .text-editor {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            margin-bottom: 30px;
        }

        .text-editor textarea {
            width: 100%;
            min-height: 150px;
            padding: 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-family: 'Poppins', sans-serif;
            margin-bottom: 15px;
            resize: vertical;
        }

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
            padding: 20px;
            box-shadow: var(--box-shadow);
        }

        .card h3 {
            color: var(--primary);
            margin-top: 0;
            font-size: 1.2rem;
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
            font-style: italic;
        }

        .file-preview {
            margin-top: 20px;
            padding: 15px;
            background-color: var(--light);
            border-radius: var(--border-radius);
            font-family: monospace;
            white-space: pre-wrap;
        }

        .mode-selector {
            margin-bottom: 15px;
        }
        
        .mode-select {
            padding: 8px;
            border-radius: var(--border-radius);
            border: 1px solid var(--gray);
            font-family: 'Poppins', sans-serif;
            margin-left: 10px;
        }
        
        .file-content {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--gray);
        }
        
        .file-content h3 {
            color: var(--primary);
            margin-bottom: 15px;
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
            background-color: var(--primary-dark);
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
    </style>
</head>
<body>
    <div class="day-indicator">Day 21 of PHP</div>
    
    <div class="container">
        <div class="page-header">
            <h1>File Management System</h1>
            <p class="subtitle">Upload, manage and organize your files securely</p>
        </div>

        <!-- Wrap message in a container div -->
        <div id="messageContainer">
            <?php if($uploadMessage): ?>
                <?php echo $uploadMessage; ?>
            <?php endif; ?>
        </div>

        <!-- Text Editor Section with Mode Selection -->
        <div class="text-editor">
            <h2>Text Editor</h2>
            <form action="" method="POST">
                <!-- Add mode selection -->
                <div class="mode-selector">
                    <label>File Mode:</label>
                    <select name="file_mode" class="mode-select">
                        <option value="write">Write (Overwrite existing content)</option>
                        <option value="append">Append (Add to existing content)</option>
                    </select>
                </div>

                <textarea name="file_content" placeholder="Write your text here..."><?php 
                    // Only show content in textarea if we're in write mode
                    echo isset($_POST['file_mode']) && $_POST['file_mode'] == 'write' ? htmlspecialchars($fileContent) : ''; 
                ?></textarea>

                <button type="submit" name="save_text" class="upload-btn">
                    <i class="fas fa-save"></i> Save Text
                </button>
            </form>

            <!-- Show file content in a separate section -->
            <?php if($fileContent): ?>
            <div class="file-content">
                <h3>File Contents:</h3>
                <div class="file-preview">
                    <?php echo nl2br(htmlspecialchars($fileContent)); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- File Upload Section -->
        <div class="upload-container">
            <h2>File Upload</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="file-input-wrapper">
                    <label for="myfile" class="file-input-trigger">
                        <i class="fas fa-cloud-upload-alt file-input-icon"></i>
                        <p>Click to select file or drag and drop</p>
                        <span class="file-info">Maximum file size: 5MB</span>
                    </label>
                    <input type="file" name="myfile" id="myfile" accept=".jpg,.jpeg,.png,.gif,.pdf,.txt">
                </div>
                <button type="submit" name="upload" class="upload-btn">
                    <i class="fas fa-upload"></i> Upload File
                </button>
            </form>
        </div>

        <?php if(!empty($uploadedFiles)): ?>
        <div class="files-list">
            <h2>Uploaded Files</h2>
            <?php foreach($uploadedFiles as $file): ?>
            <div class="file-item">
                <i class="fas fa-file file-icon"></i>
                <span class="file-name"><?php echo htmlspecialchars($file); ?></span>
                <div class="file-actions">
                    <a href="uploads/<?php echo urlencode($file); ?>" class="file-action-btn download-btn" download>
                        <i class="fas fa-download"></i>
                    </a>
                    <button class="file-action-btn delete-btn" onclick="deleteFile('<?php echo htmlspecialchars($file); ?>')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Learning Section -->
        <div class="learning-section">
            <h2>Today's Learning Points</h2>
            <div class="learning-cards">
                <div class="card">
                    <h3>File Operations</h3>
                    <p>PHP provides various functions for file handling: fopen(), fread(), fwrite(), fclose(). The fopen() function opens a file in different modes like 'r' (read), 'w' (write), 'a' (append).</p>
                </div>
                <div class="card">
                    <h3>File Upload</h3>
                    <p>Files can be uploaded using HTML form with enctype="multipart/form-data". PHP's $_FILES superglobal array contains information about uploaded files, and move_uploaded_file() function moves them to desired location.</p>
                </div>
                <div class="card">
                    <h3>File Security</h3>
                    <p>Always validate file types, check file sizes, use secure file paths, and implement proper error handling when working with files to prevent security vulnerabilities.</p>
                </div>
                <div class="card">
                    <h3>Directory Handling</h3>
                    <p>PHP functions like mkdir(), scandir(), and is_dir() help manage directories. Always check directory permissions and handle errors when performing directory operations.</p>
                </div>
            </div>
        </div>

        <div class="date-stamp">
            <?php echo date('l, F j, Y'); ?>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 21
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 18, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="../Day_20.php" class="nav-btn">← Day 20</a>
            <span class="day-counter">Day 21 of 25</span>
            <a href="../Day_22.php" class="nav-btn">Day 22 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 21/25 (84.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 84.00%"></div>
            </div>
            <div class="progress-percentage">84.00% Complete</div>
        </div>
    </div>

    <script>
        // Preview selected file name
        document.getElementById('myfile').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'No file selected';
            const fileInfo = document.querySelector('.file-info');
            fileInfo.textContent = fileName;
        });

        // Handle file deletion
        function deleteFile(filename) {
            if(confirm('Are you sure you want to delete this file?')) {
                window.location.href = `delete.php?file=${encodeURIComponent(filename)}`;
            }
        }

        // Add auto-hide functionality for alerts
        document.addEventListener('DOMContentLoaded', function() {
            const messageContainer = document.getElementById('messageContainer');
            const alerts = messageContainer.getElementsByClassName('alert');
            
            if(alerts.length > 0) {
                // Wait 3 seconds, then start fade out
                setTimeout(function() {
                    for(let alert of alerts) {
                        alert.classList.add('fade-out');
                    }
                    // Remove the alert after fade out animation
                    setTimeout(function() {
                        messageContainer.innerHTML = '';
                    }, 500); // 500ms matches the CSS transition time
                }, 3000); // Show message for 3 seconds
            }
        });
    </script>
</body>
</html>