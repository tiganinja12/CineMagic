<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to CineMagic</h1>
    <p>This is the initial page of the CineMagic application.</p>
    <ul>
        <li><a href="{{ route('movies.index') }}">View Movies</a></li>
        <li><a href="{{ route('screenings.index') }}">View Screenings</a></li>
        @if(Auth::user() && Auth::user()->type === 'A')
            <li><a href="{{ route('admin.index') }}">Manage Users</a></li>
        @endif
        <li><a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>
</div>
@endsection
