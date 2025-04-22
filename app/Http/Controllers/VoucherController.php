<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Carbon\Carbon;


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
            'status' => 'in:active,expired,habis',
            'tanggal_expired' => 'date|after:tanggal_berlaku'
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

    public function validateVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
            'total_amount' => 'required|numeric'
        ]);

        if (session()->has('used_voucher_code') && session('used_voucher_code') === $request->voucher_code) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher Ini Sudah Anda Gunakan'
            ]);
        }

        $voucher = Voucher::where('kode', $request->voucher_code)
            ->where('kuota', '>', 0)
            ->where('status', 'active')
            ->where('tanggal_berlaku', '<=', Carbon::today())
            ->where('tanggal_expired', '>=', Carbon::today())
            ->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Kuota Untuk Voucher Ini Sudah Habis'
            ]);
        }


        // Jika kuota habis setelah dikurangi, ubah status jadi "habis"
        if ($voucher->kuota <= 0) {
            $voucher->status = 'habis';
        }
        $voucher->save();
    
        session(['used_voucher_code' => $request->voucher_code]);

        $discountedAmount = $request->total_amount - ($request->total_amount * ($voucher->nilai_diskon / 100));

        return response()->json([
            'success' => true,
            'discounted_amount' => $discountedAmount,
            'discount_percentage' => $voucher->nilai_diskon,
            'voucher' => $voucher
        ]);
    }

}
