<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Http\Controllers\Ticket;


class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        

        return view('admin.dashboard', compact(
            'totalUser'
        ));
    }
}
