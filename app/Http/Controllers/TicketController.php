<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\Voucher;

class TicketController extends Controller
{
    // Menampilkan halaman form pemesanan
    public function showTicketForm()
    {
        return view('pages.ticket');
    }

    // Menampilkan semua tiket di halaman admin
    public function index()
    {
        $tikets = Ticket::all();

        foreach ($tikets as $ticket) {
            $ticket->formatted_harga = 'Rp ' . number_format($ticket->harga, 0, ',', '.');
        }

        return view('admin.tiket.index', compact('tikets'));
    }

    // Menampilkan form tambah tiket
    public function create()
    {
        return view('admin.tiket.add');
    }

    // Menyimpan tiket baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:weekday,weekend',
            'harga' => 'required|numeric|min:0',
        ]);

        $harga = preg_replace('/[^0-9]/', '', $request->harga);

        Ticket::create([
            'type' => $request->type,
            'harga' => $harga,
        ]);

        return redirect()->route('admin.tiket.index')->with('success', 'Tiket berhasil ditambahkan!');
    }

    // Menampilkan detail tiket (API JSON)
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        return response()->json($ticket);
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $tickets = Ticket::findOrFail($id);
        return view('admin.tiket.update', compact('tickets'));
    }

    // Mengupdate data tiket
    public function update(Request $request, $id)
    {
        $tickets = Ticket::find($id);

        if (!$tickets) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        $request->validate([
            'type' => 'in:weekday,weekend',
            'harga' => 'numeric|min:0'
        ]);

        $tickets->update($request->all());

        return redirect()->route('admin.tiket.index')->with('success', 'Tiket berhasil diperbarui');
    }

    // Menghapus tiket
    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        $ticket->delete();

        return response()->json(['message' => 'Tiket berhasil dihapus']);
    }


// ✅ Fungsi untuk memproses pemesanan tiket dari user (API)
public function storeOrder(Request $request)
{
    $request->validate([
        'booking_date' => 'required|date|after_or_equal:today',
        'ticket_type' => 'required|in:weekday,weekend',
        'jumlah_tiket' => 'required|integer|min:1|max:10',
        'voucher_code' => 'nullable|string',
        'total_harga' => 'required|numeric|min:0',
    ]);

    try {
        $ticket = Ticket::where('type', $request->ticket_type)->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis tiket tidak tersedia'
            ], 404);
        }

        $totalHarga = $ticket->harga * $request->jumlah_tiket;

        // Diskon voucher
if ($request->voucher_code) {
    $voucher = Voucher::where('kode', $request->voucher_code)->first();
    if ($voucher) {
        $voucher->decrement('kuota');
        if ($voucher->kuota <= 0) {
            $voucher->update(['status' => 'expired']);
        }
    }
}

        // Generate order_id unik
        $generatedOrderId = 'ORDER-' . uniqid() . '-' . time();

        // Simpan order
        $order = Order::create([
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
            'tanggal_kunjungan' => $request->booking_date,
            'jumlah' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
            'status' => 'pending',
            'order_code' => $generatedOrderId,
        ]);

        // Midtrans Config
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $generatedOrderId,
                'gross_amount' => $totalHarga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'order_code' => $generatedOrderId,
            'snap_token' => $snapToken,
            'total_harga' => $totalHarga,
            'message' => 'Pemesanan berhasil dibuat'
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal membuat pemesanan: ' . $e->getMessage()
        ], 500);
    }
}
public function getTicketPrice(Request $request)
{
    $ticketType = $request->query('ticket_type');
    
    $ticket = Ticket::where('type', $ticketType)->first();

    if (!$ticket) {
        return response()->json([
            'success' => false,
            'message' => 'Jenis tiket tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'price' => $ticket->harga,
    ]);
}

public function updateStatus(Request $request, $id)
{
    $ticket = Ticket::find($id);
    if (!$ticket) {
        return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
    }

    $ticket->status = $request->input('status');
    $ticket->save();

    return redirect()->route('history')->with('success', 'Status berhasil diperbarui.');
}


}
