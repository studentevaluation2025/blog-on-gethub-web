<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form for requesting a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showForgotPasswordForm()
    {
        return view('frontend.forgot-password');
    }

    /**
     * Handle the form submission for sending a password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLink(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('frontend-forgot-password')
                ->withErrors($validator)
                ->withInput();
        }

        // Send the password reset link
        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', Lang::get($response))
            : back()->withErrors(['email' => Lang::get($response)]);
    }
}

