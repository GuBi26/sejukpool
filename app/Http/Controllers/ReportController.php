<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ReportController;



class ReportController extends Controller
{
    public function showReport(Request $request)
    {
        // Get selected month from request or default to current month
        $selectedMonth = $request->input('bulan', date('m'));
        
        // Get orders for the selected month
        $orders = Order::with(['user', 'ticket'])
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', date('Y'))
        ->where('status', 'paid') // tambahkan filter status paid
        ->orderBy('created_at', 'desc')
        ->get();
    ;

        // Calculate summary data
        $totalTickets = $orders->sum('jumlah');
        $totalRevenue = $orders->sum('total_harga');
        $averagePerTransaction = $orders->count() > 0 ? $totalRevenue / $orders->count() : 0;

        // Get month name for display
        $monthName = $this->getMonthName($selectedMonth);

        return view('admin.report.report', [
            'orders' => $orders,
            'totalTickets' => $totalTickets,
            'totalRevenue' => $totalRevenue,
            'averagePerTransaction' => $averagePerTransaction,
            'selectedMonth' => $selectedMonth,
            'monthName' => $monthName
        ]);
    }

    public function downloadPDF(Request $request)
    {
        $selectedMonth = $request->input('bulan', date('m'));
        
        $orders = Order::with(['user', 'ticket'])
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', date('Y'))
        ->where('status', 'paid') // tambahkan filter status paid
        ->orderBy('created_at', 'desc')
        ->get();
    

        $totalTickets = $orders->sum('jumlah');
        $totalRevenue = $orders->sum('total_harga');
        $averagePerTransaction = $orders->count() > 0 ? $totalRevenue / $orders->count() : 0;
        $monthName = $this->getMonthName($selectedMonth);

        $pdf = Pdf::loadView('admin.report.report_pdf', [
            'orders' => $orders,
            'totalTickets' => $totalTickets,
            'totalRevenue' => $totalRevenue,
            'averagePerTransaction' => $averagePerTransaction,
            'monthName' => $monthName
        ]);

        return $pdf->download('laporan_transaksi_'.$monthName.'.pdf');
    }

    private function getMonthName($monthNumber)
    {
        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        return $months[$monthNumber] ?? 'Unknown';
    }
}