@extends('layouts.auth')

@section('content')
<body class="app app-signup p-0">
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Sign up to SelAyang</h2>

					<div class="auth-form-container text-start mx-auto">
						<form class="auth-form auth-signup-form" method="POST" action="{{ route('register') }}">
                            @csrf
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Name</label>
								<input id="signup-name" name="name" type="text" class="form-control signup-name {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Full name" required="required">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Email</label>
								<input id="signup-email" name="email" type="email" class="form-control signup-email {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required="required">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Password</label>
								<input id="signup-password" name="password" type="password" class="form-control signup-password {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Create a password" required="required">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
							</div>
                            <input type="hidden" id="role" name="role" value="pengguna">
                            <div class="password mb-3">
								<label class="sr-only" for="confirm-password">Confirm Password</label>
								<input id="confirm-password" name="password_confirmation" type="password" class="form-control signup-password {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Confirm Password" required="required">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
							</div>
							<div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" required value="" id="RememberPassword">
									<label class="form-check-label" for="RememberPassword">
									I agree to SelAyang's <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
									</label>
								</div>
							</div><!--//extra-->

							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Sign Up</button>
							</div>
						</form><!--//auth-form-->

						<div class="auth-option text-center pt-5">Already have an account? <a class="text-link" href="{{ route('login') }}" >Log in</a></div>
					</div><!--//auth-form-container-->



			    </div><!--//auth-body-->

</section>
@endsection
