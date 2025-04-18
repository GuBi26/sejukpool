<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan Tiket</title>
    <style>
        .history-wrapper {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #5f4dee;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #eee;
            text-align: center;
        }
        th {
            background-color: #f2f2ff;
            color: #333;
        }
    </style>
</head>
<body>
    @include('components.head')
    @include('components.navbar')

    <header class="ex-header">
        <div class="container">
            <h1>Riwayat Pemesanan Tiket</h1>
            <div class="breadcrumbs">
                <a href="{{ route('home') }}">Beranda</a>
                <i class="fa fa-angle-double-right"></i>
                <span>Riwayat</span>
            </div>
        </div>
    </header>

    <div class="history-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Jenis Tiket</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    @forelse($histories as $index => $history)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($history->tanggal_pemesanan)->format('d M Y') }}</td>
            <td>{{ $history->ticket->jenis ?? '-' }}</td>
            <td>{{ $history->jumlah }}</td>
            <td>
                @php
                    $harga = $history->ticket->harga ?? 0;
                    $total = $history->jumlah * $harga;
                @endphp
                Rp {{ number_format($total, 0, ',', '.') }}
            </td>
            <td><span style="color: green;">{{ ucfirst($history->status ?? 'berhasil') }}</span></td>
        </tr>
    @empty
        <tr>
            <td colspan="6">Belum ada pemesanan tiket.</td>
        </tr>
    @endforelse
</tbody>
        </table>
    </div>

    @include('components.footer')
    @include('components.scripts')
</body>
</html>