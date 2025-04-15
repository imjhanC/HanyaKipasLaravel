<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
</head>
<body>

<button class="back-button" onclick="window.location.href='{{ url('/') }}'">
    &#8592;
</button>

<h1>Your Shopping Cart</h1>

@if(session('cart') && count(session('cart')) > 0)
    <div class="cart-container">
        @php $total = 0; @endphp

        @foreach(session('cart') as $id => $item)
            @php
                $subtotal = $item['qty'] * $item['price'];
                $total += $subtotal;
            @endphp
            <div class="cart-item">
                <div class="item-image">
                    <img src="data:image/png;base64,{{ $item['p_img'] }}" alt="{{ $item['model'] }}">
                </div>
                <div class="item-details">
                    <h2>{{ $item['model'] }}</h2>
                    <p>{{ $item['p_desc'] }}</p>
                    <form action="{{ route('updateCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <div class="form-group">
                            <label for="qty-{{ $id }}">Qty:</label>
                            <input type="number" name="qty" id="qty-{{ $id }}" value="{{ $item['qty'] }}" min="1" required>
                            <button type="submit">Update</button>
                        </div>
                    </form>
                    <form action="{{ route('removeFromCart') }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                    <p><strong>Subtotal:</strong> ${{ number_format($subtotal, 2) }}</p>
                </div>
            </div>
        @endforeach

        <div class="cart-total">
            <h3>Total: ${{ number_format($total, 2) }}</h3>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>
@else
    <p>Your cart is empty.</p>
@endif
</body>
</html>

<style>
    /* Same variables as before */
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
        background-color: var(--light-gray);
        color: var(--dark-gray);
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        position: relative;
    }

    h1 {
        text-align: center;
        color: var(--secondary-color);
        margin-bottom: 30px;
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

    .cart-container {
        background-color: var(--white);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .cart-item {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 20px;
    }

    .item-image img {
        max-width: 150px;
        max-height: 150px;
        object-fit: contain;
        border-radius: 8px;
        background-color: var(--light-gray);
        padding: 10px;
    }

    .item-details {
        flex: 1;
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    input[type="number"] {
        width: 70px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        padding: 10px 20px;
        border: none;
        color: var(--white);
        background-color: var(--accent-color);
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #c0392b;
    }

    .remove-btn {
        background-color: #bdc3c7;
        color: var(--dark-gray);
    }

    .remove-btn:hover {
        background-color: #95a5a6;
    }

    .cart-total {
        text-align: right;
        margin-top: 20px;
    }

    .checkout-btn {
        background-color: var(--primary-color);
        margin-top: 10px;
    }

    .checkout-btn:hover {
        background-color: #2980b9;
    }

    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
            align-items: center;
        }

        .item-details {
            width: 100%;
        }

        .back-button {
            top: 15px;
            left: 15px;
        }
    }
</style>
