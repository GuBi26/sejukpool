<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Tiket</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Edit Tiket</h1>

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
                            <form action="{{ route('admin.tiket.update', $tickets->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            
                            
                                <div class="form-group">
    <label for="harga">Harga (Rp)</label>
    <input type="text" name="harga" class="form-control" 
        value="{{ number_format($tickets->harga, 0, ',', '.') }}" 
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
        required>
</div>
                            
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.tiket.index') }}" class="btn btn-secondary ml-2">Kembali</a>
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
