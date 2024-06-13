@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Genre</h1>
    <form method="POST" action="{{ route('genres.update', $genre->code) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $genre->code }}" readonly>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $genre->name }}"
            required>
             </div>
             <button type="submit" class="btn btn-primary">Update Genre</button>
         </form>
     </div>
     @endsection

