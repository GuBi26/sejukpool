<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::with('items.ticket')->get();
        return response()->json($transactions);
    }

    // Menampilkan transaksi berdasarkan ID
    public function show($id)
    {
        $transaction = Transaction::with('items.ticket')->find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
        return response()->json($transaction);
    }

    // Membuat transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal_pesan' => 'required|date',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,paid',
            'items' => 'required|array',
            'items.*.ticket_id' => 'required|exists:tickets,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $transaction = Transaction::create($request->only(['user_id', 'tanggal_pesan', 'total_harga', 'status']));

            foreach ($request->items as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'ticket_id' => $item['ticket_id'],
                    'jumlah_tiket' => $item['jumlah'],
                ]);
            }

            DB::commit();
            return response()->json($transaction->load('items.ticket'), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal membuat transaksi', 'error' => $e->getMessage()], 500);
        }
    }

    // Mengupdate status transaksi
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,paid',
        ]);

        $transaction->update($request->only(['status']));
        return response()->json($transaction);
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
        $transaction->delete();
        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}
