@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Theater</h1>

    <form method="POST" action="{{ route('theaters.update', $theater->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $theater->name }}" required>
        </div>
        <div class="mb-3">
            <label for="photo_filename" class="form-label">Photo</label>
            <input type="file" name="photo_filename" id="photo_filename" class="form-control">
            @if ($theater->photo_filename)
                <img src="{{ asset('storage/' . $theater->photo_filename) }}" alt="Theater Photo" class="img-thumbnail" width="150">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Theater</button>
    </form>
</div>
@endsection
