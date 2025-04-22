<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Voucher</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('content/css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Flash message jika sukses -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.compo.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.compo.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Tambah Voucher</h1>

                    <!-- Alert jika ada error validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Card Form -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('admin.voucher.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="kode">Kode Voucher</label>
                                    <input type="text" class="form-control" id="kode" name="kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_diskon">Nilai Diskon (%)</label>
                                    <input type="number" class="form-control" id="nilai_diskon" name="nilai_diskon" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="kuota">Kuota</label>
                                    <input type="number" class="form-control" id="kuota" name="kuota" min="1" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_berlaku">Tanggal Berlaku</label>
                                    <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_expired">Tanggal Kadaluarsa</label>
                                    <input type="date" class="form-control" id="tanggal_expired" name="tanggal_expired" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.voucher.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
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

</body>

</html>
