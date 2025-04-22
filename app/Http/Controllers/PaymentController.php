<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Handle notification dari Midtrans
    public function handleNotification(Request $request)
    {
        $payload = $request->all();
        
        Log::info('Midtrans Notification:', $payload);

        // Verifikasi signature key
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", 
            $payload['order_id'] . 
            $payload['status_code'] . 
            $payload['gross_amount'] . 
            $serverKey
        );

        if ($hashed != $payload['signature_key']) {
            Log::error('Invalid signature key');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Cari order berdasarkan order_code (bukan ID)
        $order = Order::where('order_code', $payload['order_id'])->first();

        if (!$order) {
            Log::error('Order not found: ' . $payload['order_id']);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status berdasarkan notifikasi
        switch($payload['transaction_status']) {
            case 'capture':
            case 'settlement':
                $order->status = 'paid';
                break;
            case 'pending':
                $order->status = 'pending';
                break;
            case 'deny':
            case 'cancel':
            case 'expire':
                $order->status = 'cancelled';
                break;
        }

        $order->save();
        Log::info('Order status updated: ' . $order->order_code . ' to ' . $order->status);

        return response()->json(['message' => 'Notification handled']);
    }

    // Untuk update status dari frontend (fallback)
    public function updatePaymentStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'status' => 'required|in:paid,pending,cancelled'
        ]);

        $order = Order::find($request->order_id);
        
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }
}