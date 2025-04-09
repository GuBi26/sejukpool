<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Keloa Petugas</title>

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Kelola Petugas</h1>
                    
                    <div class="d-flex justify-content-end align-items-center mb-4">
                        <button class="btn btn-primary mr-2">
                            <i class="fas fa-file-import mr-1"></i> Cetak
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i> Tambah Pengguna
                        </button>
                    </div>
                
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Pelanggan</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#20462</td>
                                            <td>Matt Dickerson</td>
                                            <td>13/05/2022</td>
                                            <td>$4.95</td>
                                            <td>Tranfer Bank</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#18933</td>
                                            <td>Wixtoria</td>
                                            <td>22/05/2022</td>
                                            <td>$8.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#45169</td>
                                            <td>Trixie Byrd</td>
                                            <td>15/06/2022</td>
                                            <td>$1,149.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-warning px-3 py-2">Process</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#34304</td>
                                            <td>Brad Mason</td>
                                            <td>06/09/2022</td>
                                            <td>$899.95</td>
                                            <td>Tranfer Bank</td>
                                            <td><span class="badge badge-warning px-3 py-2">Process</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#17188</td>
                                            <td>Sanderson</td>
                                            <td>25/09/2022</td>
                                            <td>$22.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-danger px-3 py-2">Canceled</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#73033</td>
                                            <td>Jun Redfern</td>
                                            <td>04/10/2022</td>
                                            <td>$54.95</td>
                                            <td>Tranfer Bank</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#58825</td>
                                            <td>Miriam Kidd</td>
                                            <td>17/10/2022</td>
                                            <td>$174.95</td>
                                            <td>Tranfer Bank</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#44122</td>
                                            <td>Dominic</td>
                                            <td>24/10/2022</td>
                                            <td>$249.95</td>
                                            <td>Cash on Delivery</td>
                                            <td><span class="badge badge-success px-3 py-2">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
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
                .badge-success {
                    background-color: #d1e7dd;
                    color: #0f5132;
                    font-weight: 600;
                }
            
                .badge-warning {
                    background-color: #fff3cd;
                    color: #856404;
                    font-weight: 600;
                }
            
                .badge-danger {
                    background-color: #f8d7da;
                    color: #842029;
                    font-weight: 600;
                }
            
                .table th, .table td {
                    vertical-align: middle;
                }
            
                .dataTables_wrapper .dataTables_paginate {
                    display: flex;
                    justify-content: right;
                    padding: 1rem;
                }
            
            
                .dataTables_wrapper .dataTables_info {
                    text-align: left;
                    padding: 0.5rem 0;
                    margin-top: 1rem;
                }
            
                .btn {
                    font-size: 0.875rem;
                    font-weight: 600;
                }
            
                .table thead {
                    background-color: #f8f9fc;
                }
            
                .table thead th {
                    color: #4e73df;
                    font-weight: bold;
                    text-transform: uppercase;
                    font-size: 0.85rem;
                }
                    /* Custom styles for the length menu */
    .dataTables_length {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .dataTables_length label {
        display: flex;
        align-items: center;
        margin-bottom: 0;
        font-size: 0.875rem;
        color: #6e707e;
        font-weight: 600;
    }
    
    .dataTables_length select {
        margin: 0 0.5rem;
        width: 80px !important;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        padding: 0.25rem 0.5rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%233a3b45' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 16px 12px;
        appearance: none;
    }
    
    .dataTables_length select:focus {
        border-color: #bac8f3;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
        /* Custom styles for the DataTables controls */
    .dataTables_wrapper .dataTables_length {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    .dataTables_wrapper .dataTables_filter {
        display: flex;
        justify-content: right;
        margin-bottom: 1rem;
    }
    
    /* Show entries styling */
    .dataTables_length label {
        display: flex;
        align-items: center;
        margin-bottom: 0;
        font-size: 0.875rem;
        color: #6e707e;
        font-weight: 600;
    }
    
    .dataTables_length select {
        margin: 0 0.5rem;
        width: 80px !important;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        padding: 0.25rem 0.5rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%233a3b45' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 16px 12px;
        appearance: none;
    }
    
    .dataTables_length select:focus {
        border-color: #bac8f3;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    /* Search box styling */
    .dataTables_filter {
        float: none !important;
        margin-left: 0 !important;
    }
    
    .dataTables_filter label {
        position: relative;
        display: flex;
        align-items: center;
        margin-bottom: 0;
        font-size: 0.875rem;
        color: #6e707e;
        font-weight: 600;
    }
    
    .dataTables_filter input {
        margin-left: 0.5rem !important;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        padding: 0.375rem 0.75rem 0.375rem 2.25rem;
        height: calc(1.5em + 0.75rem + 2px);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: left 0.75rem center;
        background-size: 16px 16px;
    }
    
    .dataTables_filter input:focus {
        border-color: #bac8f3;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    /* Container alignment */
    .dataTables_wrapper .row:first-child {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    /* Icon styling */
    .dataTables-control-icon {
        color: #6e707e;
        margin-right: 0.5rem;
        font-size: 0.9rem;
    }
        /* Tambahkan padding untuk card dan table */
        .card.shadow.mb-4 {
        padding: 20px;
        border-radius: 8px;
    }

    .table-responsive {
        margin-top: 15px;
    }

    /* Atur header table */
    .table thead th {
        padding: 12px 15px;
        background-color: #f8f9fc;
        border-bottom: 2px solid #e3e6f0;
    }

    /* Atur cell table */
    .table td {
        padding: 12px 15px;
        border-top: 1px solid #e3e6f0;
    }

    /* Atur tampilan "Tampilkan data" */
    .dataTables_length {
        margin-bottom: 20px;
    }

    /* Beri jarak untuk action buttons */
    .btn-sm {
        margin: 0 3px;
    }

    /* Header card */
    .card-header {
        padding: 15px 20px;
        background-color: #f8f9fc !important;
        border-bottom: 1px solid #e3e6f0;
    }
            </style>
            

            <script>
                $(document).ready(function () {
                    var table = $('#dataTable').DataTable({
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