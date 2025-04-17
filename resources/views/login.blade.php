<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HanyaKipas - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
        }
        .login-container {
            max-width: 400px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .brand-title {
            color: #3b82f6;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .login-btn {
            background-color: #3b82f6;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .login-btn:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }
        .form-label {
            font-weight: 500;
            color: #4b5563;
        }
        .input-group-text {
            background-color: transparent;
            border-right: none;
        }
        .password-toggle {
            cursor: pointer;
            border-left: none !important;
        }
        .register-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .register-link:hover {
            color: #2563eb;
            text-decoration: underline;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="login-container">
        <div class="text-center mb-4">
            <h1 class="brand-title">HanyaKipas</h1>
            <p class="text-muted">Welcome back! Please login to your account.</p>
        </div>
        
        @if (session('error'))
            <div class="alert alert-danger mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label" for="email">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" id="email" name="email" class="form-control border-start-0" placeholder="Enter your email here..." required>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" id="password" name="password" class="form-control border-start-0 border-end-0" placeholder="Enter password here..." required>
                    <span class="input-group-text password-toggle" onclick="togglePassword()">
                        <i id="toggleIcon" class="fas fa-eye-slash text-muted"></i>
                    </span>
                </div>
            </div>
            
            <button type="submit" class="btn login-btn text-white w-100 mb-4">Login</button>
            
            <div class="text-center">
                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="register-link">Register now</a></p>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>