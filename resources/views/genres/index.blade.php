@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Genres List</h1>
    <div class="mb-4">
        <a href="{{ route('genres.create') }}" class="btn btn-success">Create Genre</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($genres as $genre)
            <tr>
                <td>{{ $genre->code }}</td>
                <td>{{ $genre->name }}</td>
                <td>
                    <a href="{{ route('genres.edit', $genre->code) }}" class="btn btn-warning btn-sm">Edit</a>
                    @if($genre->trashed())
                        <form action="{{ route('genres.restore', $genre->code) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to restore this genre?');">Restore</button>
                        </form>
                    @else
                        <form action="{{ route('genres.destroy', $genre->code) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this genre?');">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
