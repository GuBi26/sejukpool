<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

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
        .register-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        /* Center the entire register card vertically */
        .register-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        /* Center the logo perfectly */
        .bg-register-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background: #f8f9fc;
        }
        /* Center the form content vertically */
        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        /* Adjust card height */
        .register-card {
            height: 80vh;
            min-height: 600px;
            max-height: 800px;
        }
        /* Floating label effect */
        .form-control-user {
            padding: 1.5rem 1rem;
            border-radius: 0.5rem !important;
        }
        .form-label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            transition: all 0.3s;
            pointer-events: none;
            color: #6e707e;
        }
        .form-control-user:focus + .form-label,
        .form-control-user:not(:placeholder-shown) + .form-label {
            top: 0.5rem;
            left: 0.8rem;
            font-size: 0.8rem;
            color: #4e73df;
        }
        .confirm-password-group {
            margin-top: -15px;
        }
        /* Password match indicator */
        .password-match {
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
        }
        .password-match.valid {
            color: #28a745;
            display: block;
        }
        .password-match.invalid {
            color: #dc3545;
            display: block;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="register-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg register-card" style="border-radius: 1rem;">
                        <div class="card-body p-0">
                            <div class="row h-100">
                                <!-- Logo Section -->
                                <div class="col-lg-6 d-none d-lg-block p-0">
                                    <div class="bg-register-image">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('content/images/Logo E-Ticket.png') }}" alt="alternative" style="max-width: 350px; height: auto; padding: 20px;">
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Form Section -->
                                <div class="col-lg-6">
                                    <div class="p-5 h-100 form-container">
                                        <div class="register-header">
                                            <h1 class="h3 text-gray-900 mb-3" style="font-size: 1.75rem;">Daftar Akun</h1>
                                            <p class="mb-4" style="font-size: 1rem;">Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a></p>
                                        </div>
                                        
                                        <form class="user" action="{{ route('register.post') }}" method="POST">
                                            @csrf

                                            <!-- Nama Input -->
                                            <div class="form-group mb-4">
                                                <input type="text" class="form-control form-control-user" 
                                                       name="nama" value="{{ old('nama') }}" 
                                                       id="exampleInputName" aria-describedby="nameHelp"
                                                       placeholder="Nama" required autofocus>
                                                @error('nama')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
    
                                            <!-- Email Input -->
                                            <div class="form-group mb-4">
                                                <input type="email" class="form-control form-control-user" 
                                                       name="email" value="{{ old('email') }}" 
                                                       id="exampleInputEmail" aria-describedby="emailHelp"
                                                       placeholder="Email" required>
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
    
                                            <!-- Confirm Password Input with Toggle -->
                                            <div class="form-group position-relative confirm-password-group">
                                                <input type="password" class="form-control form-control-user"
                                                       name="password_confirmation" id="confirmPassword"
                                                       placeholder="Konfirmasi Password" required>
                                                <span class="password-toggle" id="toggleConfirmPassword">
                                                    <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                                                </span>
                                                <div id="passwordMatchMessage" class="password-match"></div>
                                            </div>
    
                                            <!-- Submit Button -->
                                            <button type="submit" class="btn btn-primary btn-user btn-block mb-3 mt-4">
                                                Daftar
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

        // Confirm Password toggle functionality
        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmPassword = document.getElementById('confirmPassword');
            const icon = document.getElementById('toggleConfirmIcon');
            
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                confirmPassword.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Password match validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const message = document.getElementById('passwordMatchMessage');

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                message.textContent = 'Password tidak cocok!';
                message.classList.remove('valid');
                message.classList.add('invalid');
            } else if (password.value && confirmPassword.value) {
                message.textContent = 'Password cocok!';
                message.classList.remove('invalid');
                message.classList.add('valid');
            } else {
                message.textContent = '';
                message.classList.remove('valid', 'invalid');
            }
        }

        password.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword);

        // Initialize floating labels
        document.querySelectorAll('.form-control-user').forEach(input => {
            // Trigger the label effect if there's existing value
            if(input.value) {
                input.nextElementSibling?.classList.add('active');
            }
            
            // Add focus/blur events
            input.addEventListener('focus', function() {
                this.nextElementSibling?.classList.add('active');
            });
            
            input.addEventListener('blur', function() {
                if(!this.value) {
                    this.nextElementSibling?.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>