@extends('layouts.auth')

@section('content')
<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to </h2>
			        <div class="auth-form-container text-start">
						<form method="POST" action="{{ route('login') }}" class="auth-form login-form">
                            @csrf
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Email</label>
								<input id="signin-email" name="email" type="email" class="form-control signin-email {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" required="required">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<input id="signin-password" name="password" type="password" class="form-control signin-password {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required="required">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">

									</div><!--//col-6-->
									<div class="col-6">
										<div class="forgot-password text-end">
                                            @if (Route::has('password.request'))
											<a href="{{ route('password.request') }}">Forgot password?</a>
                                            @endif
										</div>
									</div><!--//col-6-->
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
						</form>

						<div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="{{ route('register') }}" >here</a>.</div>
					</div><!--//auth-form-container-->

			    </div><!--//auth-body-->
                @endsection
