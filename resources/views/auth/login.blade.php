<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        .login-dark {
                    height: 100vh; /* Set height to full viewport height */
                    background: #475d62 url("{{ asset('images/mountain.jpg') }}");
                    background-size: cover;
                    position: relative;
                }
    </style>
</head>

<body>
    <div class="login-dark">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>

            <!-- Email Address -->
            <div class="form-group">
                <input class="form-control" id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('Email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                </div>
            </div>

            <!-- Login Button -->
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">{{ __('Log in') }}</button>
            </div>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <a class="forgot" href="{{ route('password.request') }}">
                    {{ __('Forgot your email or password?') }}
                </a>
            @endif
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
