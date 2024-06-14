<!-- resources/views/theaters/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Theater List</h1>

    <form method="GET" action="{{ route('theaters.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="mb-4">
        <a href="{{ route('theaters.create') }}" class="btn btn-success">Create Theater</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($theaters as $theater)
            <tr>
                <td>{{ $theater->name }}</td>
                <td>
                    @if($theater->photo_filename)
                        <img src="{{ asset('storage/' . $theater->photo_filename) }}" alt="Theater Photo" class="img-thumbnail" width="100">
                    @else
                        No Photo
                    @endif
                </td>
                <td>
                    <a href="{{ route('theaters.edit', $theater->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('theaters.softDelete', $theater->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to soft delete this theater?');">Soft Delete</button>
                    </form>
                    @if($theater->trashed())
                        <form action="{{ route('theaters.restore', $theater->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                        </form>
                    @endif
                    <a href="{{ route('theaters.show', $theater->id) }}" class="btn btn-primary btn-sm">Manage Seats</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
