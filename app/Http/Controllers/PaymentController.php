<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Tambahkan di PaymentController untuk debugging
public function handleCallback(Request $request)
{
    Log::info('Callback Received:', $request->all());
    
    // Simpan raw content ke log
    Log::info('Raw callback:', [file_get_contents('php://input')]);

    $payload = $request->all();
    $order = Order::find($payload['order_id'] ?? null);

    if (!$order) {
        Log::error('Order not found in callback');
        return response()->json(['status' => 'error'], 404);
    }

    // Update status berdasarkan callback
    if (in_array($payload['transaction_status'] ?? null, ['capture', 'settlement'])) {
        $order->status = 'paid';
        $order->save();
        Log::info('Status updated to paid');
    }

    return response()->json(['status' => 'success']);
}
}