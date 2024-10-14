<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use Laravel\Socialite\Facades\Socialite;

// Route for Login page
Route::get('/login', function () {
    return view('frontend.login');
})->name('frontend-login');

// Route for Register page
Route::get('/register', function () {
    return view('frontend.register');
})->name('frontend-register');

// Route for handling login form submission
Route::post('/login', [AuthController::class, 'login'])->name('frontend-login-submit');

// Route for handling registration form submission
Route::post('/register', [AuthController::class, 'register'])->name('frontend-register-submit');

// // Route for Forgot Password page
// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('frontend-forgot-password');

// // Route to handle Forgot Password form submission
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('frontend-forgot-password-submit');






// Socialite
// Route for Google login redirect
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');

// Route for Google callback
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');







// Route::get('/login', [AuthController::class, 'login'])->name('frontend-login');
// Route::post('/login', [AuthController::class, 'loginSubmit'])->name('frontend-login-submit');
// Route::get('/register', [AuthController::class, 'register'])->name('frontend-register');
// Route::post('/register', [AuthController::class, 'registerSubmit'])->name('frontend-register-submit');


// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('frontend-forgot-password');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('frontend-forgot-password-submit');
