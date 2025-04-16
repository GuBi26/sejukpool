<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Voucher</title>

    <!-- Fonts & Styles -->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('content/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
</head>

<body id="page-top">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div id="wrapper">
        @include('admin.compo.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.compo.topbar')

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Voucher</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('admin.voucher.update', $voucher->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="kode">Kode Voucher</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="{{ $voucher->kode }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_diskon">Nilai Diskon (%)</label>
                                    <input type="number" class="form-control" id="nilai_diskon" name="nilai_diskon" 
                                           value="{{ $voucher->nilai_diskon }}" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="kuota">Kuota</label>
                                    <input type="number" class="form-control" id="kuota" name="kuota" 
                                           value="{{ $voucher->kuota }}" min="1" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_berlaku">Tanggal Berlaku</label>
                                    <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" 
                                           value="{{ $voucher->tanggal_berlaku }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_expired">Tanggal Kadaluarsa</label>
                                    <input type="date" class="form-control" id="tanggal_expired" name="tanggal_expired" 
                                           value="{{ $voucher->tanggal_expired }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active" {{ $voucher->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="expired" {{ $voucher->status == 'expired' ? 'selected' : '' }}>Kadaluarsa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('admin.voucher.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>                         
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('content/js/jquery.min.js') }}"></script>
    <script src="{{ asset('content/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('content/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('content/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
