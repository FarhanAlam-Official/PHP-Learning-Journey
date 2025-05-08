<style>
    /* Footer styles */
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

<div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 13
        </div>
        
        <div class="footer-dates">
            <p style="margin: 5px 0;">Created on: May 8, 2025</p>
            <p style="margin: 5px 0;">Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="../Day_12/index.php" class="nav-btn">← Day 12</a>
            <span class="day-counter">Day 13 of 25</span>
            <a href="../Day_14.php" class="nav-btn">Day 14 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 13/25 (52.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 52.00%"></div>
            </div>
            <div class="progress-percentage">52.00% Complete</div>
        </div>
    </div>