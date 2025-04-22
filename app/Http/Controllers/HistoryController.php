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
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.history', compact('histories'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
    
        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
    
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled', // validasi input status
        ]);
    
        $order->status = $request->input('status');
        $order->save();
    
        return redirect()->route('history')->with('success', 'Status berhasil diperbarui.');
    }    
    
}
