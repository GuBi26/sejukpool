<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('content/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('content/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
        }
        .back-button {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #4e73df;
        }
        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        /* Tambahan untuk centering */
        body {
            display: flex;
            min-height: 100vh;
            align-items: center;
        }
        .login-container {
            width: 100%;
        }
        .card {
            height: auto;
        }
        .bg-login-image {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fc;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        /* Center the logo perfectly */
            .bg-register-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background: #f8f9fc;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container login-container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg" style="border-radius: 1rem;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block p-0">
                                <div class="bg-register-image">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('content/images/Logo E-Ticket.png') }}" alt="alternative" style="max-width: 350px; height: auto; padding: 20px;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5 form-container">
                                    <div class="login-header">
                                        <h1 class="h3 text-gray-900 mb-3" style="font-size: 1.75rem;">Masuk</h1>
                                        <p class="mb-4" style="font-size: 1rem;">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
                                    </div>
                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf

                                        <!-- Email Input -->
                                        <div class="form-group mb-4">
                                            <input type="email" class="form-control form-control-user" 
                                                   name="email" value="{{ old('email') }}" 
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Email" required autofocus>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Password Input with Toggle -->
                                        <div class="form-group position-relative mb-4">
                                            <input type="password" class="form-control form-control-user"
                                                   name="password" id="password"
                                                   placeholder="Password" required>
                                            <span class="password-toggle" id="togglePassword">
                                                <i class="fas fa-eye" id="toggleIcon"></i>
                                            </span>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Remember Me Checkbox -->
                                        <div class="form-group mb-4">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                <label class="custom-control-label" for="remember" style="font-size: 0.9rem;">Remember Me</label>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block mb-3">
                                            Login
                                        </button>
                                    </form>

                                    <!-- Back Button -->
                                    <div class="text-center mt-4">
                                        <a href="{{ url('/') }}" class="back-button">
                                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('content/js/jquery.min.js') }}"></script>
    <script src="{{ asset('content/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('content/js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('content/js/sb-admin-2.min.js') }}"></script>

    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Show logout toast if exists
        @if(session('logout-success'))
            $(document).ready(function () {
                $('.toast').toast('show');
            });
        @endif
    </script>

    <!-- Toast Logout Berhasil -->
    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; min-width: 250px; z-index: 1050;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header bg-success text-white">
                <strong class="mr-auto">Logout</strong>
                <small class="text-white">Sekarang</small>
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Anda telah berhasil logout.
            </div>
        </div>
    </div>
</body>
</html>