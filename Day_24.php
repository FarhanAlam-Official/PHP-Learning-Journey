<?php
/**
 * Day 24 - PHP API Development & RESTful Services
 * 
 * This script demonstrates how to create RESTful APIs in PHP:
 * - Building RESTful endpoints
 * - JSON response handling
 * - API authentication
 * - Error handling for APIs
 * - CORS configuration
 * - Request method handling (GET, POST, PUT, DELETE)
 * 
 * Learning Objectives:
 * 1. Understanding REST architecture principles
 * 2. Creating API endpoints with proper HTTP methods
 * 3. JSON data formatting and response structure
 * 4. API security and authentication tokens
 * 5. Error handling and status codes
 * 6. Cross-Origin Resource Sharing (CORS)
 */

// Include database connection for demonstration
include "db.php";
$conn = db();

// Initialize response variables
$api_response = [];
$demo_mode = true; // Set to true to show API examples instead of processing requests

/**
 * FUNCTION: sendJSONResponse
 * Sends a properly formatted JSON response with appropriate HTTP status code
 * 
 * @param array $data - The response data
 * @param int $status_code - HTTP status code (default: 200)
 * @return void
 */
function sendJSONResponse($data, $status_code = 200) {
    http_response_code($status_code);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit();
}

/**
 * FUNCTION: getUsers
 * Retrieves all users from the database
 * 
 * @param mysqli $conn - Database connection
 * @return array - Users data or error message
 */
function getUsers($conn) {
    $query = "SELECT id, username, email, status FROM users";
    $result = $conn->query($query);
    
    if ($result) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return [
            'success' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users,
            'count' => count($users)
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Failed to retrieve users: ' . $conn->error,
            'data' => [],
            'error_code' => 'DB_ERROR'
        ];
    }
}

/**
 * FUNCTION: getUserById
 * Retrieves a specific user by ID
 * 
 * @param mysqli $conn - Database connection
 * @param int $id - User ID
 * @return array - User data or error message
 */
function getUserById($conn, $id) {
    $stmt = $conn->prepare("SELECT id, username, email, status FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        return [
            'success' => true,
            'message' => 'User found',
            'data' => $user
        ];
    } else {
        return [
            'success' => false,
            'message' => 'User not found',
            'data' => null,
            'error_code' => 'USER_NOT_FOUND'
        ];
    }
}

// API endpoint routing (demo examples)
$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

// Demo API responses for learning purposes
$demo_responses = [
    'GET_users' => [
        'success' => true,
        'message' => 'Users retrieved successfully',
        'data' => [
            ['id' => 1, 'username' => 'farhan_alam', 'email' => 'farhan@example.com', 'status' => 1],
            ['id' => 2, 'username' => 'regina_magar', 'email' => 'regina@example.com', 'status' => 1],
            ['id' => 3, 'username' => 'citiz_shrestha', 'email' => 'citiz@example.com', 'status' => 0]
        ],
        'count' => 3,
        'timestamp' => date('Y-m-d H:i:s')
    ],
    'GET_user_by_id' => [
        'success' => true,
        'message' => 'User found',
        'data' => [
            'id' => 1,
            'username' => 'farhan_alam',
            'email' => 'farhan@example.com',
            'status' => 1,
            'created_at' => '2025-04-24 10:30:00',
            'last_login' => '2025-05-20 14:25:30'
        ],
        'timestamp' => date('Y-m-d H:i:s')
    ],
    'POST_create_user' => [
        'success' => true,
        'message' => 'User created successfully',
        'data' => [
            'id' => 4,
            'username' => 'new_user',
            'email' => 'newuser@example.com',
            'status' => 1
        ],
        'timestamp' => date('Y-m-d H:i:s')
    ],
    'PUT_update_user' => [
        'success' => true,
        'message' => 'User updated successfully',
        'data' => [
            'id' => 1,
            'username' => 'updated_user',
            'email' => 'updated@example.com',
            'status' => 1
        ],
        'timestamp' => date('Y-m-d H:i:s')
    ],
    'DELETE_user' => [
        'success' => true,
        'message' => 'User deleted successfully',
        'data' => null,
        'timestamp' => date('Y-m-d H:i:s')
    ],
    'error_example' => [
        'success' => false,
        'message' => 'Authentication failed',
        'error_code' => 'AUTH_FAILED',
        'data' => null,
        'timestamp' => date('Y-m-d H:i:s')
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 24 of PHP - API Development & RESTful Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            --border-radius: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
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

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            margin: 0;
            padding: 20px;
            padding-top: 50px; /* Adjusted for fixed header */
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            color: var(--primary);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }

        h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .subtitle {
            color: var(--gray);
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .api-demo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .api-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: var(--transition);
        }

        .api-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(79, 70, 229, 0.15);
        }

        .api-card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .api-card-body {
            padding: 25px;
        }

        .method-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 8px;
        }

        .method-get { background-color: var(--success); color: white; }
        .method-post { background-color: var(--info); color: white; }
        .method-put { background-color: var(--warning); color: white; }
        .method-delete { background-color: var(--error); color: white; }

        .endpoint-url {
            font-family: 'Courier New', monospace;
            background-color: var(--light);
            padding: 10px;
            border-radius: var(--border-radius);
            margin: 15px 0;
            border-left: 4px solid var(--primary);
        }

        .json-response {
            background-color: #f1f5f9;
            padding: 20px;
            border-radius: var(--border-radius);
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            margin-top: 15px;
            border: 1px solid #e2e8f0;
        }

        .api-button {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            margin-top: 15px;
        }

        .api-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .security-section {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(245, 158, 11, 0.1));
            border-radius: var(--border-radius);
            padding: 25px;
            margin: 30px 0;
            border-left: 4px solid var(--warning);
        }

        .security-title {
            color: var(--warning);
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .security-list {
            list-style: none;
            padding: 0;
        }

        .security-list li {
            padding: 8px 0;
            padding-left: 30px;
            position: relative;
        }

        .security-list li::before {
            content: '🔒';
            position: absolute;
            left: 0;
            top: 8px;
        }

        /* Learning section */
        .learning-section {
            margin-top: 60px;
        }
        
        .learning-title {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
            font-size: 1.8rem;
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .learning-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border-top: 4px solid var(--primary);
        }
        
        .learning-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
        }
        
        .learning-card h3 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .learning-card h3 i {
            color: var(--primary);
        }
        
        .learning-card p {
            margin: 0;
            color: var(--dark);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 30px 20px;
            background-color: var(--white);
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

        @media (max-width: 768px) {
            .api-demo-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 20px;
            }
            
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="day-indicator">Day 24: API Development and RESTful Services</div>
    
    <div class="container">
        <div class="page-header">
            <h1>RESTful API Development</h1>
            <p class="subtitle">Building Professional APIs with PHP</p>
        </div>

        <!-- API Demo Grid -->
        <div class="api-demo-grid">
            <!-- GET All Users -->
            <div class="api-card">
                <div class="api-card-header">
                    <span class="method-badge method-get">GET</span>
                    Get All Users
                </div>
                <div class="api-card-body">
                    <div class="endpoint-url">/api/users</div>
                    <p>Retrieves a list of all users in the system with their basic information.</p>
                    <button class="api-button" onclick="showResponse('GET_users')">View Response</button>
                    <div id="response-GET_users" class="json-response" style="display: none;">
                        <?= json_encode($demo_responses['GET_users'], JSON_PRETTY_PRINT) ?>
                    </div>
                </div>
            </div>

            <!-- GET User by ID -->
            <div class="api-card">
                <div class="api-card-header">
                    <span class="method-badge method-get">GET</span>
                    Get User by ID
                </div>
                <div class="api-card-body">
                    <div class="endpoint-url">/api/users/{id}</div>
                    <p>Retrieves detailed information for a specific user by their ID.</p>
                    <button class="api-button" onclick="showResponse('GET_user_by_id')">View Response</button>
                    <div id="response-GET_user_by_id" class="json-response" style="display: none;">
                        <?= json_encode($demo_responses['GET_user_by_id'], JSON_PRETTY_PRINT) ?>
                    </div>
                </div>
            </div>

            <!-- POST Create User -->
            <div class="api-card">
                <div class="api-card-header">
                    <span class="method-badge method-post">POST</span>
                    Create New User
                </div>
                <div class="api-card-body">
                    <div class="endpoint-url">/api/users</div>
                    <p>Creates a new user account with the provided information.</p>
                    <button class="api-button" onclick="showResponse('POST_create_user')">View Response</button>
                    <div id="response-POST_create_user" class="json-response" style="display: none;">
                        <?= json_encode($demo_responses['POST_create_user'], JSON_PRETTY_PRINT) ?>
                    </div>
                </div>
            </div>

            <!-- PUT Update User -->
            <div class="api-card">
                <div class="api-card-header">
                    <span class="method-badge method-put">PUT</span>
                    Update User
                </div>
                <div class="api-card-body">
                    <div class="endpoint-url">/api/users/{id}</div>
                    <p>Updates an existing user's information using their ID.</p>
                    <button class="api-button" onclick="showResponse('PUT_update_user')">View Response</button>
                    <div id="response-PUT_update_user" class="json-response" style="display: none;">
                        <?= json_encode($demo_responses['PUT_update_user'], JSON_PRETTY_PRINT) ?>
                    </div>
                </div>
            </div>

            <!-- DELETE User -->
            <div class="api-card">
                <div class="api-card-header">
                    <span class="method-badge method-delete">DELETE</span>
                    Delete User
                </div>
                <div class="api-card-body">
                    <div class="endpoint-url">/api/users/{id}</div>
                    <p>Permanently removes a user account from the system.</p>
                    <button class="api-button" onclick="showResponse('DELETE_user')">View Response</button>
                    <div id="response-DELETE_user" class="json-response" style="display: none;">
                        <?= json_encode($demo_responses['DELETE_user'], JSON_PRETTY_PRINT) ?>
                    </div>
                </div>
            </div>

            <!-- Error Response Example -->
            <div class="api-card">
                <div class="api-card-header">
                    <span class="method-badge method-get">ERROR</span>
                    Error Response
                </div>
                <div class="api-card-body">
                    <div class="endpoint-url">/api/users (unauthorized)</div>
                    <p>Example of how API errors are formatted and returned to clients.</p>
                    <button class="api-button" onclick="showResponse('error_example')">View Response</button>
                    <div id="response-error_example" class="json-response" style="display: none;">
                        <?= json_encode($demo_responses['error_example'], JSON_PRETTY_PRINT) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div class="security-section">
            <h2 class="security-title">API Security Best Practices</h2>
            <ul class="security-list">
                <li>Always validate and sanitize input data before processing</li>
                <li>Use HTTPS for all API communications to encrypt data</li>
                <li>Implement API authentication using tokens or API keys</li>
                <li>Rate limiting to prevent abuse and DoS attacks</li>
                <li>Proper error handling without exposing sensitive information</li>
                <li>Use prepared statements for database queries</li>
                <li>Implement CORS policies appropriately</li>
                <li>Log API requests and responses for monitoring</li>
            </ul>
            
            <div style="margin-top: 20px; padding: 15px; background: rgba(59, 130, 246, 0.1); border-radius: 8px;">
                <h4 style="color: var(--info); margin-top: 0;">💡 Implementation Note</h4>
                <p style="margin: 0; font-size: 0.9rem;">
                    For a real API implementation, you would set <code>header('Content-Type: application/json')</code> 
                    at the beginning and return only JSON responses. This demo page shows HTML for learning purposes.
                </p>
            </div>
        </div>
    </div>

    <!-- Learning Section -->
    <div class="learning-section">
        <h2 class="learning-title">What We Learned - Day 24</h2>
        
        <div class="learning-grid">
            <div class="learning-card">
                <h3>🌐 REST Architecture</h3>
                <p>We learned the principles of RESTful web services, including resource-based URLs, stateless communication, and proper use of HTTP methods for different operations.</p>
            </div>
            
            <div class="learning-card">
                <h3>📊 JSON Responses</h3>
                <p>We implemented structured JSON responses with consistent formatting, including success/error indicators, messages, and data payloads for client applications.</p>
            </div>
            
            <div class="learning-card">
                <h3>🔐 API Security</h3>
                <p>We covered essential API security practices including input validation, HTTPS requirements, authentication tokens, and proper error handling without information leakage.</p>
            </div>
            
            <div class="learning-card">
                <h3>🛣️ Endpoint Design</h3>
                <p>We designed clean, intuitive API endpoints following REST conventions with proper HTTP methods (GET, POST, PUT, DELETE) for different operations.</p>
            </div>
            
            <div class="learning-card">
                <h3>⚡ CORS Handling</h3>
                <p>We implemented Cross-Origin Resource Sharing (CORS) configuration to allow controlled access from different domains while maintaining security.</p>
            </div>
            
            <div class="learning-card">
                <h3>📝 Documentation</h3>
                <p>We created interactive API documentation that demonstrates each endpoint with example requests and responses, essential for API usability.</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="footer">
        <div class="footer-title">
            📚 PHP Learning Journey - Day 24
        </div>
        
        <div class="footer-dates">
            <p>Created on: May 21, 2025</p>
            <p>Last modified: <?= date("F j, Y g:i A") ?></p>
        </div>
        
        <div class="navigation">
            <a href="Day_23.php" class="nav-btn">← Day 23</a>
            <span class="day-counter">Day 24 of 25</span>
            <a href="Day_25.php" class="nav-btn">Day 25 →</a>
        </div>
        
        <div class="progress-section">
            <div class="progress-text">Journey Progress: 24/25 (96.00%)</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 96.00%"></div>
            </div>
            <div class="progress-percentage">96.00% Complete</div>
        </div>
    </div>

    <script>
        function showResponse(responseType) {
            const responseDiv = document.getElementById('response-' + responseType);
            if (responseDiv.style.display === 'none') {
                responseDiv.style.display = 'block';
            } else {
                responseDiv.style.display = 'none';
            }
        }
    </script>
</body>
</html>
