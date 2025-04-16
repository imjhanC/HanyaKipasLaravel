<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Fans - HanyaKipas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                HanyaKipas
            </a>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('products.search') }}" class="d-flex mx-auto search-container">
                <div class="input-group">
                    <input class="form-control border-end-0 py-2"
                           type="search"
                           name="query"
                           placeholder="Search fans..."
                           aria-label="Search">
                    <button class="btn btn-primary px-3" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>


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

    <div class="container py-5 mt-4">
        <!-- Hero Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="p-5 rounded-4 hero-banner">
                    <h1 class="display-5 fw-bold text-white mb-3">Stay Cool with Premium Fans</h1>
                    <p class="lead text-white-50 mb-4">Discover our collection of high-performance fans for every space</p>
                    <button class="btn btn-light btn-lg px-4 shop-now-btn">Shop Now</button>
                </div>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="col-12 category-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Shop by Category</h4>
                <a href="#" class="text-decoration-none text-primary">View all <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="row g-4 category-cards">
                <div class="col-6 col-md-3">
                    <a href="{{ route('filterByCategory', ['category' => 'all']) }}" class="text-decoration-none text-dark">
                        <div class="category-card {{ request('category') == 'all' || !request('category') ? 'category-all active' : '' }}">
                            <div class="category-icon mb-3">
                                <i class="bi bi-fan"></i>
                            </div>
                            <h6 class="mb-0">All Fans</h6>
                            <div class="category-overlay"></div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ route('filterByCategory', ['category' => 'celling']) }}" class="text-decoration-none text-dark">
                        <div class="category-card {{ request('category') == 'celling' ? 'category-celling active' : '' }}">
                            <div class="category-icon mb-3">
                                <i class="bi bi-house-fill"></i>
                            </div>
                            <h6 class="mb-0">Ceiling Fans</h6>
                            <div class="category-overlay"></div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ route('filterByCategory', ['category' => 'table']) }}" class="text-decoration-none text-dark">
                        <div class="category-card {{ request('category') == 'table' ? 'category-table active' : '' }}">
                            <div class="category-icon mb-3">
                                <i class="bi bi-table"></i>
                            </div>
                            <h6 class="mb-0">Table Fans</h6>
                            <div class="category-overlay"></div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ route('filterByCategory', ['category' => 'bladeless']) }}" class="text-decoration-none text-dark">
                        <div class="category-card {{ request('category') == 'bladeless' ? 'category-bladeless active' : '' }}">
                            <div class="category-icon mb-3">
                                <i class="bi bi-wind"></i>
                            </div>
                            <h6 class="mb-0">Bladeless Fans</h6>
                            <div class="category-overlay"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Grid Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold">Our Fan Collection</h3>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by: Featured
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item" href="#">Featured</a></li>
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Newest Arrivals</a></li>
                        <li><a class="dropdown-item" href="#">Best Sellers</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row g-4">
            @foreach ($products as $product)
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 h-100 product-card">
                    <div class="position-relative">
                        <img src="data:image/png;base64,{{ $product->p_img }}"
                            class="card-img-top product-image"
                            alt="{{ $product->model }}">
                        <div class="position-absolute top-0 end-0 m-2">
                            <button class="btn btn-sm btn-light rounded-circle shadow-sm wishlist-btn">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <h6 class="card-title mb-1 fw-semibold">{{ $product->model }}</h6>
                        <p class="text-muted small mb-2 product-description">{{ Str::limit($product->p_desc, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-bold text-dark">RM{{ number_format($product->p_price, 2) }}</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary add-to-cart-btn">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                    <a href="{{ url('/productDetail/' . $product->product_id) }}" class="stretched-link"></a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">HanyaKipas</h5>
                    <p>Providing premium quality fans for your comfort since 2010.</p>
                    <div class="d-flex gap-3 social-icons">
                        <a href="#" class="text-white"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Shop</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">All Products</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">New Arrivals</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Bestsellers</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Special Offers</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Categories</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">Ceiling Fans</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Table Fans</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Stand Fans</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Bladeless</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="fw-bold mb-3">Newsletter</h6>
                    <p>Subscribe to get updates on new products and special offers.</p>
                    <div class="input-group mb-3 newsletter-input">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small text-white-50">© 2023 HanyaKipas. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small text-white-50 footer-links">
                        <a href="#" class="text-white-50 me-3">Privacy Policy</a>
                        <a href="#" class="text-white-50 me-3">Terms of Service</a>
                        <a href="#" class="text-white-50">Contact Us</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            padding-top: 80px;
        }

        /* Navbar Styles */
        .navbar-brand {
            font-weight: 700;
            color: #2563eb;
            font-size: 1.8rem;
        }

        .search-container {
            max-width: 500px;
            width: 100%;
        }

        .search-container input {
            border-radius: 8px 0 0 8px !important;
        }

        .search-container button {
            border-radius: 0 8px 8px 0 !important;
        }

        .cart-badge {
            font-size: 0.6rem;
        }

        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }

        .shop-now-btn {
            border-radius: 8px;
        }

        /* Product Cards */
        .product-card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .product-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        .wishlist-btn {
            width: 32px;
            height: 32px;
        }

        .product-description {
            min-height: 40px;
        }

        .add-to-cart-btn {
            border-radius: 8px;
        }

        /* Newsletter */
        .newsletter-input input {
            border-radius: 8px 0 0 8px !important;
        }

        .newsletter-input button {
            border-radius: 0 8px 8px 0 !important;
        }

        /* Footer */
        .social-icons a {
            transition: opacity 0.3s;
        }

        .social-icons a:hover {
            opacity: 0.8;
        }

        .footer-links a {
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white !important;
        }

        .category-section {
        margin-bottom: 3rem;
    }

    .category-cards {
        margin-top: 0.5rem;
    }

    .category-card {
        background-color: #f8f9fa;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .category-card.active {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: white;
    }

    .category-icon {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }

    .category-card:hover .category-icon {
        transform: scale(1.1);
    }

    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: #2563eb;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .category-card:hover .category-overlay {
        opacity: 1;
        height: 5px;
    }

    .category-card.active .category-overlay {
        opacity: 0;
    }
    </style>
</body>
</html>
