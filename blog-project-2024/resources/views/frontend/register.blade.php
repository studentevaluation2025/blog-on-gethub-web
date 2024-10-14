<style>
    body {
        background: linear-gradient(135deg, #74ebd5, #acb6e5);
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .glass-card {
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 100%;
        max-width: 450px;
        color: white;
        text-align: center;
        animation: fadeIn 0.5s ease;
    }

    .glass-header {
        font-size: 26px;
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
        color: #e0e0e0;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.6);
    }

    .btn-primary {
        width: 100%;
        padding: 15px;
        background-color: #4fd1c5;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #38b2ac;
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

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="glass-card">
    <div class="glass-header">
        Register
    </div>

    <p class="text-center mb-4">Create your account by filling out the form below.</p>

    <form action="{{ route('frontend-register-submit') }}" method="POST">
        @csrf <!-- CSRF Token -->

        <!-- Name Input -->
        <div class="form-group mb-3">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" required>
        </div>

        <!-- Email Input -->
        <div class="form-group mb-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <!-- Password Input -->
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Create a password" required>
        </div>

        <!-- Confirm Password Input -->
        <div class="form-group mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your password" required>
        </div>

        <!-- Submit Button -->
        <div class="form-group mb-3">
            <button type="submit" class="btn-primary">Register</button>
        </div>
    </form>

    <!-- Already have an account? Link -->
    <div class="glass-footer">
        <a href="{{ route('frontend-login') }}">Already have an account? Log In</a>
    </div>
</div>
