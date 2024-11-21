<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unauthorized');
        }

        // Check if the user already exists
        $user = User::where('provider', 'google')
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if ($user) {
            if($user->role=='admin') {
                Auth::login($user);
                return redirect('/accounts');   
            }
            Auth::login($user);
            return redirect('/');
        }

        // Check if the user exists by email
        $existingUser = User::where('email', $socialUser->getEmail())->first();
        if ($existingUser && !$existingUser->provider) {
            return redirect('/login')->with('error', 'Email already in use');
        }
        
        // Create a new user if not exists
        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => 'google',
                'provider_id' => $socialUser->getId(),
                'password' => '', // Empty password for OAuth users
                'avatar' => $socialUser->getAvatar(), 
            ]);

        }
        
        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('', 'Đăng xuất thành công!');
    }
}
