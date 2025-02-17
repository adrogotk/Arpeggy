<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Arpeggy</title>

    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            background-image:url("{{Storage::url("imagen-proyecto.jpg")}}");
            background-repeat: no-repeat;
            background-size: cover;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        h1{
            text-align:center;
            color:Blue;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-left {
            position: absolute;
            left: 750px;
            top: 450px;
        }
        .links > a {
            background-color:lightgrey;
            color: darkblue;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<h1>ARPEGGY</h1>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-left links">
            @auth
                <a href="{{ url('/home') }}">Pagina Principal</a>
            @else
                <a href="{{ route('login') }}">Iniciar Sesion</a><br><br>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Registrarse</a>
                @endif
            @endauth
        </div>
    @endif
</div>
</body>
</html>