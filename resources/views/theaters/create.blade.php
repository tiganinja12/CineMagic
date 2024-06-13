@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Theater</h1>

    <form method="POST" action="{{ route('theaters.store') }}" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Theater Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter theater name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="photo_filename">Photo</label>
            <input type="file" name="photo_filename" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Create Theater</button>
    </form>
</div>
@endsection
