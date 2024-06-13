@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Change Password</h1>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
            @error('new_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>
@endsection
