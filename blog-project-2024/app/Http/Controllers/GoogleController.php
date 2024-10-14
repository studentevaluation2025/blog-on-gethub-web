<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    // public function handleGoogleCallback() {
    //     $user = Socialite::driver('google')->user();
    //     $findUser = User::where('google_id', $user->id)->first();
    //     if ($findUser) {
    //         Auth::login($findUser);
    //     }
    //     else {
    //         $user = User::updateOrCreate([
    //             'email' => $user->email,
    //         ], [
    //             'name' => $user->name,
    //             'google_id' => $user->id,
    //             'password' => encrypt('12345678'),
    //         ]);

    //         Auth::login($user);

    //     }
    //     return redirect()->intended('home');

    // }

    public function handleGoogleCallback() {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            if (!$user) {
                return redirect()->route('frontend-login')->with('error', 'Unable to authenticate using Google. Please try again.');
            }

            $findUser = User::where('google_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
            } else {
                $newUser = User::updateOrCreate([
                    'email' => $user->email,
                ], [
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => encrypt('12345678'), // You can use a better logic for password
                ]);

                Auth::login($newUser);
            }

            return redirect()->intended('frontend-index');

        } catch (\Exception $e) {
            return redirect()->route('frontend-login')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
