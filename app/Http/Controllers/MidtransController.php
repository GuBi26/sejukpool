<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Models\Order;

class MidtransController extends Controller
{
    public function handleNotification(Request $request)
    {
        try {
            $notification = $request->all();
            Log::info('📥 Received Midtrans Notification:', $notification);

            $midtrans = new \Midtrans\CoreApi();
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$clientKey = env('MIDTRANS_CLIENT_KEY');

            $statusResponse = \Midtrans\CoreApi::notification();
            Log::info('📦 Midtrans statusResponse:', (array)$statusResponse);

            $transactionStatus = $statusResponse->transaction_status;
            $fraudStatus = $statusResponse->fraud_status;
            $orderId = $statusResponse->order_id;
            $settlementTime = $statusResponse->settlement_time ?? now();
            $paymentType = $statusResponse->payment_type;

            $orderIdParts = explode('-', $orderId);
            $orderNumericId = intval($orderIdParts[1]);

            // ENUM match
            $paymentStatus = 'pending';
            if ($transactionStatus === 'settlement' || ($transactionStatus === 'capture' && $fraudStatus === 'accept')) {
                $paymentStatus = 'successful';
            } elseif (in_array($transactionStatus, ['cancel', 'expire', 'deny'])) {
                $paymentStatus = 'failed';
            }

            $orderStatus = 'pending';
            if ($paymentStatus === 'successful') {
                $orderStatus = 'paid';
            } elseif ($paymentStatus === 'failed') {
                $orderStatus = 'canceled';
            }

            Log::info("🔄 Updating payment with status: {$paymentStatus} for order ID: {$orderNumericId}");

            // Update Payment
            $payment = Payment::where('order_id', $orderNumericId)->first();
            if ($payment) {
                $payment->update([
                    'status' => $paymentStatus,
                    'payment_method' => $paymentType,
                    'payment_date' => $settlementTime,
                    'payment_data' => json_encode($statusResponse),
                ]);
            }

            // Update Order (tanpa updated_at jika kolom tidak ada)
            $order = Order::find($orderNumericId);
            if ($order) {
                $order->status = $orderStatus;
                $order->save();
            }

            return response()->json(['message' => 'Notification received', 'status' => $paymentStatus]);
        } catch (\Exception $e) {
            Log::error('❌ Midtrans notification error:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
}
