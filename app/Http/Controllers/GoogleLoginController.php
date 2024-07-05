<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            log::info('Google User:', ['user' => $googleUser]);

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'avatar' => $googleUser->avatar,
                    'password' => Hash::make(rand(100000, 999999))
                ]);
            }

            Auth::login($user);

            $products = Product::limit(10)->get();
            $banners = Banner::all();

            return redirect('/')->with(['products' => $products, 'banners' => $banners]);

        } catch (\Exception $e) {
            Log::error('Google Login Error:', ['error' => $e->getMessage()]);
            return redirect()->route('login')->with('error', 'Failed to login with Google.');
        }
    }
    
}
