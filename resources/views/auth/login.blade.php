<!DOCTYPE html>
<html lang="en">
    @include('components.head')

<body>
    <header id="header" class="ex-2-header">
        <div class="container mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Masuk</h1>
                    <p>Belum punya akun? <a class="white" href="{{ route('register') }}">Daftar sekarang</a></p> 

                    <div class="form-container">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            {{-- Email --}}
                            <div class="form-group">
                                <input type="email" class="form-control-input" name="email" value="{{ old('email') }}" required autofocus>
                                <label class="label-control">Email</label>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-group position-relative">
                                <label class="label-control">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">LOGIN</button>
                            </div>

                            {{-- Kembali --}}
                            <a href="{{ url('/') }}" class="back-button">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </form>
                    </div> 
                </div>
            </div>
        </div> 
    </header>

    @include('components.scripts')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
    
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    </script>
    
</body>
</html>
