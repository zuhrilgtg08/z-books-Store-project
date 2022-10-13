<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($validateData, $remember_me)) {
            $request->session()->regenerate();
            $user = auth()->user();
            // dd($user);
            return redirect()->intended('/home');
        }

        return back()->with('loginFailed', 'Sory, Login Failed!');
    }

    public function logout(Request $request)
    {
        // atau bisa menggunakan request() selain menggunakan $request
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
