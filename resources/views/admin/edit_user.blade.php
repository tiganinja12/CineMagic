@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    @if(session('alert-msg'))
        <div class="alert alert-{{ session('alert-type') }}">
            {{ session('alert-msg') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="A" {{ $user->type == 'A' ? 'selected' : '' }}>Admin</option>
                <option value="E" {{ $user->type == 'E' ? 'selected' : '' }}>Employee</option>
                <option value="C" {{ $user->type == 'C' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
