<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Pemesanan Tiket</title>
    <style>
        /* General Styles */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 5px;
        }

        /* Header Styles */
        .top-head {
            background-color: #6a4cff;
            text-align: center;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 30px;
        }
        .top-head h1 {
            margin: 0;
            font-size: 24px;
            color: white;
        }

        /* Main Container Styles */
        .history-container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        /* Table Styles */
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
        tr:hover {
            background-color: #f9f9ff;
        }

        /* Status Styles */
        .status-success {
            color: #28a745;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .status-success::before {
            content: "✓";
            margin-right: 10px;
            color: #28a745;
        }

        .status-pending {
            color: #ffc107;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .status-pending::before {
            content: "⌛";
            margin-right: 10px;
            color: #ffc107;
        }

        .status-failed {
            color: #dc3545;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .status-failed::before {
            content: "❌";
            margin-right: 10px;
            color: #dc3545;
        }

        /* Button Styles */
        .pay-button {
            background-color: #5f4dee;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .pay-button:hover {
            background-color: #4a3cc3;
            color: white;
            transform: scale(1.05);
        }
        .pay-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(95, 77, 238, 0.5);
        }

        /* Empty State Styles */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }
        .empty-state i {
            font-size: 50px;
            color: #ddd;
            margin-bottom: 20px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .history-container {
                padding: 15px;
            }
            th, td {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body data-spy="scroll" data-target=".fixed-top">
    
    @include('components.head')
    @include('components.navbar')

    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Riwayat Pemesanan</h1>
                    <div class="breadcrumbs">
                        <a href="{{ route('home') }}">Beranda</a>
                        <i class="fa fa-angle-double-right"></i>
                        <span>Riwayat Pemesanan</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="history-container">
        <div class="top-head">
            <h1>Riwayat Pemesanan Tiket</h1>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Jenis Tiket</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($histories as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal_kunjungan)->translatedFormat('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y H:i') }}</td>
                    <td>{{ $order->ticket->type }}</td>
                    <td>{{ $order->jumlah }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>
                    @if ($order->status === 'pending')
    <span class="status-pending">Pending</span><br>
    <a href="#" class="pay-button" 
       data-order-id="{{ $order->id }}" 
       data-snap-token="{{ $order->snap_token }}">
       Bayar
    </a>
@elseif ($order->status === 'paid')
    <span class="status-success">Paid</span>
@else
    <span class="status-failed">Cancelled</span>
@endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">Belum ada riwayat pemesanan tiket.</td>
                </tr>
                @endforelse
            </tbody>            
        </table>
    </div>

    @include('components.footer')
    @include('components.scripts')

    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const orderId = this.getAttribute('data-order-id');
                const snapToken = this.getAttribute('data-snap-token');
                
                snap.pay(snapToken, {
                    onSuccess: function(result) {
    fetch('/update-payment-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            order_id: orderId,
            status: 'paid'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        }
    });
},
                    onPending: function(result) {
                        // Tidak perlu reload, status masih pending
                        console.log(result);
                    },
                    onError: function(result) {
                        console.error(result);
                    },
                    onClose: function() {
                        // Aksi ketika popup ditutup
                    }
                });
            });
        });
    });
</script>
</body>
</html>
