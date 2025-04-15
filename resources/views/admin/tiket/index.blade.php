<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kelola Tiket</title>

    <!-- Fonts and Styles -->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('content/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('content/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.compo.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.compo.topbar')

                <!-- Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Tiket</h1>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end align-items-center mb-4">
                        <a href="{{ route('admin.tiket.add') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus mr-1"></i> Tambah Tiket
                        </a>
                    </div>

                    <!-- Table -->
                    <div class="card shadow mb-4">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tipe</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tikets as $tiket)
                                        <tr>
                                            <td>{{ $tiket->id }}</td>
                                            <td>{{ $tiket->type }}</td>
                                            <td>{{ $tiket->formatted_harga }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger btn-hapus" data-id="{{ $tiket->id }}">
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
                <!-- End Container -->

            </div>
            <!-- End Main Content -->

            <!-- Scroll to Top -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Wrapper -->

 <!-- Modal Konfirmasi Hapus -->
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
            Apakah Anda yakin ingin menghapus tiket ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" id="btnConfirmHapus">Hapus</button>
        </div>
      </div>
    </div>
  </div>
  

    <!-- Scripts -->
    <script src="{{ asset('content/js/jquery.min.js') }}"></script>
    <script src="{{ asset('content/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('content/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('content/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('content/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('content/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- DataTable Initialization -->
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
                "dom":
                    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
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
        });
        $(document).ready(function () {
        let tiketIdToDelete = null;

        // Saat tombol hapus diklik
        $('.btn-hapus').on('click', function () {
            tiketIdToDelete = $(this).data('id'); // Simpan ID
            $('#modalHapus').modal('show');       // Tampilkan modal
        });

        // Saat konfirmasi hapus ditekan
        $('#btnConfirmHapus').on('click', function () {
            if (tiketIdToDelete !== null) {
                // Misalnya AJAX untuk hapus
                $.ajax({
                    url: '/admin/tiket/' + tiketIdToDelete, // Ganti dengan route backend kamu
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Laravel CSRF
                    },
                    success: function (response) {
                        $('#modalHapus').modal('hide');
                        location.reload(); // Atau hapus baris langsung tanpa reload
                    },
                    error: function (xhr) {
                        alert('Gagal menghapus data.');
                    }
                });
            }
        });
    });
    </script>

    <!-- Custom CSS -->
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

        .table th,
        .table td {
            vertical-align: middle;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
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

        .dataTables_length select:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
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
        }

        .dataTables_filter input {
            margin-left: 0.5rem !important;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem 0.375rem 2.25rem;
            background-color: #fff;
            background-position: left 0.75rem center;
            background-size: 16px 16px;
        }

        .dataTables_filter input:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .dataTables-control-icon {
            color: #6e707e;
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        .card.shadow.mb-4 {
            padding: 20px;
            border-radius: 8px;
        }

        .table-responsive {
            margin-top: 15px;
        }

        .table thead th {
            padding: 12px 15px;
            border-bottom: 2px solid #e3e6f0;
        }

        .table td {
            padding: 12px 15px;
            border-top: 1px solid #e3e6f0;
        }

        .btn-sm {
            margin: 0 3px;
        }

        .card-header {
            padding: 15px 20px;
            background-color: #f8f9fc !important;
            border-bottom: 1px solid #e3e6f0;
        }
    </style>

</body>

</html>
