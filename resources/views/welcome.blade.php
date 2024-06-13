@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Welcome to CineMagic</h1></div>

                <div class="card-body">
                    <p>This is the initial page of the CineMagic application.</p>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ route('movies.index') }}">View Movies</a></li>
                        @if(Auth::user() && Auth::user()->type === 'A')
                            <li class="list-group-item"><a href="{{ route('screenings.index') }}">View Screenings</a></li>
                            <li class="list-group-item"><a href="{{ route('admin.index') }}">Manage Users</a></li>
                            <li class="list-group-item"><a href="{{ route('theaters.index') }}">Manage Theaters</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
