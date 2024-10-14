<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('frontend.login');
    }

    /**
     * Handle login form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('frontend-login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home'); // Change '/home' to your desired route
        }

        return redirect()->route('frontend-login')
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('frontend.register');
    }

    /**
     * Handle registration form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('frontend-register')
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Log the user in
        Auth::attempt($request->only('email', 'password'));

        return redirect()->intended('/home'); // Change '/home' to your desired route
    }
}
