<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
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
    </style>
</head>
<body>
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
                            
                            <small class="text-muted">Product #{{ $product->product_id }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS (optional, but recommended) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>