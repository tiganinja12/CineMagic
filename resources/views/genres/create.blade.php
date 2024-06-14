@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Genre</h1>
    <form method="POST" action="{{ route('genres.store') }}">
        @csrf
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Genre</button>
    </form>
</div>
@endsection
