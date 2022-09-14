<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:255', 'min:5', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'currentPassword' => 'required|min:8|max:255',
            'password' => 'required|same:currentPassword|min:8'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        $user = User::create($validateData);

        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successfull!, Please Login here');
        } else {
            return redirect()->route('login')->with('loginFailed', 'Registration failed!, Please Registration again');
        }
    }
}
