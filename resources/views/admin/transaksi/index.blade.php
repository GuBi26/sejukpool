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
                    <div class="d-flex justify-content-end align-items-center mb-4">
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus mr-1"></i> Tambah Transaksi
                        </a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Pengunjung</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Total</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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
            <!-- Custom styles for status badges -->
            <style>
                /* Table Styling */
                .table {
                    width: 100%;
                    margin-bottom: 1rem;
                    color: #212529;
                    border-collapse: collapse;
                }
                
                .table thead {
                    background-color: #f8f9fc;
                }
                
                .table thead th {
                    color: #4e73df;
                    font-weight: bold;
                    text-transform: uppercase;
                    font-size: 0.75rem;
                    letter-spacing: 0.5px;
                    padding: 12px 15px;
                    border-bottom: 2px solid #e3e6f0;
                    vertical-align: middle;
                }
                
                .table tbody td {
                    padding: 12px 15px;
                    border-top: 1px solid #e3e6f0;
                    vertical-align: middle;
                }
                
                .table tbody tr:hover {
                    background-color: rgba(0, 0, 0, 0.02);
                }
                
                /* Badge Styling */
                .badge {
                    font-size: 0.75rem;
                    font-weight: 600;
                    padding: 0.35em 0.65em;
                }
                
                .badge-success {
                    background-color: #d1e7dd;
                    color: #0f5132;
                }
                
                .badge-danger {
                    background-color: #f8d7da;
                    color: #842029;
                }
                
                .badge-warning {
                    background-color: #fff3cd;
                    color: #856404;
                }
                
                /* Button Styling */
                .btn-sm {
                    padding: 0.25rem 0.5rem;
                    font-size: 0.75rem;
                    border-radius: 0.2rem;
                    margin: 0 3px;
                }
                
                /* Card Styling */
                .card {
                    border: none;
                    border-radius: 0.35rem;
                    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
                }
                
                .card-body {
                    padding: 1.25rem;
                }
                
                /* DataTables Custom Styling */
                .dataTables_wrapper .dataTables_paginate .paginate_button {
                    padding: 0.25rem 0.5rem;
                    margin-left: 0.25rem;
                    border-radius: 0.2rem;
                }
                
                .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                    background: #4e73df;
                    color: white !important;
                    border: none;
                }
                
                .dataTables_wrapper .dataTables_info {
                    font-size: 0.8rem;
                    color: #6c757d;
                }
                
                /* DataTables controls */
                .dataTables_length {
                    display: flex;
                    align-items: center;
                    margin-bottom: 1rem;
                }
                
                .dataTables_length label {
                    display: flex;
                    align-items: center;
                    font-size: 0.875rem;
                    color: #6e707e;
                    font-weight: 600;
                    margin-bottom: 0;
                }
                
                .dataTables_length select {
                    margin: 0 0.5rem;
                    width: 80px !important;
                    border: 1px solid #d1d3e2;
                    border-radius: 0.35rem;
                    padding: 0.25rem 0.5rem;
                    background-color: #fff;
                    background-repeat: no-repeat;
                    background-position: right 0.5rem center;
                    background-size: 16px 12px;
                    appearance: none;
                }
                
                .dataTables_filter {
                    display: flex;
                    justify-content: flex-end;
                    margin-bottom: 1rem;
                }
                
                .dataTables_filter label {
                    display: flex;
                    align-items: center;
                    font-size: 0.875rem;
                    color: #6e707e;
                    font-weight: 600;
                    margin-bottom: 0;
                }
                
                .dataTables_filter input {
                    margin-left: 0.5rem !important;
                    border: 1px solid #d1d3e2;
                    border-radius: 0.35rem;
                    padding: 0.25rem 0.5rem;
                    background-color: #fff;
                    width: 200px;
                }
            </style>
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