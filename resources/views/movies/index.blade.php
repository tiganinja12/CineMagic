@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Movies</div>
                <div class="card-body">
                    <a class="btn btn-success mb-3" href="{{ route('movies.create') }}">Add New Movie</a>
                    @if($movies->isEmpty())
                        <p>No movies available.</p>
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
                                        <td class="align-middle">{{ $movie->genre->name ?? 'No Genre' }}</td>
                                        <td class="align-middle">{{ $movie->year }}</td>
                                        <td class="align-middle">{{ Str::limit($movie->synopsis, 100) }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form method="POST" action="{{ route('movies.destroy', $movie) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $movies->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
