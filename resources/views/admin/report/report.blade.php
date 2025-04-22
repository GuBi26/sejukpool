<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Penjualan Tiket</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('content/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('content/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        /* Your existing styles... */
    </style>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    @include('admin.compo.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Navbar -->
            @include('admin.compo.topbar')
            <!-- End Navbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800 text-center">Laporan Penjualan Tiket</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Filter Bulan -->
                        <form class="form-inline mb-4" method="GET" action="{{ route('admin.report.report') }}">
                            <label class="mr-2 font-weight-bold" for="bulan">Bulan:</label>
                            <select class="form-control mr-2" id="bulan" name="bulan">
                                @foreach([
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
                                ] as $num => $name)
                                    <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary mr-3">Tampilkan</button>
                            <a href="{{ route('admin.report.download') }}?bulan={{ $selectedMonth }}" class="btn btn-success mr-3">
                                <i class="fas fa-download"></i> Download PDF
                            </a>
                            <span class="text-muted align-self-center">Menampilkan data untuk bulan {{ $monthName }}</span>
                        </form>

                        <!-- Tabel Laporan -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="salesTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
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
                                        <th colspan="3" style="text-align:left">Total:</th>
                                        <th>{{ $totalTickets }}</th>
                                        <th>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Ringkasan -->
                        <div class="summary-box">
                            <p><strong>Total Transaksi:</strong> Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                            <p><strong>Jumlah Tiket Terjual:</strong> {{ $totalTickets }} Tiket</p>
                            <p><strong>Rata-rata per Transaksi:</strong> Rp {{ number_format($averagePerTransaction, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scripts -->
<script src="{{ asset('content/js/jquery.min.js') }}"></script>
<script src="{{ asset('content/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('content/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('content/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('content/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('content/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#salesTable').DataTable({
            "language": {
                "lengthMenu": "<div class='d-flex align-items-center'><i class='fas fa-list-ol mr-2'></i><span class='mr-2'>Tampilkan</span> _MENU_ <span class='ml-1'>data per halaman</span></div>",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "<i class='fas fa-search mr-2'></i>Cari:",
                "paginate": {
                    "first": "<i class='fas fa-angle-double-left'></i>",
                    "last": "<i class='fas fa-angle-double-right'></i>",
                    "next": "<i class='fas fa-angle-right'></i>",
                    "previous": "<i class='fas fa-angle-left'></i>"
                }
            },
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 5,
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "initComplete": function() {
                $('.dataTables_filter input').addClass('form-control form-control-sm');
                $('.dataTables_filter label').contents().filter(function() {
                    return this.nodeType === 3;
                }).remove();
                $('.dataTables_length select').addClass('form-control form-control-sm');
            }
        });
    });
</script>

</body>
</html>