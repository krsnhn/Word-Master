<?php

// SocialAuthController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(uniqid()), // Generate a random password
                    'google_id' => $googleUser->getId(),
                ]);
            }

            Auth::login($user);
            \Log::info('User logged in successfully: ', ['user' => $user]);

            return redirect()->intended('/dictionary');
        } catch (\Exception $e) {
            \Log::error('Google Login Error: ', [$e]);
            return redirect()->route('login')->with('error', 'Google login failed, please try again.');
        }
    }
}
