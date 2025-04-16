<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">My Cart</h1>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <p class="text-muted">Your cart is empty.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Model</th>
                        <th>Price (RM)</th>
                        <th>Quantity</th>
                        <th>Total Price (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td><img src="data:image/png;base64,{{ $item['p_img'] }}" alt="{{ $item['model'] }}" style="width: 100px;"></td>
                            <td>{{ $item['model'] }}</td>
                            <td>{{ number_format($item['p_price'], 2) }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>{{ number_format($item['total_price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                        <td class="fw-bold">RM{{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-end">
                <button class="btn btn-primary">Proceed to Checkout</button>
            </div>
        @endif
    </div>
</body>
</html>