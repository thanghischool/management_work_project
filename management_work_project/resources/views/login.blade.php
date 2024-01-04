<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('pages/login.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    @vite(['resources/js/app.js'])
</head>

<body>
    <h2 class="htitle">Welcome to DIRA!</h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="{{ route('psignup') }}" method="POST">
			@csrf
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="{{ route('auth.facebook') }}" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="{{ route('auth.google') }}" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your email for registration</span>
			<input type="text" placeholder="Name" name="name" />
			<input type="email" placeholder="Email" name="email" />
			<input type="password" placeholder="Password" name="password" />
			<button type="submit">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('plogin') }}" method="POST">
			@csrf
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="{{ route('auth.facebook') }}" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="{{ route('auth.google') }}" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" placeholder="Email" name="email" />
			<input type="password" placeholder="Password" name="password" />
			@if ($message = Session::get('error'))
				<div class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
				</div>
			@endif
			<a href="{{ route('forgetPass')}}">Forgot your password?</a>
			<button style="margin-top: 50px;" type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>


    <div class="glow-container">
        <div class="ball"></div>
        <div class="ball" style="--delay:-12s;--size:0.35;--speed:25s;"></div>
        <div class="ball" style="--delay:-10s;--size:0.3;--speed:15s;"></div>

    </div>
</body>
<script src="{{ asset('pages/login.js') }}"></script>

</html>
