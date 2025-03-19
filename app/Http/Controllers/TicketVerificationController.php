<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketVerification;
use App\Models\TransactionItem;
use App\Models\User;

class TicketVerificationController extends Controller
{
    // Menampilkan semua verifikasi tiket
    public function index()
    {
        $verifications = TicketVerification::all();
        return response()->json($verifications);
    }

    // Menampilkan detail verifikasi tiket berdasarkan ID
    public function show($id)
    {
        $verification = TicketVerification::find($id);

        if (!$verification) {
            return response()->json(['message' => 'Verifikasi tiket tidak ditemukan'], 404);
        }

        return response()->json($verification);
    }

    // Menambahkan verifikasi tiket baru
    public function store(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|exists:transaction_items,id',
            'verified_by' => 'required|exists:users,id',
            'waktu_verifikasi' => 'required|date',
            'status' => 'required|in:valid,invalid',
        ]);

        $verification = TicketVerification::create($request->all());

        return response()->json(['message' => 'Verifikasi tiket berhasil dibuat', 'verification' => $verification], 201);
    }

    // Mengupdate verifikasi tiket berdasarkan ID
    public function update(Request $request, $id)
    {
        $verification = TicketVerification::find($id);

        if (!$verification) {
            return response()->json(['message' => 'Verifikasi tiket tidak ditemukan'], 404);
        }

        $request->validate([
            'status' => 'in:valid,invalid',
            'waktu_verifikasi' => 'date',
        ]);

        $verification->update($request->all());

        return response()->json(['message' => 'Verifikasi tiket berhasil diperbarui', 'verification' => $verification]);
    }

    // Menghapus verifikasi tiket berdasarkan ID
    public function destroy($id)
    {
        $verification = TicketVerification::find($id);

        if (!$verification) {
            return response()->json(['message' => 'Verifikasi tiket tidak ditemukan'], 404);
        }

        $verification->delete();

        return response()->json(['message' => 'Verifikasi tiket berhasil dihapus']);
    }
}
