<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->model }} - Product Details</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                HanyaKipas
            </a>

            <!-- User Icon -->
            <div class="d-flex align-items-center">
                <a href="#" class="text-dark me-3 position-relative">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                        0
                    </span>
                </a>
                <!-- Updated User Dropdown Menu -->
                <div class="dropdown">
                    <a href="#" class="text-dark dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" aria-labelledby="userDropdown" style="min-width: 200px; padding: 0.5rem;">
                        @if(session()->has('username'))
                            <div class="px-3 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <span class="fw-bold">{{ substr(session('username'), 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-semibold">{{ session('username') }}</h6>
                                        <span class="text-muted small">Customer</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider my-2">
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-bag me-2"></i> My Orders</a></li>
                            <hr class="dropdown-divider my-2">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item py-2" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-2"></i> Login</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('register') }}"><i class="bi bi-person-plus me-2"></i> Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="content-container">
        <!-- Back Button -->
        <button class="back-button" onclick="window.location.href='{{ url('/') }}'">
            &#8592;
        </button>
        
        <h1>Product Details</h1>
        
        <div class="product-container">
            <div class="product-image">
                <img src="data:image/png;base64,{{ $product->p_img }}" alt="{{ $product->model }}">
            </div>
            
            <div class="product-details">
                <h2 class="product-title">{{ $product->model }}</h2>
                
                <div class="product-description">
                    <h3>Description</h3>
                    <p>{{ $product->p_desc }}</p>
                </div>
                
                <div class="purchase-form">
                    <form action="{{ route('addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" id="qty" name="qty" min="1" value="1" required>
                        </div>
                        
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if(session('cart_add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('cart_add') }}
        </div>
    @endif
    @if(session('cart_update'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('cart_update') }}
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function forgetCartSession(sessionName) {
            fetch('/forget-cart-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({session_name: sessionName})
            });
        }
    </script>
</body>
</html>

<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #e74c3c;
        --light-gray: #f5f5f5;
        --dark-gray: #333;
        --white: #ffffff;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--dark-gray);
        margin: 0;
        padding: 0;
        background-color: var(--light-gray);
        position: relative;
    }
    
    .content-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 90px 20px 20px; /* Added top padding to account for fixed navbar */
        position: relative;
    }
    
    .back-button {
        position: absolute;
        top: 95px; /* Adjusted to be below navbar */
        left: 20px;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--secondary-color);
        transition: transform 0.2s;
    }
    
    .back-button:hover {
        transform: translateX(-3px);
        color: var(--primary-color);
    }
    
    h1 {
        color: var(--secondary-color);
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.2rem;
        padding-top: 10px;
    }
    
    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        background-color: var(--white);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .product-image {
        flex: 1;
        min-width: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--light-gray);
        padding: 20px;
        border-radius: 8px;
    }
    
    .product-image img {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
    }
    
    .product-details {
        flex: 1;
        min-width: 300px;
    }
    
    .product-title {
        color: var(--secondary-color);
        font-size: 1.8rem;
        margin-bottom: 15px;
    }
    
    .product-description {
        margin-bottom: 25px;
        font-size: 1.1rem;
        color: #555;
    }
    
    .purchase-form {
        background-color: var(--light-gray);
        padding: 25px;
        border-radius: 8px;
        margin-top: 30px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }
    
    input[type="number"] {
        width: 100px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }
    
    button[type="submit"] {
        background-color: var(--accent-color);
        color: var(--white);
        border: none;
        padding: 12px 25px;
        font-size: 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    button[type="submit"]:hover {
        background-color: #c0392b;
    }
    
    /* Style for navbar elements */
    .search-container {
        width: 50%;
        max-width: 500px;
    }
    
    .navbar {
        padding: 0.75rem 0;
    }
    
    .navbar-brand {
        font-weight: 700;
    }
    
    .cart-badge {
        font-size: 0.6rem;
        padding: 0.25rem 0.4rem;
    }
    
    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
        }
        
        .product-image, .product-details {
            min-width: 100%;
        }
        
        .back-button {
            top: 85px;
            left: 15px;
        }
        
        .search-container {
            width: 100%;
            margin: 0.5rem 0;
        }
        
        .content-container {
            padding-top: 120px; /* Increased for mobile view */
        }
    }
</style>