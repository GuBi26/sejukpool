<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    // Menampilkan semua voucher
    public function index()
    {
        $vouchers = Voucher::all();
        return response()->json($vouchers);
    }

    // Menampilkan voucher berdasarkan ID
    public function show($id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher tidak ditemukan'], 404);
        }

        return response()->json($voucher);
    }

    // Menambahkan voucher baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:vouchers,kode|max:50',
            'nilai_diskon' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'tanggal_berlaku' => 'required|date',
            'tanggal_expired' => 'required|date|after:tanggal_berlaku',
            'status' => 'required|in:active,expired'
        ]);

        $voucher = Voucher::create($request->all());

        return response()->json(['message' => 'Voucher berhasil dibuat', 'voucher' => $voucher], 201);
    }

    // Mengupdate voucher
    public function update(Request $request, $id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher tidak ditemukan'], 404);
        }

        $request->validate([
            'kode' => 'string|unique:vouchers,kode,'.$id.'|max:50',
            'nilai_diskon' => 'numeric|min:0',
            'kuota' => 'integer|min:1',
            'tanggal_berlaku' => 'date',
            'tanggal_expired' => 'date|after:tanggal_berlaku',
            'status' => 'in:active,expired'
        ]);

        $voucher->update($request->all());

        return response()->json(['message' => 'Voucher berhasil diperbarui', 'voucher' => $voucher]);
    }

    // Menghapus voucher
    public function destroy($id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher tidak ditemukan'], 404);
        }

        $voucher->delete();

        return response()->json(['message' => 'Voucher berhasil dihapus']);
    }
}
