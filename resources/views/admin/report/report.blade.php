<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Penjualan Tiket</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,
                600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('content/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('content/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        /* Custom styling for DataTables */
        .dataTables_wrapper .dataTables_info {
            padding-top: 0.85em !important;
        }
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 0.25em !important;
        }
        .dataTables_filter input {
            border: 1px solid #d1d3e2 !important;
            border-radius: 0.35rem !important;
            padding: 0.25rem 0.5rem !important;
        }
        .dataTables_length .custom-select {
    margin-left: 8px;
    margin-right: 8px;
}
        .summary-box {
            background-color: #f8f9fa;
            border-radius: 0.35rem;
            padding: 15px;
            margin-top: 20px;
        }
        .summary-box p {
            margin-bottom: 5px;
            font-size: 1rem;
        }
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
                        <form class="form-inline mb-4">
                            <label class="mr-2 font-weight-bold" for="bulan">Bulan:</label>
                            <select class="form-control mr-2" id="bulan" name="bulan">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04" selected>April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <button type="submit" class="btn btn-primary mr-3">Tampilkan</button>
                            <span class="text-muted align-self-center">Menampilkan data untuk bulan April</span>
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
                                    <tr>
                                        <td>1</td>
                                        <td>2025-04-15</td>
                                        <td>Ani</td>
                                        <td>2</td>
                                        <td>Rp 30.000</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2025-04-15</td>
                                        <td>Budi</td>
                                        <td>3</td>
                                        <td>Rp 45.000</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>2025-04-16</td>
                                        <td>Citra</td>
                                        <td>1</td>
                                        <td>Rp 15.000</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2025-04-16</td>
                                        <td>Dodi</td>
                                        <td>4</td>
                                        <td>Rp 60.000</td>
                                    </tr>
                                    <!-- Additional sample data -->
                                    <tr>
                                        <td>5</td>
                                        <td>2025-04-17</td>
                                        <td>Eka</td>
                                        <td>2</td>
                                        <td>Rp 30.000</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2025-04-18</td>
                                        <td>Fani</td>
                                        <td>3</td>
                                        <td>Rp 45.000</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2025-04-19</td>
                                        <td>Gita</td>
                                        <td>1</td>
                                        <td>Rp 15.000</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>2025-04-20</td>
                                        <td>Hadi</td>
                                        <td>5</td>
                                        <td>Rp 75.000</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2025-04-21</td>
                                        <td>Indra</td>
                                        <td>2</td>
                                        <td>Rp 30.000</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2025-04-22</td>
                                        <td>Joko</td>
                                        <td>3</td>
                                        <td>Rp 45.000</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:left">Total:</th>
                                        <th>26</th>
                                        <th>Rp 390.000</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Ringkasan -->
                        <div class="summary-box">
                            <p><strong>Total Transaksi:</strong> Rp 390.000</p>
                            <p><strong>Jumlah Tiket Terjual:</strong> 26 Tiket</p>
                            <p><strong>Rata-rata per Transaksi:</strong> Rp 39.000</p>
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
var table = $('#salesTable').DataTable({
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
                // Custom styling for search box
                $('.dataTables_filter input').addClass('form-control form-control-sm');
                $('.dataTables_filter label').contents().filter(function() {
                    return this.nodeType === 3;
                }).remove();
                
                // Custom styling for length menu
                $('.dataTables_length select').addClass('form-control form-control-sm');
            },
            "drawCallback": function() {
                // Update summary info when pagination changes
                var api = this.api();
                var totalTickets = api.column(3).data().reduce(function(a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0);
                
                var totalRevenue = api.column(4).data().reduce(function(a, b) {
                    return parseInt(a) + parseInt(b.replace(/[^0-9]/g, ''));
                }, 0);
                
                $('.summary-box p:first').html('<strong>Total Transaksi:</strong> Rp ' + totalRevenue.toLocaleString('id-ID'));
                $('.summary-box p:eq(1)').html('<strong>Jumlah Tiket Terjual:</strong> ' + totalTickets + ' Tiket');
                $('.summary-box p:last').html('<strong>Rata-rata per Transaksi:</strong> Rp ' + Math.round(totalRevenue/api.rows().count()).toLocaleString('id-ID'));
            }
        });
        
        // Update footer with totals
        table.on('draw', function() {
            var api = table.api();
            var totalTickets = api.column(3).data().reduce(function(a, b) {
                return parseInt(a) + parseInt(b);
            }, 0);
            
            var totalRevenue = api.column(4).data().reduce(function(a, b) {
                return parseInt(a) + parseInt(b.replace(/[^0-9]/g, ''));
            }, 0);
            
            $(api.column(3).footer()).html(totalTickets);
            $(api.column(4).footer()).html('Rp ' + totalRevenue.toLocaleString('id-ID'));
        });
    });
</script>

</body>
</html>