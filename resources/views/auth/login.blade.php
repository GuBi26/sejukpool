<!DOCTYPE html>
<html lang="en">
    @include('components.head')

    <header id="header" class="ex-2-header">
        <div class="container mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Masuk</h1>
                    <p>You don't have a password? Then please <a class="white" href="{{ route('register') }}">Sign Up</a></p> 
                    <div class="form-container">
                        <form id="logInForm" action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control-input" id="lemail" name="email" required>
                                <label class="label-control" for="lemail">Email</label>
                                <div class="help-block with-errors"></div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control-input" id="lpassword" name="password" required>
                                <label class="label-control" for="lpassword">Password</label>
                                <div class="help-block with-errors"></div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">LOG IN</button>
                            </div>

                            <div class="form-message">
                                <div id="lmsgSubmit" class="h3 text-center hidden"></div>
                            </div>

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
</body>
</html>
