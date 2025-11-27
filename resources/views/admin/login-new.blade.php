<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Feedback Box</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .login-logo {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .login-subtitle {
            font-size: 13px;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.error {
            border-color: #e74c3c;
        }

        .form-error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #7f8c8d;
            margin: 15px 0;
        }

        .remember-me input {
            cursor: pointer;
        }

        .login-footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e0e6ed;
            font-size: 13px;
            color: #7f8c8d;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        /* Demo Credentials Box */
        .demo-box {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #0c5460;
        }

        .demo-box strong {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .demo-box code {
            background: rgba(255,255,255,0.5);
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-body {
                padding: 30px 20px;
            }

            .login-title {
                font-size: 20px;
            }

            .login-logo {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-logo"></div>
                <div class="login-title">Login Admin</div>
                <div class="login-subtitle">Feedback Box Management System</div>
            </div>

            <!-- Body -->
            <div class="login-body">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Demo Credentials -->
                <div class="demo-box">
                    <strong> Demo Credentials:</strong>
                    Username: <code>admin</code><br>
                    Password: <code>admin123</code>
                </div>

                <!-- Login Form -->
                <form method="POST" action="/admin/login">
                    @csrf

                    <div class="form-group">
                        <label class="form-label"> Username</label>
                        <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'error' : '' }}" 
                               placeholder="Enter username" value="{{ old('username') }}" required autofocus>
                        @if ($errors->has('username'))
                            <div class="form-error">{{ $errors->first('username') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label"> Password</label>
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'error' : '' }}" 
                               placeholder="Enter password" required>
                        @if ($errors->has('password'))
                            <div class="form-error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="login-btn"> Sign In</button>
                </form>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                <p>Security Notice: This is a secure admin area. All access is logged.</p>
            </div>
        </div>

        <!-- Additional Info -->
        <div style="text-align: center; margin-top: 20px; color: rgba(255,255,255,0.8); font-size: 12px;">
            <p>© 2025 Dinas Ketahanan Pangan. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
