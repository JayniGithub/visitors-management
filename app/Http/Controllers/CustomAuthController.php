<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;

class CustomAuthController extends Controller
{

    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credencials = $request->only('email', 'password');

        if (Auth::attempt($credencials)) {
            return redirect()->intended('dashboard');
        } else {
            return redirect('login')->with('error', 'Login Credentials are not matching...!');
        }
        
    }

    public function registration() {
        return view('auth.registration');
    }

    public function customRegistration(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'Admin',
        ]);

        return redirect('register')->with('success', 'Registration Completed');
    }

    public function dashboard() {
        if (Auth::check()) {
            return view('dashboard');
        } else {
            return redirect('login');
        }
        
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
