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
            // 'email' => 'required|email',
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($validateData)) {
            $request->session()->regenerate();

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
