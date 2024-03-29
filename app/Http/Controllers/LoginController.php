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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required|min:8',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($validateData, $remember_me)) {
            $request->session()->regenerate();
            if(auth()->user()->id == 1) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/home');
            }
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
