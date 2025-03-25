<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            padding-top: 80px; /* Adjust for fixed navbar */
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        .product-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
        .product-details {
            padding: 15px;
            background-color: white;
        }
        .product-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .product-description {
            color: #666;
            margin-bottom: 15px;
        }
        .badge-company {
            background-color: #007bff;
            color: white;
        }
        /* Custom Navbar Styles */
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-search {
            max-width: 500px;
            width: 100%;
        }
        .user-icon {
            font-size: 1.5rem;
            color: #007bff;
            cursor: pointer;
        }
        .logo {
            font-weight: bold;
            color: #007bff;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top navbar-custom">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand logo" href="#">HanyaKipas</a>
            
            <!-- Search Bar -->
            <form class="d-flex mx-auto navbar-search" role="search">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" 
                           type="search" 
                           placeholder="Search products..." 
                           aria-label="Search">
                </div>
            </form>
            
            <!-- User Icon -->
            <div class="user-icon">
                <i class="bi bi-person-circle"></i>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h1 class="display-4">Our Product Catalog</h1>
                <p class="lead text-muted">Discover our range of high-quality fans</p>
            </div>
        </div>
         
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card product-card shadow-sm">
                    <img src="data:image/png;base64,{{ $product->p_img }}"
                          class="card-img-top product-image"
                          alt="{{ $product->model }}">
                         
                    <div class="product-details">
                        <h5 class="product-title">{{ $product->model }}</h5>
                         
                        <p class="product-description">
                            {{ $product->p_desc }}
                        </p>
                         
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-company">
                                Company ID: {{ $product->company_id }}
                            </span>
                            
                            <p class="product-description">
                                {{ $product->p_desc }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-company">
                                    Company ID: {{ $product->company_id }}
                                </span>
                                
                                <small class="text-muted">Product #{{ $product->product_id }}</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
     
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>