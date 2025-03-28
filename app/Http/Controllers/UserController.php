<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function addPetugas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Hanya admin yang bisa menambahkan petugas
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $petugas = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas', // Petugas role
        ]);

        return response()->json(['message' => 'Petugas berhasil ditambahkan!', 'user' => $petugas], 201);
    }

        public function index()
        {
            return response()->json(User::where('role', 'pelanggan')->get());
        }
    
        public function indexStaff()
        {
            return response()->json(User::where('role', 'petugas')->get());
        }
    
        public function show($id)
        {
            $user = User::where('id', $id)->where('role', 'pelanggan')->first();
            return $user ? response()->json($user) : response()->json(['message' => 'User tidak ditemukan'], 404);
        }
    
        public function showStaff($id)
        {
            $staff = User::where('id', $id)->where('role', 'petugas')->first();
            return $staff ? response()->json($staff) : response()->json(['message' => 'Petugas tidak ditemukan'], 404);
        }
    }

