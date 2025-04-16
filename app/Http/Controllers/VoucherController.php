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
        return view('admin.voucher.index', compact('vouchers'));
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

    // Menampilkan form tambah tiket
    public function create()
    {
        return view('admin.voucher.add');
    }

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
    
        // Ganti dari response JSON ke redirect
        return redirect()->route('admin.voucher.index')
        ->with('success', 'Voucher berhasil dibuat');
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

        return redirect()->route('admin.voucher.index');
    }
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.update', compact('voucher'));
        
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
