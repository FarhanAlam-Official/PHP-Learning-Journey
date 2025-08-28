# PHP Learning Journey (25 Days)

[![PHP Version](https://img.shields.io/badge/PHP-8.x-blue?logo=php)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-Educational-green.svg)](#-license)
[![Deploy on Railway](https://img.shields.io/badge/Deploy-Railway-purple?logo=railway&logoColor=white)](https://railway.app/)

[![GitHub Stars](https://img.shields.io/github/stars/FarhanAlam-Official/php-learning-journey?style=social)](https://github.com/FarhanAlam-Official/php-learning-journey/stargazers)
[![GitHub Forks](https://img.shields.io/github/forks/FarhanAlam-Official/php-learning-journey?style=social)](https://github.com/FarhanAlam-Official/php-learning-journey/network/members)
[![GitHub Issues](https://img.shields.io/github/issues/FarhanAlam-Official/php-learning-journey)](https://github.com/FarhanAlam-Official/php-learning-journey/issues)

A **modern 25-day guided journey through PHP** — from fundamentals to forms, sessions, cookies, MySQL, CRUD, file handling, and more.  
This project is both a **learning reference** and a **deployable showcase**, designed to run locally, via Docker, or on Railway.

## ✨ Features
- Responsive UI with **cards, grids, progress bars, and sticky indicators**
- **Centralized `<head>` include** for favicons, manifest, and SEO assets
- SEO ready: `robots.txt`, `sitemap.xml`, `site.webmanifest`
- File handling demos with **safe fallbacks** for read-only filesystems (`Day_21`)
- Clean and extensible **database helper** (`db.php`) with support for Local, Docker, and Railway environments

## 🧰 Tech Stack
- PHP 8.x (7.4+ generally works)
- MySQL/MariaDB
- Vanilla HTML/CSS (no build step)

## 🗂️ Project Structure
```

├── index.php              # Landing page (overview & days grid)
├── path.php               # Learning Path timeline
├── includes/
│   ├── head.php           # Centralized <head> (favicons, manifest, theme-color)
│   └── learning_path.php  # Learning Path section
├── Day_1.php … Day_25.php # Day pages (some with folders for demos)
│   ├── Day_10/
│   ├── Day_12/
│   ├── Day_13/
│   ├── Day_16/
│   ├── Day_19/
│   └── Day_21/
├── assets/                # Images for demos and landing
├── favicon/               # Complete favicon set + manifest
├── uploads/               # Runtime uploads (safe to clear)
├── database.sql           # Sample database
├── robots.txt
├── sitemap.xml
└── site.webmanifest

```

## 🖼️ Favicons & Manifest
Favicons live in `/favicon`. To include on a page:  

- **Root pages:**  
  ```php
  <?php include __DIR__ . '/includes/head.php'; ?>
  ```

- **Subfolders (e.g., Day_21):**

  ```php
  <?php include __DIR__ . '/../includes/head.php'; ?>
  ```

## 🧑‍💻 Local Setup (XAMPP)
1. Copy this folder to `C:\xampp\htdocs\PHP` (or similar).
2. Start Apache and MySQL in XAMPP.
3. Create DB and import `database.sql` (phpMyAdmin → Import) if you plan to use DB‑backed days.
4. DB config is automatic via `db.php` for Local (defaults to host `localhost`, user `root`, empty password, DB `php_journey`).
5. Ensure `uploads/` exists. Visit `http://localhost/PHP/`.

## 🐳 Run with Docker

The repo includes a ready-to-use **Dockerfile** and **docker-compose.yml**.

**Start services:**

```bash
docker compose up --build
```

* App: [http://localhost:8080](http://localhost:8080)
* MySQL: `localhost:3307`

MySQL auto-seeds using `database.sql`.

## ☁️ Deploy on Railway

`db.php` supports Railway’s environment variables automatically.

1. Add a **MySQL service** in Railway.
2. In your PHP service settings → Variables, add values from DB service “Connect” tab:

   * `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`, `MYSQLPORT`
3. Deploy PHP service.
4. Import `database.sql` using any MySQL client.

## ☁️ Railway Deployment
`db.php` supports Railway environment variables. Recommended approach:
1. Add a MySQL service in Railway.
2. In your PHP service Variables, add the MySQL env vars (copy from the DB service Connect tab):
   - `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`, `MYSQLPORT` (3306)
3. Deploy; import `database.sql` using your preferred MySQL client.

Notes:
- `Day_21` uses a safe temp‑dir fallback if the project filesystem is read‑only.
- Centralized head include ensures favicons work across all pages.

## 📚 Database-Backed Lessons

* **Day_14** — DB connectivity
* **Day_15** — Basic queries
* **Day_16** — CRUD (multi-page demo)
* **Day_17** — Products
* **Day_19** — User management (multi-page demo)
* **Day_20** — Advanced CRUD

> ⚠️ If the database isn’t imported, these pages will gracefully show empty states or fallback messages.

## 🔎 Troubleshooting
- DB errors: confirm vars/credentials and that the DB is reachable; import `database.sql`.
- Upload errors: ensure `uploads/` exists; on Railway a temp fallback path is used automatically.
- Missing favicons: ensure pages include `includes/head.php` (use correct path based on folder).
- “Headers already sent” with sessions: call `session_start()` before any output.

## 🔧 Maintenance
- Centralize future `<head>` edits in `includes/head.php`.
- Add new pages to `sitemap.xml` for better SEO.
- Keep `robots.txt` pointing to the correct sitemap URL.

## 📄 License
Educational project. Free to adapt for learning, personal use, and coursework.
