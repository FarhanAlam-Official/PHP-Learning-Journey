<?php 
    include 'db.php';
    $conn = db(); // Call the db() function to get the connection object
    $query = "SELECT * FROM `products`";
    $result = $conn->query($query);
    $products = [];
    if($result && $result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 17 of PHP - E-Commerce Product Display</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: rgba(79, 70, 229, 0.1);
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --dark: #1e293b;
            --light: #f8fafc;
            --white: #ffffff;
            --gray: #94a3b8;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        
        /* Day indicator at the top of the page */
        .day-indicator {
            background-color: var(--primary-dark);
            color: var(--white);
            text-align: center;
            padding: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }
        
        /* Enhanced Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .nav-container {
            max-width: 1500px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .logo-icon {
            color: var(--primary);
            font-size: 1.8rem;
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark);
            letter-spacing: -0.5px;
        }
        
        .logo-text span {
            color: var(--primary);
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.active {
            color: var(--primary);
            font-weight: 600;
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-icons {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        
        .nav-icon {
            color: var(--dark);
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        
        .nav-icon:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary);
            color: var(--white);
            font-size: 0.7rem;
            font-weight: 600;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--dark);
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        /* Enhanced Store Header */
        .store-header {
            background: linear-gradient(135deg, #4f46e5 0%, #0ea5e9 100%);
            color: var(--white);
            padding: 80px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .store-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') center/cover;
            opacity: 0.15;
            z-index: 1;
        }
        
        .header-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .store-title {
            margin: 0;
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: -1px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }
        
        .store-subtitle {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 400;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        .header-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .header-btn {
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .header-btn-primary {
            background-color: var(--white);
            color: var(--primary);
        }
        
        .header-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header-btn-secondary {
            background-color: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }
        
        .header-btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }
        
        /* Product section enhancements */
        .products-section {
            padding: 80px 20px;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 60px;
            position: relative;
            font-weight: 700;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Four products per row */
            gap: 30px;
            max-width: 1500px; /* Increased to 1500px */
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .product-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-width: 300px; /* Increased minimum width */
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .product-image {
            height: 240px; /* Increased height */
            overflow: hidden;
            position: relative;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-info {
            padding: 25px;
        }
        
        .product-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
            margin-top: 0;
            margin-bottom: 15px;
        }
        
        /* Product description styles - completely revised */
        .product-description {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 15px;
            line-height: 1.5;
            position: relative;
            overflow: hidden;
            transition: max-height 0.5s ease;
            max-height: 3em;
        }

        .product-description-full {
            display: none;
        }

        .product-description-toggle {
            color: var(--primary);
            font-weight: 500;
            font-size: 0.85rem;
            cursor: pointer;
            display: inline-block;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .product-description-toggle:hover {
            text-decoration: underline;
        }
        
        .product-price {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.4rem;
            margin-bottom: 20px;
        }
        
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            flex-grow: 1;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
            margin-left: 10px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 50%;
        }
        
        .btn-outline:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }
        
        /* No products message */
        .no-products {
            text-align: center;
            padding: 40px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .no-products h3 {
            color: var(--dark);
            margin-bottom: 10px;
        }
        
        .no-products p {
            color: var(--gray);
        }
        
        /* Learning section styles */
        .learning-section {
            margin-top: 60px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .learning-title {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }
        
        .learning-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary-light);
            border-radius: 2px;
        }
        
        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .learning-card {
            background-color: var(--primary-light);
            border-radius: var(--border-radius);
            padding: 20px;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }
        
        .learning-card h3 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .learning-card p {
            margin: 0;
            color: var(--dark);
            font-size: 0.95rem;
        }
        
        /* Footer */
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
            margin-bottom: 20px;
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
        
        /* Responsive adjustments */
        @media (max-width: 1500px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr); /* Three products per row on medium screens */
                gap: 25px;
            }
        }
        
        @media (max-width: 1100px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr); /* Two products per row on smaller screens */
                gap: 20px;
            }
            
            .store-title {
                font-size: 2.4rem;
            }
        }
        
        @media (max-width: 700px) {
            .store-title {
                font-size: 2rem;
            }
            
            .store-subtitle {
                font-size: 1.1rem;
            }
            
            .products-grid {
                grid-template-columns: 1fr; /* One product per row on mobile */
                gap: 20px;
                padding: 0 10px;
            }
            
            .product-image {
                height: 220px;
            }
            
            .learning-grid {
                grid-template-columns: 1fr;
            }
            
            .section-title {
                font-size: 1.6rem;
                margin-bottom: 30px;
            }
        }
        
        /* Responsive adjustments for navbar */
        @media (max-width: 900px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Day indicator at the top of the page -->
    <div class="day-indicator">Day 17 of PHP Learning Journey</div>
    
    <!-- Enhanced Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-shopping-bag logo-icon"></i>
                <div class="logo-text">Tech<span>Hub</span></div>
            </a>
            
            <div class="nav-links">
                <a href="#" class="nav-link active">Home</a>
                <a href="#" class="nav-link">Products</a>
                <a href="#" class="nav-link">Categories</a>
                <a href="#" class="nav-link">Deals</a>
                <a href="#" class="nav-link">About</a>
            </div>
            
            <div class="nav-icons">
                <div class="nav-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="nav-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="nav-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="nav-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">3</span>
                </div>
            </div>
            
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    
    <!-- Enhanced Store Header -->
    <header class="store-header">
        <div class="header-content">
            <h1 class="store-title">Premium Product Showcase</h1>
            <p class="store-subtitle">Discover our curated collection of high-quality tech products. From smartphones to laptops, we offer the best devices at competitive prices.</p>
            
            <div class="header-buttons">
                <button class="header-btn header-btn-primary">
                    <i class="fas fa-shopping-cart"></i> Shop Now
                </button>
                <button class="header-btn header-btn-secondary">
                    <i class="fas fa-info-circle"></i> Learn More
                </button>
            </div>
        </div>
    </header>
    
    <!-- Products Section -->
    <section class="products-section">
        <h2 class="section-title">Featured Products</h2>
        
        <?php if(empty($products)): ?>
            <div class="no-products">
                <h3>No products found</h3>
                <p>There are currently no products available in our catalog.</p>
            </div>
        <?php else: ?>
            <div class="products-grid">
                <?php foreach($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><?= htmlspecialchars($product['product_name']) ?></h3>
                            <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
                            <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                            <div class="btn-container">
                                <button class="btn btn-primary">Add to Cart</button>
                                <button class="btn btn-outline">♡</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    
    <!-- Learning Section -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 17</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>Database Abstraction</h3>
                <p>We created a reusable database connection function in a separate file, making our code more modular and maintainable.</p>
            </div>
            
            <div class="learning-card">
                <h3>File Inclusion</h3>
                <p>We used PHP's include statement to import the database connection function from an external file, promoting code reusability.</p>
            </div>
            
            <div class="learning-card">
                <h3>Product Display</h3>
                <p>We implemented a responsive product grid layout with hover effects and truncated descriptions for a professional e-commerce look.</p>
            </div>
            
            <div class="learning-card">
                <h3>CSS Grid & Flexbox</h3>
                <p>We combined CSS Grid for the overall layout and Flexbox for individual product cards to create a responsive design.</p>
            </div>
            
            <div class="learning-card">
                <h3>Error Handling</h3>
                <p>We added proper error handling for database connections and queries, displaying user-friendly status messages.</p>
            </div>
            
            <div class="learning-card">
                <h3>Resource Management</h3>
                <p>We ensured proper resource management by closing the database connection after completing all operations.</p>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 17
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 13, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_16.php" class="nav-btn">← Day 16</a>
            <span class="day-counter">Day 17 of 25</span>
            <a href="Day_18.php" class="nav-btn">Day 18 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 17/25 (68.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 68.00%"></div>
            </div>
            <div class="progress-percentage">68.00% Complete</div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Process each product card
            document.querySelectorAll('.product-card').forEach(card => {
                const description = card.querySelector('.product-description');
                const fullText = description.textContent;
                
                // Create short version (first 100 characters)
                const shortText = fullText.length > 100 ? 
                    fullText.substring(0, 100) + '...' : 
                    fullText;
                
                // Set short text as initial content
                description.textContent = shortText;
                
                // Create toggle button
                const toggle = document.createElement('span');
                toggle.className = 'product-description-toggle';
                toggle.textContent = 'Read more';
                
                // Only add toggle if text is long enough to truncate
                if (fullText.length > 100) {
                    // Insert toggle after description
                    description.parentNode.insertBefore(toggle, description.nextSibling);
                    
                    // Add click handler
                    toggle.addEventListener('click', function() {
                        if (description.textContent === shortText) {
                            description.textContent = fullText;
                            toggle.textContent = 'Show less';
                            description.style.maxHeight = '1000px';
                        } else {
                            description.textContent = shortText;
                            toggle.textContent = 'Read more';
                            description.style.maxHeight = '3em';
                        }
                    });
                }
            });
            
            // Mobile menu toggle
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const navLinks = document.querySelector('.nav-links');
            
            if (mobileMenuBtn && navLinks) {
                mobileMenuBtn.addEventListener('click', function() {
                    navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
                });
            }
        });
    </script>
</body>
</html>
