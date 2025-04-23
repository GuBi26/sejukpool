<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketHistory;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Voucher;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoryController extends Controller
{
    public function history()
    {
        $histories = Order::with('ticket')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
            ->get()
            ->map(function($order) {
                if (!$order->ticket) {
                    $order->original_price = 0;
                    $order->discount_amount = 0;
                    return $order;
                }
            
                $originalPrice = $order->ticket->harga * $order->jumlah;
            
                $order->original_price = $originalPrice;
                $order->discount_amount = $originalPrice - $order->total_harga;
            
                return $order;
            });
    
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
 
    public function download(Order $order)
    {
        // Pastikan hanya pemilik order atau admin yang bisa download
        if (auth()->id() !== $order->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
    
        // Pastikan status sudah paid
        if ($order->status !== 'paid') {
            abort(403, 'Hanya pemesanan yang sudah dibayar yang bisa didownload');
        }
    
        $data = [
            'order' => $order,
            'user' => $order->user,
            'date' => now()->format('d F Y'),
        ];
    
        $pdf = Pdf::loadView('pages.invoice', $data);
        
        return $pdf->download('invoice-'.$order->id.'.pdf');
    }
    
}
