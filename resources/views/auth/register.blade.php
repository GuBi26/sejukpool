<!DOCTYPE html>
<html lang="en">
    @include('components.head')

    <header id="header" class="ex-2-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Sign Up</h1>
                    <p>Already signed up? Then just <a class="white" href="{{ route('login') }}">Log In</a></p> 

                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form id="signUpForm" action="{{ url('/register') }}" method="POST">
                            @csrf <!-- Tambahkan CSRF Token untuk keamanan -->

                            <div class="form-group">
                                <input type="text" class="form-control-input" id="sname" name="nama" required>
                                <label class="label-control" for="sname">Name</label>
                                <div class="help-block with-errors"></div>
                                @error('nama')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control-input" id="semail" name="email" required>
                                <label class="label-control" for="semail">Email</label>
                                <div class="help-block with-errors"></div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control-input" id="spassword" name="password" required>
                                <label class="label-control" for="spassword">Password</label>
                                <div class="help-block with-errors"></div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">SIGN UP</button>
                            </div>

                            <a href="{{ url('/') }}" class="back-button">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>

                        </form>
                    </div> <!-- end of form container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->

    @include('components.scripts')
</body>
</html>
