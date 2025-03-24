<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Log In - Tivo - SaaS App HTML Landing Page Template</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="{{ asset('content/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('content/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('content/css/swiper.css') }}" rel="stylesheet">
	<link href="{{ asset('content/css/magnific-popup.css') }}" rel="stylesheet">
	<link href="{{ asset('content/css/styles.css') }}" rel="stylesheet">
	
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
</head>
<body data-spy="scroll" data-target=".fixed-top">
    
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <header id="header" class="ex-2-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Log In</h1>
                   <p>You don't have a password? Then please <a class="white" href="sign-up.html">Sign Up</a></p> 

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
                        </form>
                    </div> 
                </div>
            </div>
        </div> 
    </header>

    <script src="{{ asset('content/js/jquery.min.js') }}"></script>
    <script src="{{ asset('content/js/popper.min.js') }}"></script>
    <script src="{{ asset('content/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('content/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('content/js/swiper.min.js') }}"></script>
    <script src="{{ asset('content/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('content/js/validator.min.js') }}"></script>
    <script src="{{ asset('content/js/scripts.js') }}"></script>
</body>
</html>
