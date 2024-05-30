@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h5>New Movie</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="inputTitle">Title</label>
                            <input type="text" class="form-control" name="title" id="inputTitle" value="{{ old('title') }}" />
                            @error('title')
                            <div class="small text-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputSynopsis">Synopsis</label>
                            <input type="text" class="form-control" name="synopsis" id="inputSynopsis" value="{{ old('synopsis') }}" />
                            @error('synopsis')
                            <div class="small text-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputYear">Year</label>
                            <input type="text" class="form-control" name="year" id="inputYear" value="{{ old('year') }}" />
                            @error('year')
                            <div class="small text-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputGenre">Genre</label>
                            <select class="form-control" name="genre_code" id="inputGenre">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->code }}" {{ old('genre_code') == $genre->code ? 'selected' : '' }}>{{ $genre->name }}</option>
                                @endforeach
                            </select>
                            @error('genre_code')
                            <div class="small text-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPoster">Poster</label>
                            <input type="file" class="form-control" name="poster" id="inputPoster" />
                            @error('poster')
                            <div class="small text-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </form>
                    @dump($errors)
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
