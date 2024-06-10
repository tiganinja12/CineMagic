@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('alert-msg'))
            <div class="alert {{ Session::get('alert-type') }}">
                <p>{{ Session::get('alert-msg') }}</p>
            </div>
        @endif
        <div class="row justify-content-center mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Filter Movies</div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('movies.index') }}">
                            <div class="row mb-3">
                                <label for="genre" class="col-md-4 col-form-label text-md-end">Genre</label>
                                <div class="col-md-6">
                                    <select id="genre" name="genre" class="form-select">
                                        <option value="" {{ old('genre', $filterByGenre) === '' ? 'selected' : '' }}>All Genres</option>
                                        <option value="NULL" {{ old('genre', $filterByGenre) === 'NULL' ? 'selected' : '' }}>No Genre</option>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->code }}" {{ old('genre', $filterByGenre) == $genre->code ? 'selected' : '' }}>{{ $genre->code }} - {{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                                <div class="col-md-6">
                                    <input id="title" value="{{ old('title', $filterByTitle) }}" name="title" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <div class="d-flex flex-row justify-content-start">
                                        <div class="me-2">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-dark" name="genre" value="" form="form_all_movies">All Movies</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form id="form_all_movies">
                            <input type="hidden">
                            <input type="hidden">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body mt-1">
                        <a class="btn btn-success" href="{{ route('movies.create') }}">Create New Movie</a>
                    </div>
                </div>
            </div>
        </div>

        @if($movies->isEmpty())
            <div class="row g-4">
                <h2 class="text-center">No Movies Found</h2>
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach($movies as $movie)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <em><h6 class="card-subtitle mb-2 text-muted">
                                    {{ $movie->genre->name ?? 'No Genre' }}, {{ $movie->year }}
                                </h6></em>
                            </div>
                            <img src="{{ $movie->poster_filename ? asset('storage/posters/' . $movie->poster_filename) : asset('storage/posters/default.png') }}" class="card-img-top p-3" alt="{{ $movie->title }}">
                            <div class="card-body">
                                {{ $movie->synopsis }}
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-primary" href="{{ route('movies.show', $movie) }}">View Details</a>
                                @auth
                                    <a class="btn btn-secondary" href="{{ route('movies.edit', $movie) }}">Edit</a>
                                    <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mt-3">
                            {{ $movies->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
