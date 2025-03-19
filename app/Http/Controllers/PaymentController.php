<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Transaction;

class PaymentController extends Controller
{
    // Menampilkan semua pembayaran
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    // Menampilkan pembayaran berdasarkan ID
    public function show($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        return response()->json($payment);
    }

    // Menambahkan pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'payment_method' => 'required|in:bank_transfer,e-wallet,credit_card',
            'payment_status' => 'required|in:pending,confirmed,failed',
            'dibayar_pada' => 'nullable|date'
        ]);

        // Cek apakah transaksi yang dikaitkan ada
        $transaction = Transaction::find($request->transaction_id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $payment = Payment::create($request->all());

        return response()->json(['message' => 'Pembayaran berhasil dibuat', 'payment' => $payment], 201);
    }

    // Mengupdate pembayaran
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        $request->validate([
            'payment_method' => 'in:bank_transfer,e-wallet,credit_card',
            'payment_status' => 'in:pending,confirmed,failed',
            'dibayar_pada' => 'nullable|date'
        ]);

        $payment->update($request->all());

        return response()->json(['message' => 'Pembayaran berhasil diperbarui', 'payment' => $payment]);
    }

    // Menghapus pembayaran
    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Pembayaran berhasil dihapus']);
    }
}
