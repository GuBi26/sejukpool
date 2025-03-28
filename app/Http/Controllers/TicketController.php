<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function showTicketForm()
    {
        return view('pages.ticket'); // Pastikan ada file resources/views/ticket.blade.php
    }    

    // Menampilkan semua tiket
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json($tickets);
    }

    // Menampilkan tiket berdasarkan ID
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        return response()->json($ticket);
    }

    // Menambahkan tiket baru
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:weekday,weekend',
            'harga' => 'required|numeric|min:0'
        ]);

        $ticket = Ticket::create($request->all());

        return response()->json(['message' => 'Tiket berhasil dibuat', 'ticket' => $ticket], 201);
    }

    // Mengupdate tiket
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        $request->validate([
            'type' => 'in:weekday,weekend',
            'harga' => 'numeric|min:0'
        ]);

        $ticket->update($request->all());

        return response()->json(['message' => 'Tiket berhasil diperbarui', 'ticket' => $ticket]);
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
