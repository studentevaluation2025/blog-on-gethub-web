<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .glass-container {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            color: white;
            text-align: center;
        }

        .glass-header {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            text-align: left;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            outline: none;
        }

        .form-control::placeholder {
            color: #c0c0c0;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.6);
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            background-color: #50c9c3;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #38a89d;
        }

        .glass-footer {
            margin-top: 30px;
        }

        .glass-footer a {
            color: #50c9c3;
            text-decoration: none;
            font-weight: 600;
        }

        .glass-footer a:hover {
            text-decoration: underline;
        }

        .remember-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .remember-group input[type="checkbox"] {
            margin-right: 10px;
        }

        .remember-group label {
            font-size: 14px;
        }

        .social-button {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid white;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            margin: 10px 0;
            transition: background-color 0.3s ease;
        }

        .social-button:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .social-icon {
            width: 20px;
            margin-right: 10px;
        }

        .divider {
            border-top: 1px solid white;
            margin: 20px 0;
        }

        @media (max-width: 500px) {
            .glass-container {
                padding: 20px;
            }

            .glass-header {
                font-size: 22px;
            }

            .btn-primary {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="glass-container">
        <div class="glass-header">
            Welcome Back
        </div>
        <form action="{{ route('frontend-login-submit') }}" method="POST">
            @csrf <!-- CSRF Token -->

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="remember-group">
                <a href="">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn-primary">Login</button>
            </div>
            <div class="divider"></div>

        <!-- Social Media Login -->
        <div class="form-group">
            <div class="social-button">
                <a href="{{ route('auth.google') }}">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Google_Icons.svg/1200px-Google_Icons.svg.png" alt="Google" class="social-icon">
                Continue with Google
            </a>
            </div>

            {{-- <div class="social-button">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" class="social-icon">
                Continue with Facebook
            </div> --}}
        </div>
        </form>

        <!-- Divider Line -->


        <!-- Register Link -->
        <div class="glass-footer">
            <p>Don't have an account? <a href="{{ route('frontend-register') }}">Sign Up</a></p>
        </div>
    </div>
</body>
</html>
