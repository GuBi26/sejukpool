<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Menampilkan halaman form pemesanan (optional)
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
    
        // Menghilangkan simbol 'Rp' jika ada, dan memastikan hanya angka yang tersisa
        $harga = preg_replace('/[^0-9]/', '', $request->harga); // Menghapus selain angka
    
        // Simpan data tiket tanpa membagi harga dengan 100
        Ticket::create([
            'type' => $request->type,
            'harga' => $harga,  // Tidak membagi harga dengan 100
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

    public function edit($id)
    {
        $tickets = Ticket::findOrFail($id); // ambil 1 tiket berdasarkan ID
    
        return view('admin.tiket.update', compact('tickets')); // gunakan nama tunggal
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
}
