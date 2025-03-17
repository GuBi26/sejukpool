<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan', // Default role pelanggan
        ]);

        return response()->json(['message' => 'Pendaftaran berhasil!', 'user' => $user], 201);
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Tentukan redirect berdasarkan role
        if ($user->role === 'admin') {
            $redirectTo = '/admin/dashboard';
        } elseif ($user->role === 'petugas') {
            $redirectTo = '/petugas/dashboard';
        } else {
            $redirectTo = '/home';
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil!',
            'user' => $user,
            'role' => $user->role,
            'redirect' => $redirectTo, // Tambahkan URL redirect
            'token' => $token
        ], 200);
    }

    return response()->json(['message' => 'Email atau password salah'], 401);
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}

}

