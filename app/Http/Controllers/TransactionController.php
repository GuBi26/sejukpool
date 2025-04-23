<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Ticket;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'ticket'])
            ->orderBy('created_at', 'desc')
            ->get();

        $role = auth()->user()->role;

        if ($role === 'admin') {
            return view('admin.transaksi.index', compact('orders'));
        } elseif ($role === 'petugas') {
            return view('petugas.transaksi.index', compact('orders'));
        }

        abort(403, 'Unauthorized');
    }

    public function show($id)
    {
        $transaction = Transaction::with('items.ticket')->find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
        return response()->json($transaction);
    }

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
                $ticket = Ticket::find($item['ticket_id']);
                $hargaPerItem = $ticket->harga;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'ticket_id' => $item['ticket_id'],
                    'jumlah_tiket' => $item['jumlah'],
                    'total_harga' => $hargaPerItem * $jumlah,
                ]);
            }

            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

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

            $snapToken = Snap::getSnapToken($params);
            
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
        $orders = Order::with(['user', 'ticket'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }

    public function createManual()
    {
        $tickets = Ticket::all();
        return view('petugas.transaksi.create', compact('tickets'));
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'required|date',
            'nama_pembeli' => 'required|string|max:255',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $totalHarga = $ticket->harga * $request->jumlah;

        Order::create([
            'user_id' => auth()->id(),
            'ticket_id' => $request->ticket_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => 'paid',
            'tipe_transaksi' => 'offline',
            'nama_pembeli' => $request->nama_pembeli,
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi offline berhasil ditambahkan.');
    }

    public function create()
    {
        $tickets = Ticket::all();
        return view('petugas.transaksi.create', compact('tickets'));
    }
    public function createManualAdmin()
{
    $tickets = Ticket::all();
    return view('admin.transaksi.create', compact('tickets'));
    }   

    public function storeManualPetugas(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'required|date',
            'nama_pembeli' => 'required|string|max:255',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $totalHarga = $ticket->harga * $request->jumlah;

        Order::create([
            'user_id' => auth()->id(),
            'ticket_id' => $request->ticket_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => 'paid',
            'tipe_transaksi' => 'offline',
            'nama_pembeli' => $request->nama_pembeli,
        ]);
        return redirect()->route('petugas.transaksi.index')->with('success', 'Transaksi offline berhasil ditambahkan.');

}
}