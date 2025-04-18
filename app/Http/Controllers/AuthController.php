<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);                
    
        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pelanggan',
        ]);
    
        // Login otomatis setelah daftar hanya untuk user publik
        Auth::login($user);
        return redirect('/')->with('success', 'Pendaftaran berhasil! Selamat datang.');
    }    

    public function showLoginForm()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        // Tentukan redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'petugas') {
            return redirect('/petugas/dashboard');
        } else {
            return redirect('/');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Flash message
    return redirect('/login')->with('logout-success', true);
}


}

