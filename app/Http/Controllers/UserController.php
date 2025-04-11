<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ==================== PELANGGAN ====================

    // Tampilkan semua pelanggan
    public function index()
    {
        $users = User::where('role', 'pelanggan')->get();
        return view('admin.user.index', compact('users'));
    }    

    // Tampilkan detail pelanggan berdasarkan ID
    public function show($id)
    {
        $user = User::where('id', $id)->where('role', 'pelanggan')->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json($user);
    }

    public function create()
{
    return view('admin.user.add'); // atau nama file Blade kamu untuk form tambah
}


    public function store(Request $request)
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
        'role' => 'pelanggan',
    ]);

    // Arahkan kembali ke halaman index dengan pesan sukses
    return redirect()->route('admin.user.index')->with('success', 'Pelanggan berhasil ditambahkan');
}

    // Update data pelanggan
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->where('role', 'pelanggan')->first();
    
        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User tidak ditemukan');
        }
    
        $request->validate([
            'nama' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $user->nama = $request->nama ?? $user->nama;
        $user->email = $request->email ?? $user->email;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate');
    }
    

// Hapus pengguna
public function destroy($id)
{
    $user = User::where('id', $id)->where('role', 'pelanggan')->first();

    if (!$user) {
        if (request()->ajax()) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
    }

    $user->delete();

    if (request()->ajax()) {
        return response()->json(['success' => true], 200);
    }

    return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil dihapus');
}


    // ==================== PETUGAS ====================

    // Tampilkan semua petugas
    public function indexStaff()
    {
        $staff = User::where('role', 'petugas')->get();
        return response()->json($staff);
    }
    public function createStaff()
    {
        return view('admin.petugas.add');
    }

    // Tampilkan detail petugas
    public function showStaff($id)
    {
        $staff = User::where('id', $id)->where('role', 'petugas')->first();

        if (!$staff) {
            return response()->json(['message' => 'Petugas tidak ditemukan'], 404);
        }

        return response()->json($staff);
    }
    // Tampilkan daftar petugas ke view blade
    public function viewStaff()
    {
        $staff = User::where('role', 'petugas')->get();
        return view('admin.petugas.index', compact('staff'));
    }


    public function storeStaffView(Request $request)
    {
        
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);
    
        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan!');
    }    
    public function edit($id)
{
    $user = User::where('id', $id)->where('role', 'pelanggan')->first();

    if (!$user) {
        return redirect()->route('admin.user.index')->with('error', 'User tidak ditemukan');
    }

    return view('admin.user.update', compact('user'));
}
     
    
    // Update data petugas
    public function updateStaff(Request $request, $id)
    {
        $staff = User::where('id', $id)->where('role', 'petugas')->first();
    
        if (!$staff) {
            return redirect()->back()->withErrors(['Petugas tidak ditemukan']);
        }
    
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $staff->nama = $request->nama;
        $staff->email = $request->email;
    
        if ($request->filled('password')) {
            $staff->password = Hash::make($request->password);
        }
    
        $staff->save();
    
        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil diupdate.');
    }
    public function editStaff($id)
    {
        $staff = User::where('id', $id)->where('role', 'petugas')->firstOrFail();
        return view('admin.petugas.update', compact('staff'));
    }

    // Hapus petugas
    public function destroyStaff($id)
    {
        $staff = User::where('id', $id)->where('role', 'petugas')->first();
    
        if (!$staff) {
            if (request()->ajax()) {
                return response()->json(['error' => 'Petugas tidak ditemukan'], 404);
            }
            return redirect()->back()->with('error', 'Petugas tidak ditemukan');
        }
    
        $staff->delete();
    
        if (request()->ajax()) {
            return response()->json(['success' => true], 200);
        }
    
        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
    
    
}
