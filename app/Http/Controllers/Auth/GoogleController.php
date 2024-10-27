<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
    return Socialite::driver('google')
    ->scopes(['openid', 'profile', 'email'])
    ->redirect();

    }

    public function handleGoogleCallback()
{
    try {
        // Get the user from Google
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if the user already exists in your database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // User doesn't exist, create a new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                // Set any other default fields or preferences here
            ]);
        }

        // Log the user in
        Auth::login($user);

        // Redirect to intended route after successful login
        return redirect()->intended('dashboard');
    } catch (Exception $e) {
        // Log the error for debugging
        \Log::error('Google Login Error: ', ['error' => $e->getMessage()]);

        return redirect('login')->withErrors('Unable to sign in using Google. Please try again.');
    }
}

}



