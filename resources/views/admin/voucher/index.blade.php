<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Voucher</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

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
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @include('admin.compo.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Voucher</h1>
                    
                    <!-- Add Voucher Button -->
                    <div class="d-flex justify-content-end align-items-center mb-4">
                        <a href="{{ route('admin.voucher.add') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus mr-1"></i> Tambah Voucher
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
                                            <th>Kode</th>
                                            <th>Nilai Diskon</th>
                                            <th>Kuota</th>
                                            <th>Tanggal Berlaku</th>
                                            <th>Tanggal Kadaluarsa</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vouchers as $voucher)
                                        <tr>
                                            <td>{{ $voucher->id }}</td>
                                            <td>{{ $voucher->kode }}</td>
                                            <td>{{ number_format($voucher->nilai_diskon, 0, ',', '.') }}%</td>
                                            <td>{{ $voucher->kuota }}</td>
                                            <td>{{ \Carbon\Carbon::parse($voucher->tanggal_berlaku)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($voucher->tanggal_expired)->format('d/m/Y') }}</td>
                                            <td>
                                                    @if ($voucher->status == 'habis')
                                                    <span class="badge bg-danger">Habis</span>
                                                @elseif ($voucher->status == 'expired')
                                                    <span class="badge bg-secondary">Kadaluarsa</span>
                                                @else
                                                    <span class="badge bg-success">Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.voucher.edit', $voucher->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger btn-hapus" data-id="{{ $voucher->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>                                           
                                            </td>
                                        </tr>
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

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus voucher ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="btnConfirmHapus">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->

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
            // Initialize DataTable
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
                "initComplete": function () {
                    $('div.dataTables_length select').addClass('custom-select custom-select-sm');
                    $('div.dataTables_length').prepend('<i class="fas fa-list-ol dataTables-control-icon"></i>');
                    $('div.dataTables_filter label').prepend('<i class="fas fa-search dataTables-control-icon"></i>');
                    $('div.dataTables_filter input').css({
                        'margin-left': '10px',
                        'padding': '8px 15px'
                    });
                }
            });

            // Delete functionality
            let voucherIdToDelete = null;

            $('.btn-hapus').on('click', function () {
                voucherIdToDelete = $(this).data('id');
                $('#modalHapus').modal('show');
            });

            $('#btnConfirmHapus').on('click', function () {
                if (voucherIdToDelete !== null) {
                    $.ajax({
                        url: '/admin/voucher/' + voucherIdToDelete,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            $('#modalHapus').modal('hide');
                            location.reload();
                        },
                        error: function (xhr) {
                            alert('Gagal menghapus voucher.');
                        }
                    });
                }
            });
        });
    </script>

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
        
        /* Button Styling */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 0.2rem;
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
        
        /* Modal Header Styling */
        .modal-header {
            border-bottom: none;
            padding: 1rem 1.5rem;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</body>
</html>