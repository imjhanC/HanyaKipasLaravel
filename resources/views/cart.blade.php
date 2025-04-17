<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .cart-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        .cart-header {
            border-bottom: 2px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .product-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 5px;
            border: 1px solid #eee;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .btn-quantity {
            width: 30px;
            padding: 0;
        }
        .btn-remove {
            color: #dc3545;
            background: none;
            border: none;
        }
        .btn-remove:hover {
            color: #bb2d3b;
        }
        .btn-edit {
            color: #0d6efd;
            background: none;
            border: none;
            margin-right: 5px;
        }
        .btn-edit:hover {
            color: #0b5ed7;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="cart-container">
            <div class="d-flex justify-content-between align-items-center mb-4 cart-header">
                <div>
                    <a href="{{ route('productpage') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Go Back
                    </a>
                </div>
                <h1 class="mb-0 text-center">My Cart</h1>
            </div>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($cartItems->isEmpty())
                <div class="text-center py-5">
                    <div class="empty-cart-icon">
                        <i class="bi bi-cart-x" style="font-size: 5rem; color: #dee2e6;"></i>
                    </div>
                    <h4 class="text-muted mb-3">Your cart is empty</h4>
                    <a href="{{ route('productpage') }}" class="btn btn-primary">Browse Products</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Model</th>
                                <th>Price (RM)</th>
                                <th>Quantity</th>
                                <th>Total (RM)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr data-product-id="{{ $item['product_id'] }}">
                                    <td><img src="data:image/png;base64,{{ $item['p_img'] }}" alt="{{ $item['model'] }}" class="product-img"></td>
                                    <td class="align-middle">{{ $item['model'] }}</td>
                                    <td class="align-middle">{{ number_format($item['p_price'], 2) }}</td>
                                    <td class="align-middle quantity" id="item-qty-{{ $item['product_id'] }}">{{ $item['qty'] }}</td>
                                    <td class="align-middle item-total" id="item-total-{{ $item['product_id'] }}">{{ number_format($item['total_price'], 2) }}</td>
                                    <td class="align-middle">
                                        <button class="btn btn-edit edit-item" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editQtyModal" 
                                                data-product-id="{{ $item['product_id'] }}" 
                                                data-qty="{{ $item['qty'] }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-remove remove-item">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr>
                                <td colspan="4" class="text-end fw-bold fs-5">Grand Total:</td>
                                <td class="fw-bold fs-5" id="grand-total">RM{{ number_format($grandTotal, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('productpage') }}" class="btn btn-outline-secondary">
                        Continue Shopping
                    </a>
                    <button class="btn btn-primary btn-checkout">
                        Proceed to Checkout <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Edit Quantity Modal -->
    <div class="modal fade" id="editQtyModal" tabindex="-1" aria-labelledby="editQtyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQtyModalLabel">Edit Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editQtyForm">
                        @csrf
                        <input type="hidden" name="product_id" id="modalProductId">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="qty" min="1" 
                                required>
                            <div class="form-text text-danger d-none" id="qtyError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmEdit">Update Quantity</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
           // Populate modal with current quantity
            $('.edit-item').on('click', function () {
                const productId = $(this).data('product-id');
                const qty = $(this).data('qty');
                $('#modalProductId').val(productId);
                $('#quantity').val(qty);

                // Clear any previous error message
                $('#qtyError').addClass('d-none').text('');
                $('#confirmEdit').prop('disabled', false).text('Update Quantity');
            });

            // Update quantity on confirm
            $('#confirmEdit').on('click', function () {
                const $btn = $(this);
                const productId = $('#modalProductId').val();
                const newQty = $('#quantity').val();

                // Check if newQty is valid
                if (!newQty || newQty < 1) {
                    $('#qtyError').removeClass('d-none').text('Please enter a valid quantity.');
                    return;
                }

                // Disable button (no spinner or text change)
                $btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        qty: newQty
                    },
                    success: function (response) {
                        $('#editQtyModal').modal('hide');

                        if (response.success) {
                            // Update quantity and total in the table
                            $(`#item-qty-${productId}`).text(newQty);
                            $(`#item-total-${productId}`).text('RM' + response.item_total);

                            // Update grand total
                            $('#grand-total').text('RM' + response.grand_total);

                            // Update cart count
                            $('#cart-count').text(response.cart_count);

                            // 🆕 Update the data-qty attribute for the edit button
                            $(`.edit-item[data-product-id="${productId}"]`).data('qty', newQty);

                            // 🆕 Optional: also update modal field for consistency
                            $('#quantity').val(newQty);

                            // Show success toast
                            showToast('Quantity updated successfully');
                            $btn.prop('disabled', true);
                        }
                    },
                    error: function (xhr, status, error) {
                        let errorMsg = 'Failed to update quantity';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMsg = xhr.responseJSON.error;
                            if (xhr.responseJSON.debug) {
                                console.error('Debug:', xhr.responseJSON.debug);
                            }
                        }
                        showToast(errorMsg, 'error');
                    },
                    complete: function() {
                        // Re-enable button and restore text
                        $btn.prop('disabled', false).text('Update Quantity');
                    }
                });
            });

            // Helper function to show toast messages
            function showToast(message, type = 'success') {
                // Implement your toast notification here
                // Example using Bootstrap toast:
                const toast = new bootstrap.Toast(document.getElementById('toastNotification'));
                $('#toastMessage').text(message);
                $('#toastNotification').removeClass('bg-success bg-danger')
                                    .addClass(type === 'success' ? 'bg-success' : 'bg-danger');
                toast.show();
            }

            // Remove item from cart
            $('.remove-item').on('click', function () {
                const row = $(this).closest('tr');
                const productId = row.data('product-id');

                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', error);
                        console.error('Status:', status);
                        console.error('Response:', xhr.responseText);
                        alert('Failed to remove item.\n' + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>