<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthCheckController extends Controller
{
    public function check(Request $request)
    {
        return User::where('email', $request->email)->count() > 0 ? 'Unavailable' : 'Available';
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();

        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
        ];

        $user =  User::firstOrCreate(['email' => $data['email']], $data);

        Auth::login($user);

        toast('Hii ' . Auth::user()->name . ' Selamat Datang😇', 'success');

        return redirect(route('homepage'));
    }
    public function handleProviderRegister()
    {
        return 'Terdaftar';
    }

    public function indexForgot()
    {
        return view('auth.forgot-password');
    }
}
