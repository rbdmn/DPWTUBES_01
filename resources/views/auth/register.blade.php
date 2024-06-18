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
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2 class="sr-only">Register Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>

            <!-- Name -->
            <div class="form-group">
                <input class="form-control" id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="{{ __('Name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <input class="form-control" id="email" type="email" name="email" :value="old('email')" required placeholder="{{ __('Email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                @error('password')
                    <span class="text-danger">Password harus lebih dari 8 karakter</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                @error('password_confirmation')
                    <span class="text-danger">Password harus lebih dari 8 karakter</span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">{{ __('Register') }}</button>
            </div>

            <a href="{{ route('login') }}" class="forgot">{{ __('Sudah punya akun? Klik untuk login') }}</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
