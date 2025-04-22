<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

class TransactionController extends Controller
{
    public function index()
    {
        $transaksi = Transaction::with(['user' => function ($query) {
            $query->where('role', 'pelanggan');
        }])->get();        
    
        return view('admin.transaksi.index', compact('transaksi'));
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

            $jumlah = $item['jumlah'];
            $ticket = \App\Models\Ticket::find($item['ticket_id']);
            $hargaPerItem = $ticket->harga;
            
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'ticket_id' => $item['ticket_id'],
                'jumlah_tiket' => $item['jumlah'],
                'total_harga' => $hargaPerItem * $jumlah,
            ]);
        }

        // MIDTRANS CONFIG
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $transaction->id . '-' . time(),
                'gross_amount' => (int) $transaction->total_harga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;  
        $transaction->save();

        DB::commit();

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'transaction' => $transaction->load('items.ticket'),
            'snap_token' => $snapToken,
        ], 201);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'message' => 'Gagal membuat transaksi',
            'error' => $e->getMessage(),
        ], 500);
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
    
    public function getTransactionData()
{
    $transactions = Transaction::with(['user:id,name'])
        ->select('transactions.*')
        ->whereHas('user', function($q) {
            $q->where('role', 'pelanggan'); 
        });

    return datatables()->eloquent($transactions)
        ->editColumn('created_at', fn($t) => $t->created_at->format('d/m/Y H:i'))
        ->addColumn('action', fn($t) => view('admin.transaksi.actions', compact('t')))
        ->addColumn('status_badge', function($t) {
            $class = [
                'pending' => 'warning',
                'completed' => 'success',
                'failed' => 'danger'
            ][$t->status] ?? 'secondary';
            
            return '<span class="badge badge-'.$class.'">'.ucfirst($t->status).'</span>';
        })
        ->rawColumns(['action', 'status_badge'])
        ->toJson();
}

}
