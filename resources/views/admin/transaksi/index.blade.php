<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Data Transaksi</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('content/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('content/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.compo.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('admin.compo.topbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Alert Box -->
                    <div id="alertBox" class="alert d-none" role="alert"></div>
                    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @if($order->user && $order->user->role === 'pelanggan')
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->tanggal_kunjungan)->format('d M Y') }}</td>
                                            <td>{{ $order->jumlah }}</td>
                                            <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($order->status === 'paid')
                                                    <span class="badge badge-success">Dibayar</span>
                                                @elseif ($order->status === 'pending')
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @else
                                                    <span class="badge badge-danger">Dibatalkan</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
            
            <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('content/js/jquery.min.js') }}"></script>
            <script src="{{ asset('content/js/bootstrap.bundle.min.js') }}"></script>
            <!-- Core plugin JavaScript-->
            <script src="{{ asset('content/js/jquery.easing.min.js') }}"></script>
            <!-- Custom scripts for all pages-->
            <script src="{{ asset('content/js/sb-admin-2.min.js') }}"></script>
            <script src="{{ asset('content/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('content/js/dataTables.bootstrap4.min.js') }}"></script>
            
            <script>
                $(document).ready(function () {
                    $('#dataTable').DataTable({
                        "lengthMenu": [5, 10, 25, 50, 100],
                        "pageLength": 5,
                        "language": {
                            "lengthMenu": "Tampilkan _MENU_ data",
                            "zeroRecords": "Tidak ditemukan",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            "infoEmpty": "Tidak ada data tersedia",
                            "infoFiltered": "(difilter dari _MAX_ total data)",
                            "paginate": {
                                "previous": "<i class='fas fa-chevron-left'></i>",
                                "next": "<i class='fas fa-chevron-right'></i>"
                            },
                            "search": "Cari:"
                        },
                        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                               "<'row'<'col-sm-12'tr>>" +
                               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        "initComplete": function() {
                            // Custom styling for the length menu
                            $('div.dataTables_length select').addClass('custom-select custom-select-sm');
                            
                            // Add icons to both controls
                            $('div.dataTables_length').prepend('<i class="fas fa-list-ol dataTables-control-icon"></i>');
                            $('div.dataTables_filter label').prepend('<i class="fas fa-search dataTables-control-icon"></i>');
                            
                            // Adjust search label text
                            $('div.dataTables_filter label').contents().filter(function() {
                                return this.nodeType === 3 && this.nodeValue.trim() === 'Cari:';
                            }).remove();
                            
                            // Tambahkan margin untuk search box
                            $('.dataTables_filter input').css({
                                'margin-left': '10px',
                                'padding': '8px 15px'
                            });
                        }
                    });
                });
            </script>
</body>
</html>