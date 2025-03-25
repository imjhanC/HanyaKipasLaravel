<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
</head>
<body>
    <h1>Product Details</h1>

    <h2>Model: {{ $product->model }}</h2>

    <p>Description: {{ $product->p_desc }}</p>

    <div>
        <img src="{{ $product->p_img }}" alt="Image of {{ $product->model }}">
    </div>
    <form action="/purchase" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <label for="quantity">Enter Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>
        <button type="submit">Add to cart</button>
    </form>
</body>
</html>
