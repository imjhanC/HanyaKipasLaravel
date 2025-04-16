<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HanyaKipas - Create Your Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        :root {
            --primary: #3B82F6;
            --primary-dark: #2563EB;
            --accent: #10B981;
        }
        body {
            background: linear-gradient(135deg, #f6f9fc 0%, #e9f2fe 100%);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        .card {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }
        .card-header {
            background: var(--primary);
            color: white;
            padding: 20px;
            border: none;
        }
        .form-control {
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            border-color: var(--primary);
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #374151;
        }
        .btn-register {
            background-color: var(--accent);
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-register:hover {
            background-color: #0DA271;
            transform: translateY(-1px);
        }
        .input-group-text {
            background-color: #f3f4f6;
            border-right: none;
            cursor: pointer;
        }
        .logo {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        .alert-danger {
            background-color: #FEE2E2;
            border-color: #FECACA;
            color: #B91C1C;
            border-radius: 8px;
        }
    </style>
</head>
<body class="min-h-screen d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center">
                        <div class="logo">
                            <i class="fas fa-fan text-primary"></i>
                        </div>
                        <div>
                            <h2 class="h4 mb-0">Join HanyaKipas</h2>
                            <p class="mb-0 small text-white-50">Create your account in seconds</p>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter your name" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="email">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="yourname@example.com" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Create a strong password" required>
                                    <span class="input-group-text" onclick="togglePassword()">
                                        <i id="toggleIcon" class="fas fa-eye-slash text-muted"></i>
                                    </span>
                                </div>
                                <div class="form-text mt-2 small">Must be at least 8 characters</div>
                            </div>
                            
                            <button type="submit" class="btn btn-register w-100 text-white mb-3">
                                Create Account <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                            
                            <div class="text-center mt-3">
                                <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-semibold">Sign In</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-muted small">
                    <p>By creating an account, you agree to the <a href="#" class="text-decoration-none">Terms of Service</a> 
                    and <a href="#" class="text-decoration-none">Privacy Policy</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>
</html>