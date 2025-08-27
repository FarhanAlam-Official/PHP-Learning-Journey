<?php
// Standalone Learning Path page (shares header styles and footer from index)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Path • PHP Journey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php // Quick reuse: pull styles by including head from index via minimal duplication ?>
    <?php
    // Extract shared CSS by reading index.php between <style> tags (simple reuse without refactor)
    $index = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('/<style>([\s\S]*?)<\/style>/', $index, $m)) {
        echo '<style>' . $m[1] . '</style>';
    }
    ?>
</head>

<body>
    <?php
    function getDayFiles()
    {
        $allFiles = glob("Day_*.php");
        $mainDayFiles = array_filter($allFiles, function ($file) { return preg_match('/^Day_\d+\.php$/', $file); });
        sort($mainDayFiles, SORT_NATURAL);
        return $mainDayFiles;
    }
    $dayFiles = getDayFiles();
    $totalDays = count($dayFiles);
    ?>

    <!-- Top Nav (link Path points here) -->
    <nav class="top-nav" id="topnav">
        <div class="top-nav-inner">
            <a href="./index.php#overview" class="brand">
                <span class="brand-name">PHP <strong>Journey</strong></span>
            </a>
            <div class="nav-area">
                <div class="nav-links" aria-label="Primary">
                    <a href="./index.php#overview">Overview</a>
                    <a href="./index.php#progress">Progress</a>
                    <a href="./index.php#days">Days</a>
                    <a href="./path.php">Path</a>
                    <a class="link-btn" href="https://github.com/FarhanAlam-Official" target="_blank" rel="noopener noreferrer">GitHub</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="page-wrapper">
        <?php include __DIR__ . '/includes/learning_path.php'; ?>

        <footer class="footer">
            <div class="footer-inner">
                <div class="footer-left">
                    <div>Last updated: <?php echo date("F j, Y"); ?></div>
                    <div>PHP Learning Journey — Building skills one day at a time</div>
                </div>
                <div class="footer-right">
                    <span class="credit">Made with <span aria-hidden="true">❤️</span> by <a href="https://github.com/FarhanAlam-Official" target="_blank" rel="noopener noreferrer">Farhan Alam</a></span>
                </div>
            </div>
        </footer>
    </div>

    <script>
        (function() {
            // Sticky nav state (copied behavior)
            var nav = document.getElementById('topnav');
            var onScroll = function() { if (window.scrollY > 8) nav.classList.add('is-scrolled'); else nav.classList.remove('is-scrolled'); };
            onScroll();
            window.addEventListener('scroll', onScroll);

            // Encouragement modal messages by milestone
            var messages = {
                'PHP Basics': {
                    title: 'Solid Foundations! 🎉',
                    body: 'You mastered the essentials—this is where real progress starts. Keep that curiosity burning!'
                },
                'Functions': {
                    title: 'Reusable Mindset ⚙️',
                    body: 'Thinking in functions means you think like a builder. Your future self will thank you.'
                },
                'OOP in PHP': {
                    title: 'Leveling Up to OOP 🧠',
                    body: 'You\'re organizing complexity like a pro. Classes and objects are your new superpowers.'
                },
                'Working with Databases': {
                    title: 'Data Whisperer 📊',
                    body: 'Talking to databases unlocks real apps. You\'re building things that matter.'
                },
                'Building Projects': {
                    title: 'From Theory to Reality 🚀',
                    body: 'Shipping projects is how devs grow. Every project sharpens your instincts.'
                },
                'Frameworks (Laravel)': {
                    title: 'Framework Flight 🛫',
                    body: 'You\'re ready to soar with modern tooling. Laravel will multiply your speed and confidence.'
                }
            };

            // Create modal once
            var modal = document.createElement('div');
            modal.className = 'dialog-backdrop open';
            modal.style.display = 'none';
            modal.innerHTML = '<div class="dialog"><h4 id="encTitle">Keep going!</h4><p id="encBody">You are doing great.</p><div class="dialog-actions"><button class="close-btn" id="encClose">Close</button></div></div>';
            document.body.appendChild(modal);
            var encTitle = modal.querySelector('#encTitle');
            var encBody = modal.querySelector('#encBody');
            var encClose = modal.querySelector('#encClose');

            document.querySelectorAll('.tl-btn-primary').forEach(function(btn){
                btn.addEventListener('click', function(){
                    var milestone = btn.getAttribute('data-encouragement') || 'Milestone';
                    var msg = messages[milestone] || { title: 'Great job! ✨', body: 'Small steps compound into mastery. Keep going—future you approves.' };
                    encTitle.textContent = msg.title;
                    encBody.textContent = msg.body;
                    modal.style.display = 'flex';
                    modal.setAttribute('aria-hidden', 'false');
                });
            });

            modal.addEventListener('click', function(e){
                if (e.target === modal || e.target === encClose) {
                    modal.style.display = 'none';
                    modal.setAttribute('aria-hidden', 'true');
                }
            });
        })();
    </script>
</body>

</html>

