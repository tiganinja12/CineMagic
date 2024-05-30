<!-- resources/views/movies/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Movies</div>
                <div class="card-body">
                    @if($movies->isEmpty())
                        <p>No movies are currently showing.</p>
                    @else
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Poster</th>
                                    <th>Title</th>
                                    <th>Genre</th>
                                    <th>Year</th>
                                    <th>Synopsis</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movies as $movie)
                                    <tr>
                                        <td>
                                            <img src="{{ $movie->poster_filename ? asset('storage/posters/' . $movie->poster_filename) : asset('storage/posters/default.png') }}" 
                                                 style="width:4rem;height:6rem;" alt="{{ $movie->title }}">
                                        </td>
                                        <td class="align-middle">{{ $movie->title }}</td>
                                        <td class="align-middle">{{ $movie->genre->name }}</td>
                                        <td class="align-middle">{{ $movie->year }}</td>
                                        <td class="align-middle">{{ Str::limit($movie->synopsis, 100) }}</td>
                                        <td class="align-middle">
                                            <a href="{{ url('/movies/' . $movie->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
