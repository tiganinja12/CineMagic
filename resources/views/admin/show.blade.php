@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <div class="card">
        <div class="card-header">{{ $user->name }}</div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Type:</strong> {{ $user->type }}</p>
            @if($user->photo_filename)
                <p><strong>Photo:</strong></p>
                <img src="{{ asset('storage/photos/' . $user->photo_filename) }}" alt="Profile Picture" class="img-thumbnail" width="150">
            @endif
        </div>
    </div>
</div>
@endsection
