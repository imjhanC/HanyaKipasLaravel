<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>
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
        .card-stats {
            border-left: 4px solid;
            transition: transform 0.2s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .card-stats.primary {
            border-left-color: #0d6efd;
        }
        .card-stats.success {
            border-left-color: #198754;
        }
        .card-stats.warning {
            border-left-color: #ffc107;
        }
        .card-stats.danger {
            border-left-color: #dc3545;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
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
                        <a class="nav-link active" href="{{ route('admin.products') }}">
                            <i class="bi bi-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders') }}">
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
                        <h2>Product Management</h2>
                        <p class="text-muted">Manage all products in the system</p>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus-circle"></i> Add New Product
                        </button>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Products Table -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Model</th>
                                        <th>Description</th>
                                        <th>Company</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->product_id }}</td>
                                        <td>
                                            @if($product->p_img)
                                                <img src="data:image/png;base64,{{ $product->p_img }}" class="product-image" alt="{{ $product->model }}">
                                            @else
                                                <div class="bg-light text-center product-image d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $product->model }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($product->p_desc, 50) }}</td>
                                        <td>{{ $product->company->company_name ?? 'Unknown' }}</td>
                                        <td>{{ $product->company_id }}</td>
                                        <td>{{ $product->p_category }}</td>
                                        <td>{{ $product->p_price }}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-primary edit-product" data-id="{{ $product->product_id }}" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-product" data-id="{{ $product->product_id }}" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @if(count($products) == 0)
                                    <tr>
                                        <td colspan="8" class="text-center py-4">No products found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>
                            <div class="col-md-6">
                                <label for="company_id" class="form-label">Company ID</label>
                                <input type="text" class="form-control" id="company_id" name="company_id" required>
                            </div>
                            <div class="col-12">
                                <label for="p_desc" class="form-label">Description</label>
                                <textarea class="form-control" id="p_desc" name="p_desc" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="p_category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="p_category" name="p_category" required>
                            </div>
                            <div class="col-md-6">
                                <label for="p_price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="p_price" name="p_price" required>
                            </div>
                            <div class="col-12">
                                <label for="p_img" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="p_img" name="p_img" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit_model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="model" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_company_id" class="form-label">Company ID</label>
                                <input type="text" class="form-control" id="edit_company_id" name="company_id" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_p_desc" class="form-label">Description</label>
                                <textarea class="form-control" id="edit_p_desc" name="p_desc" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_p_category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="edit_p_category" name="p_category" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_p_price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="edit_p_price" name="p_price" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_p_img" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="edit_p_img" name="p_img" accept="image/*">
                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                            <div class="col-12">
                                <div id="current_image_preview" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteProductForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Edit product button handler
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-product');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const form = document.getElementById('editProductForm');
                    form.action = `/admin/products/update/${productId}`;
                    
                    // Fetch product data via AJAX and populate the form
                    fetch(`/admin/products/${productId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit_model').value = data.model;
                            document.getElementById('edit_company_id').value = data.company_id;
                            document.getElementById('edit_p_desc').value = data.p_desc;
                            document.getElementById('edit_p_category').value = data.p_category;
                            document.getElementById('edit_p_price').value = data.p_price;
                            
                            // Display current image preview if available
                            const imagePreview = document.getElementById('current_image_preview');
                            if (data.p_img) {
                                imagePreview.innerHTML = `<img src="data:image/png;base64,${data.p_img}" class="img-thumbnail mt-2" style="max-height: 150px;" alt="Current image">`;
                            } else {
                                imagePreview.innerHTML = '';
                            }
                        });
                });
            });
            
            // Delete product button handler
            const deleteButtons = document.querySelectorAll('.delete-product');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const form = document.getElementById('deleteProductForm');
                    form.action = `/admin/products/delete/${productId}`;
                });
            });
        });
    </script>
</body>
</html>