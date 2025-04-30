<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 6 of PHP - Product Showcase</title>
    <!-- Google Fonts integration for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* 
        * CSS Variables (Custom Properties)
        * Defining a color palette makes it easy to maintain consistent colors
        * and quickly change the theme by updating these variables
        */
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
        
        /* 
        * Base Styles
        * Setting up the overall page appearance with a clean background
        * and consistent typography
        */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 30px;
            padding-top: 60px; /* Adjusted for fixed header */
            color: var(--dark);
            min-height: 100vh;
        }
        
        /* Day Indicator styles */
        .day-indicator {
            background-color: var(--primary-dark);
            color: white;
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
        
        /* 
        * Page Header Styles
        * Centered content with proper spacing for the main heading area
        */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        /* 
        * Heading Styles
        * Clean, professional heading with primary color
        */
        h1 {
            font-weight: 600;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        /* Subtitle styling for additional context below the main heading */
        .subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* 
        * Product Grid Layout
        * Using CSS Grid for a responsive layout that adjusts based on screen size
        * The repeat(4, 1fr) creates 4 equal columns on desktop
        */
        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 cards in desktop mode */
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* 
        * Product Card Styling
        * Each product is contained in a card with consistent styling
        * Using flexbox for the internal layout of each card
        */
        .product-container {
            display: flex;
            flex-direction: column;
            height: 380px;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: var(--white);
            border: 1px solid #e2e8f0;
            box-shadow: var(--box-shadow);
        }
        
        /* 
        * Hover Effects
        * Interactive elements improve user experience by providing visual feedback
        * The transform property creates a "lift" effect on hover
        */
        .product-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: rgba(79, 70, 229, 0.3);
        }
        
        /* 
        * Image Container
        * This is the outer container that controls the dimensions and overflow
        * of the product image
        */
        .image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        /* 
        * Image Styling
        * Using absolute positioning to fill the container
        * The background-size: cover ensures the image fills the space without distortion
        */
        .image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: transform 0.5s ease;
        }
        
        /* 
        * Image Hover Effect
        * Scale transform creates a zoom effect when hovering over the product
        */
        .product-container:hover .image {
            transform: scale(1.1);
        }
        
        /* 
        * Product Content Area
        * Using flexbox for layout with flex-grow to fill available space
        */
        .card-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        /* Product title styling */
        h4 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: var(--dark);
            font-weight: 500;
        }
        
        /* 
        * Product description styling
        * Using flex-grow: 1 ensures the description takes up available space
        * and pushes the price to the bottom
        */
        p {
            margin-bottom: 15px;
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.4;
            flex-grow: 1;
        }
        
        /* 
        * Price Container
        * Using flexbox to place the price and button on opposite sides
        */
        .price {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        /* Price tag styling */
        .price-tag {
            display: inline-block;
        }
        
        /* 
        * Button Styling
        * Creating an attractive call-to-action button with hover effects
        */
        .btn {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        /* Button hover effect */
        .btn:hover {
            background-color: var(--primary-dark);
        }
        
        /* 
        * Footer Styling
        * Simple centered footer with a subtle top border
        */
        .footer {
            text-align: center;
            margin-top: 60px;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
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
        }        /* 
        * Category Filter Styles
        * Styling for the category filter buttons
        */
        .filter-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .filter-btn {
            background-color: var(--white);
            color: var(--dark);
            border: 1px solid #e2e8f0;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background-color: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }
        
        /* 
        * Search Bar Styles
        * Styling for the product search functionality
        */
        .search-container {
            max-width: 500px;
            margin: 0 auto 30px;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 20px;
            border-radius: 30px;
            border: 1px solid #e2e8f0;
            background-color: var(--white);
            color: var(--dark);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(79, 70, 229, 0.2);
        }
        
        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }
        
        /* 
        * Learning Section Styles
        * Styling for the "What We Learned" section
        */
        .learning-section {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 30px;
            margin: 60px auto 0;
            max-width: 1200px;
            border: 1px solid #e2e8f0;
            box-shadow: var(--box-shadow);
        }
        
        .learning-title {
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
            margin-bottom: 15px;
            font-size: 1.2rem;
        }
        
        .learning-card ul {
            padding-left: 20px;
            color: var(--dark);
        }
        
        .learning-card li {
            margin-bottom: 8px;
        }
        
        /* 
        * Badge Styles
        * For displaying sale or new product badges
        */
        .badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 1;
        }
        
        .badge-sale {
            background-color: var(--warning);
            color: white;
        }
        
        .badge-new {
            background-color: var(--success);
            color: white;
        }
        
        /* 
        * Responsive Design
        * Media queries adjust the layout based on screen size
        * This ensures the design works well on all devices
        */
        @media (max-width: 1200px) {
            .container {
                grid-template-columns: repeat(3, 1fr); /* 3 cards on medium screens */
            }
        }
        
        @media (max-width: 900px) {
            .container {
                grid-template-columns: repeat(2, 1fr); /* 2 cards on smaller screens */
            }
        }
        
        @media (max-width: 600px) {
            body {
                padding: 15px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .container {
                grid-template-columns: 1fr; /* 1 card on mobile */
                gap: 15px;
            }
        }
    </style>
</head>
<body>
        <div class="day-indicator">Day 6 of PHP Learning Journey</div>
    
    <?php
    /*
     * DAY 6 LEARNING OBJECTIVES:
     * 
     * 1. Working with Associative Arrays
     *    - Creating and accessing associative arrays
     *    - Using arrays to store product information
     *    - Nesting arrays for complex data structures
     * 
     * 2. PHP Loops for Dynamic Content
     *    - Using foreach loops to iterate through product arrays
     *    - Generating HTML content dynamically based on data
     * 
     * 3. PHP with CSS Integration
     *    - Using PHP variables within inline CSS
     *    - Dynamic styling based on product properties
     * 
     * 4. Responsive Web Design with PHP
     *    - Creating a responsive product grid
     *    - Adapting layout for different screen sizes
     * 
     * 5. Product Filtering and Categorization
     *    - Implementing category filters
     *    - Filtering products based on user selection
     * 
     * 6. Search Functionality
     *    - Adding a search bar to filter products
     *    - Using PHP to match search queries with product data
     */
    
    // PHP Array of Products
    // This is an associative array containing product information
    // Each product is an array with keys for name, price, short_description, image, category, and badge
    $products = [
        [
            "name" => "Luxury Soap",
            "price" => 400,
            "short_description" => "Handcrafted with natural ingredients for a refreshing experience",
            "image" => "./assets/soap.jpg",
            "category" => "soap",
            "badge" => "new"
        ],
        [
            "name" => "Organic Shampoo",
            "price" => 550,
            "short_description" => "Made with organic extracts for healthy, shiny hair",
            "image" => "./assets/shampoo.jpg",
            "category" => "hair",
            "badge" => ""
        ],
        [
            "name" => "Face Wash",
            "price" => 350,
            "short_description" => "Gentle cleansing formula suitable for all skin types",
            "image" => "./assets/facewash.webp",
            "category" => "face",
            "badge" => ""
        ],
        [
            "name" => "Body Lotion",
            "price" => 480,
            "short_description" => "24-hour hydration with aloe vera and shea butter",
            "image" => "./assets/bodylotion.webp",
            "category" => "body",
            "badge" => "sale"
        ],
        [
            "name" => "Herbal Soap",
            "price" => 420,
            "short_description" => "Infused with medicinal herbs for therapeutic benefits",
            "image" => "./assets/soap.jpg",
            "category" => "soap",
            "badge" => ""
        ],
        [
            "name" => "Anti-Dandruff Shampoo",
            "price" => 600,
            "short_description" => "Specially formulated to eliminate dandruff and soothe the scalp",
            "image" => "./assets/shampoo.jpg",
            "category" => "hair",
            "badge" => "new"
        ],
        [
            "name" => "Exfoliating Face Scrub",
            "price" => 380,
            "short_description" => "Removes dead skin cells for a brighter complexion",
            "image" => "./assets/facewash.webp",
            "category" => "face",
            "badge" => ""
        ],
        [
            "name" => "Moisturizing Cream",
            "price" => 520,
            "short_description" => "Rich formula for deep hydration and skin nourishment",
            "image" => "./assets/bodylotion.webp",
            "category" => "body",
            "badge" => "sale"
        ],
    ];
    
    // Get all unique product categories for filter buttons
    $categories = array_unique(array_column($products, 'category'));
    
    // Handle search and filter functionality
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $selected_category = isset($_GET['category']) ? $_GET['category'] : 'all';
    
    // Filter products based on search query and selected category
    $filtered_products = [];
    foreach ($products as $product) {
        // Check if product matches search query (if any)
        $matches_search = empty($search_query) || 
                          stripos($product['name'], $search_query) !== false || 
                          stripos($product['short_description'], $search_query) !== false;
        
        // Check if product matches selected category (if not 'all')
        $matches_category = $selected_category === 'all' || $product['category'] === $selected_category;
        
        // Add product to filtered list if it matches both search and category criteria
        if ($matches_search && $matches_category) {
            $filtered_products[] = $product;
        }
    }
    ?>

    <!-- Page Header with Title and Subtitle -->
    <div class="page-header">
        <h1>Premium Bath Products</h1>
        <p class="subtitle">Discover our collection of high-quality bath and body products made with natural ingredients</p>
    </div>
    
    <!-- Search Bar -->
    <div class="search-container">
        <form action="" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Search products..." value="<?= htmlspecialchars($search_query) ?>">
            <?php if ($selected_category !== 'all'): ?>
                <input type="hidden" name="category" value="<?= htmlspecialchars($selected_category) ?>">
            <?php endif; ?>
            <span class="search-icon">🔍</span>
        </form>
    </div>
    
    <!-- Category Filter Buttons -->
    <div class="filter-container">
        <a href="?<?= !empty($search_query) ? 'search=' . urlencode($search_query) . '&' : '' ?>category=all">
            <button class="filter-btn <?= $selected_category === 'all' ? 'active' : '' ?>">All Products</button>
        </a>
        <?php foreach ($categories as $category): ?>
            <a href="?<?= !empty($search_query) ? 'search=' . urlencode($search_query) . '&' : '' ?>category=<?= $category ?>">
                <button class="filter-btn <?= $selected_category === $category ? 'active' : '' ?>">
                    <?= ucfirst($category) ?> Products
                </button>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Product Grid Container -->
    <div class="container">
        <?php 
        // Check if there are any products to display after filtering
        if (empty($filtered_products)): 
        ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px 0;">
                <h3>No products found matching your criteria.</h3>
                <p>Try adjusting your search or filter settings.</p>
            </div>
        <?php 
        else:
            // PHP Foreach Loop
            // This loop iterates through each product in the filtered_products array
            // For each product, it generates a product card with the product information
            foreach ($filtered_products as $product): 
        ?>
            <!-- Product Card -->
            <div class="product-container">
                <!-- Image Container with Nested Image Div -->
                <div class="image-container">
                    <?php if (!empty($product["badge"])): ?>
                        <div class="badge badge-<?= $product["badge"] ?>">
                            <?= ucfirst($product["badge"]) ?>
                        </div>
                    <?php endif; ?>
                    <!-- 
                    Using inline CSS to set the background image
                    The PHP shorthand outputs the image URL from the array
                    -->
                    <div class="image" style="background-image: url('<?= $product["image"] ?>')"></div>
                </div>
                <!-- Product Content Area -->
                <div class="card-body">
                    <!-- Product Name -->
                    <h4><?= $product["name"] ?></h4>
                    <!-- Product Description -->
                    <p><?= $product["short_description"] ?></p>
                    <!-- Price and Button Container -->
                    <div class="price">
                        <!-- Price with Currency Symbol -->
                        <span class="price-tag">Rs. <?= $product["price"] ?></span>
                        <!-- Add to Cart Button -->
                        <button class="btn">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php 
            endforeach;
        endif; 
        ?>
    </div>
    
    <!-- What We Learned Section -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 6</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>1. Associative Arrays in PHP</h3>
                <ul>
                    <li>Created complex product data structures using associative arrays</li>
                    <li>Used array keys to organize product information (name, price, description, etc.)</li>
                    <li>Accessed array elements using key names for better readability</li>
                    <li>Implemented nested arrays for more complex data relationships</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>2. Dynamic Content Generation</h3>
                <ul>
                    <li>Used PHP foreach loops to iterate through product arrays</li>
                    <li>Generated HTML content dynamically based on data</li>
                    <li>Created a scalable product display that automatically adjusts to the number of products</li>
                    <li>Implemented conditional rendering for product badges</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>3. PHP with CSS Integration</h3>
                <ul>
                    <li>Used PHP variables within inline CSS for dynamic styling</li>
                    <li>Applied background images dynamically using PHP</li>
                    <li>Created conditional CSS classes based on product properties</li>
                    <li>Implemented modern CSS techniques like backdrop-filter with PHP</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>4. Product Filtering System</h3>
                <ul>
                    <li>Implemented category-based filtering using GET parameters</li>
                    <li>Created dynamic filter buttons based on available categories</li>
                    <li>Maintained filter state across page refreshes</li>
                    <li>Handled edge cases like no products matching filter criteria</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>5. Search Functionality</h3>
                <ul>
                    <li>Created a search form that submits via GET method</li>
                    <li>Implemented search logic to filter products by name and description</li>
                    <li>Combined search with category filtering for advanced product discovery</li>
                    <li>Preserved search terms across filter changes</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>6. Responsive Web Design</h3>
                <ul>
                    <li>Implemented a responsive grid layout using CSS Grid</li>
                    <li>Created media queries to adjust the layout for different screen sizes</li>
                    <li>Used flexible units and relative sizing for adaptable components</li>
                    <li>Ensured the product showcase works well on mobile, tablet, and desktop</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 6
        </div>
        
        <div class="footer-dates">
            <p>Created on: April 30, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_5.php" class="nav-btn">← Day 5</a>
            <span class="day-counter">Day 6 of 25</span>
            <a href="Day_7.php" class="nav-btn">Day 7 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 6/25 (24.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 24.00%"></div>
            </div>
            <div class="progress-percentage">24.00% Complete</div>
        </div>
    </div>
</body>

</html>
