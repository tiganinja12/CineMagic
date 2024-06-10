@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ $movie->title }}</div>
                <div class="card-body">
                    <div class="mb-3">
                        <img src="{{ $movie->poster_filename ? asset('storage/posters/' . $movie->poster_filename) : asset('storage/posters/default.png') }}" 
                             style="width:10rem;height:15rem;" alt="{{ $movie->title }}">
                    </div>
                    <p><strong>Genre:</strong> {{ $movie->genre->name ?? 'No Genre' }}</p>
                    <p><strong>Year:</strong> {{ $movie->year }}</p>
                    <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
                    @if($movie->trailer_url)
                        <a href="{{ $movie->trailer_url }}" class="btn btn-primary" target="_blank">Watch Trailer</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
