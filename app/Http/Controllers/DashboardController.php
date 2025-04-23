<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::where('role', 'pelanggan')->count();
        $totalTicketsSold = Order::sum('jumlah');
        $successfulTransactions = Order::where('status', 'paid')->count();
    
        // Gunakan role dari user login
        $role = auth()->user()->role;
    
        if ($role === 'admin') {
            return view('admin.dashboard', compact(
                'totalUser',
                'totalTicketsSold',
                'successfulTransactions'
            ));
        } elseif ($role === 'petugas') {
            return view('petugas.dashboard', compact(
                'totalUser',
                'totalTicketsSold',
                'successfulTransactions'
            ));
        }
    
        abort(403, 'Unauthorized');
    }        
    
}