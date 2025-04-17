<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            position: relative;
            min-height: 100vh;
            background-color: #212529;
            color: #fff;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        .main-content {
            padding: 1.5rem;
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .customer-section {
            margin-bottom: 2rem;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 1rem;
        }
        .customer-section:last-child {
            border-bottom: none;
        }
        .customer-header {
            background-color: #f8f9fa;
            padding: 0.5rem;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }
        .delete-btn {
            color: #dc3545;
            cursor: pointer;
        }
        .delete-btn:hover {
            color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-3">
                <div class="d-flex align-items-center mb-4">
                    <i class="bi bi-speedometer2 fs-4 me-2"></i>
                    <h5 class="mb-0">HanyaKipas Admin Panel</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">
                            <i class="bi bi-people"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products') }}">
                            <i class="bi bi-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.orders') }}">
                            <i class="bi bi-cart"></i> Orders
                        </a>
                    </li>
                </ul>
                
                <div class="mt-4 logout-link" style="position: absolute; bottom: 0; width: 100%;">
                    <hr>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="nav-link text-danger border-0 bg-transparent" style="cursor: pointer;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Header -->
                <div class="row mb-4 align-items-center">
                    <div class="col">
                        <h2>Orders Management</h2>
                        <p class="text-muted">View and manage customer orders</p>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">All Orders</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @php
                            // Group carts by user name
                            $cartsByUser = $carts->groupBy('user.name');
                            $grandTotal = 0;
                        @endphp

                        @foreach($cartsByUser as $userName => $userCarts)
                            <div class="customer-section">
                                <div class="customer-header">
                                    <h5 class="mb-0">Customer: {{ $userName }}</h5>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Product Image</th>
                                                <th>Product</th>
                                                <th>Company</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $userTotal = 0;
                                            @endphp
                                            
                                            @foreach($userCarts as $cart)
                                                @php
                                                    $totalPrice = $cart->product->p_price * $cart->qty;
                                                    $userTotal += $totalPrice;
                                                    $grandTotal += $totalPrice;
                                                @endphp
                                                <tr>
                                                    <td>{{ $cart->product_id }}</td>
                                                    <td>
                                                        @if($cart->product->p_img)
                                                            <img src="data:image/png;base64,{{ $cart->product->p_img }}" alt="{{ $cart->product->model }}" class="product-image">
                                                        @else
                                                            <div class="bg-secondary product-image d-flex align-items-center justify-content-center text-white">
                                                                <i class="bi bi-image"></i>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $cart->product->model }}</td>
                                                    <td>{{ $cart->product->company_id }}</td>
                                                    <td>{{ $cart->product->p_category }}</td>
                                                    <td>{{ $cart->qty }}</td>
                                                    <td>RM{{ number_format($cart->product->p_price, 2) }}</td>
                                                    <td>RM{{ number_format($totalPrice, 2) }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.orders.destroy', ['product_id' => $cart->product_id, 'user_id' => $cart->user_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="fw-bold">
                                                <td colspan="7"></td>
                                                <td>Customer Total:</td>
                                                <td>RM{{ number_format($userTotal, 2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="card mt-4">
                            <div class="card-body bg-light">
                                <h5 class="card-title">Overall Summary</h5>
                                <p class="card-text fw-bold fs-5">Grand Total: RM{{ number_format($grandTotal, 2) }}</p>
                            </div>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-end mt-3">
                            {{ $carts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>