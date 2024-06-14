@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users List</h1>

    <form method="GET" action="{{ route('admin.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="type" class="form-control">
                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                    <option value="A" {{ request('type') == 'A' ? 'selected' : '' }}>Admin</option>
                    <option value="E" {{ request('type') == 'E' ? 'selected' : '' }}>Employee</option>
                    <option value="C" {{ request('type') == 'C' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="mb-4">
        <a href="{{ route('admin.create') }}" class="btn btn-success">Create User</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->type }}</td>
                <td>
                    <a href="{{ route('admin.show', $user->id) }}" class="btn btn-info btn-sm">Consult</a>
                    @if($user->type !== 'C')
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this user?');">Delete</button>
                        </form>
                    @else
                        @if($user->blocked)
                            <form action="{{ route('admin.unblock', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Unblock</button>
                            </form>
                        @else
                            <form action="{{ route('admin.block', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm">Block</button>
                            </form>
                        @endif

                        @if($user->trashed())
                            <form action="{{ route('admin.restore', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        @else
                            <form action="{{ route('admin.softDelete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to soft delete this user?');">Soft Delete</button>
                            </form>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
