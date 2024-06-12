<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CineMagic</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Welcome to CineMagic</h1>
        <p>This is the initial page of the CineMagic application.</p>
        <ul>
            <li><a href="{{ url('/movies') }}">View Movies</a></li>
            <li><a href="{{ url('/screenings') }}">View Screenings</a></li>
            @guest
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                <li>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>