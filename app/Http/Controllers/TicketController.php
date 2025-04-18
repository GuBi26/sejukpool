<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Order;

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

        $order = Order::create([
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
            'tanggal_kunjungan' => $request->booking_date,
            'jumlah' => $request->jumlah_tiket,
            'total_harga' => $request->total_harga,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'message' => 'Pemesanan berhasil dibuat'
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal membuat pemesanan: ' . $e->getMessage()
        ], 500);
    }
}
}
