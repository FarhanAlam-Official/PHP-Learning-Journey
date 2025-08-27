# PHP Learning Journey (25 Days)

A modern, styled portfolio of 25 days of PHP learning covering fundamentals, forms, sessions, cookies, database work, CRUD, file management, encoding/decoding, email, API concepts and more. The homepage provides an overview, progress tracking, and quick access to each day. A separate Learning Path page visualizes milestones and offers encouragement messages.

## Highlights
- Modern UI with semantic HTML/CSS and responsive layout
- Sticky header, full-viewport hero, progress bars, cards and grids
- Dedicated Learning Path page (`path.php`) with a timeline experience
- File management demo (`Day_21`) using uploads directory
- Organized day-by-day files: `Day_1.php` … `Day_25.php`, and mini-app subfolders

## Requirements
- XAMPP (Apache + PHP + MySQL)
- PHP 8.x recommended (PHP 7.4+ should work)
- MySQL 5.7+/MariaDB (bundled with XAMPP)
- Browser: latest Chrome/Firefox/Edge/Safari

## Quick Start (Local, XAMPP)
1. Place this project folder inside your XAMPP htdocs (e.g. `C:\xampp\htdocs\PHP`).
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Import the database (if provided):
   - Open phpMyAdmin → create a database (e.g. `php_journey`).
   - Import `database.sql` (if included) into that database.
4. Configure DB connection:
   - Create (or edit) `db.php` at the project root with your local credentials:
     ```php
     <?php
     $host = 'localhost';
     $user = 'root';        // XAMPP default
     $pass = '';            // XAMPP default on Windows is empty
     $name = 'php_journey'; // your database name
     $conn = new mysqli($host, $user, $pass, $name);
     if ($conn->connect_error) {
         die('Database connection failed: ' . $conn->connect_error);
     }
     ?>
     ```
   - If you don’t need DB-backed days, you can skip this step; affected days will show an error message if the DB is not configured.
5. Ensure `uploads/` folder exists and is writable (for `Day_21`).
6. Visit `http://localhost/PHP/` in your browser. The Learning Path is at `http://localhost/PHP/path.php`.

## Project Structure
- `index.php` — Landing page with overview, stats, days grid, and site styles/scripts
- `path.php` — Standalone Learning Path page (same header/footer styling)
- `includes/learning_path.php` — Timeline section markup (used by `path.php`)
- `Day_N.php` — Top-level day files (1–25)
- `Day_10/`, `Day_12/`, `Day_13/`, `Day_16/`, `Day_19/`, `Day_21/` — Multi-file day demos
- `assets/` — Images used by day demos and landing page
- `uploads/` — Runtime upload directory for file demos (safe to clear)
- `db.php` — Local database credentials (not versioned for security; create locally)

## What Uses the Database?
- `Day_14` – Database connection
- `Day_15` – Database queries
- `Day_16` – CRUD operations (with subpages)
- `Day_17` – Product database
- `Day_19` – User management (with subpages)
- `Day_20` – Advanced CRUD
- `Day_21` – File management (uses filesystem; DB optional depending on your setup)

If you don’t import the database, these days will not function fully. The rest of the days (forms, sessions, cookies, etc.) generally work without a DB.

## Rebuilding the Database (If No SQL Provided)
If `database.sql` isn’t included or you need to recreate it:
1. On your dev machine, open phpMyAdmin, select the database, and use Export → Quick → SQL → save as `database.sql` in the project root.
2. Share `database.sql` with the project. Your reviewer can then import it following the Quick Start steps.

## Troubleshooting
- White screen/DB errors on DB days: check `db.php` credentials; ensure MySQL is running; ensure the database has been imported.
- File upload errors: confirm `uploads/` exists and is writable by PHP/Apache.
- Asset paths broken: ensure the project folder name matches your URL path (e.g. `PHP/`).
- PHP version differences: If using older PHP (≤7.3), enable error reporting to identify any compatibility issues.

## Reviewer Notes
- The UI intentionally shows a polished landing and a dedicated Learning Path to contextualize the 25‑day journey.
- Navigation: Overview, Progress, Days on `index.php`; Learning Path on `path.php`.
- Code is self-contained; no external build steps are required.

## License
This project is shared for educational/review purposes. You may adapt it for learning, personal use, or coursework submissions.
