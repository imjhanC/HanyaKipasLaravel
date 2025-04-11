<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->model }} - Product Details</title>
</head>
<body>
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
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: var(--light-gray);
        position: relative;
    }
    
    .back-button {
        position: absolute;
        top: 25px;
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
    
    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
        }
        
        .product-image, .product-details {
            min-width: 100%;
        }
        
        .back-button {
            top: 15px;
            left: 15px;
        }
    }
</style>