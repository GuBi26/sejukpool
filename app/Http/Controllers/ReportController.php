<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Import DomPDF

class ReportController extends Controller
{
    // Menampilkan halaman laporan
    public function showReport()
    {
        // Misalnya kita ambil data dari database
        $data = \App\Models\Ticket::all(); // Ganti dengan model yang sesuai

        return view('admin.report.report', compact('data'));
    }

    public function downloadPDF()
    {
        $data = Ticket::all();
        $pdf = Pdf::loadView('report_pdf', compact('data'));
        return $pdf->download('laporan_transaksi.pdf');
    }

}
