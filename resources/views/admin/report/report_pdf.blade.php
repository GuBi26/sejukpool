<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi - {{ $monthName }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2, h4 {
            text-align: center;
            margin: 0;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: center;
        }
        .summary {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Laporan Transaksi Tiket</h2>
    <h4>Bulan: {{ $monthName }}</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pembeli</th>
                <th>Jumlah Tiket</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->jumlah }}</td>
                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:left">Total</th>
                <th>{{ $totalTickets }}</th>
                <th>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <p><strong>Rata-rata per Transaksi:</strong> Rp {{ number_format($averagePerTransaction, 0, ',', '.') }}</p>
    </div>

</body>
</html>
