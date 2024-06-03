<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ESTG</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        html {
            height: 100%;
        }

        body {
            height: 100%;
            display: flex;
        }

        body>nav {
            min-width: 150px;
            background-color: lightgray;
            margin-right: 20px;
        }

        body>nav ul {
            list-style-type: none;
            padding-left: 15px;
            margin-bottom: 10px;
        }

        body>nav li {
            margin-bottom: 10px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <h1>Welcome to CineMagic</h1>
        <p>This is the initial page of the CineMagic application.</p>
        <ul>
            <li><a href="{{ url('/movies') }}">View Movies</a></li>
            <li><a href="{{ url('/screenings') }}">View Screenings</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
        </ul>
    </div>
    <div class="main">
        <header>
            <h1>@yield('header-title')</h1>
        </header>
        <div class="content">
            @yield('main')
        </div>
    </div>
</body>
