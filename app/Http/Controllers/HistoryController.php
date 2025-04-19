<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketHistory;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function history()
    {
        $histories = Order::with('ticket')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.history', compact('histories'));
    }
}
