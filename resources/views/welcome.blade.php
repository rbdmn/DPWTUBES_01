<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PORTAL RENTALBOSS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #475d62 url('{{ asset('images/mountain.jpg') }}') no-repeat center center;
            background-size: cover;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .content {
            z-index: 2;
            text-align: center;
        }
        .title {
            font-size: 4rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .links a {
            font-size: 1.25rem;
            margin: 0 1rem;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .links a:hover {
            color: #f0e68c;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <div class="title">
            PORTAL TO RENTALBOSS<br><br>
        </div>

        @if (Route::has('login'))
            <div class="links mt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
