@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="nif">NIF Number</label>
            <input type="text" class="form-control" id="nif" name="nif" value="{{ $user->customer->nif ?? '' }}">
        </div>
        <div class="form-group">
            <label for="payment_ref">Default Payment Details</label>
            <input type="text" class="form-control" id="payment_ref" name="payment_ref" value="{{ $user->customer->payment_ref ?? '' }}">
        </div>
        <div class="form-group">
            <label for="photo_filename">Photo</label>
            <input type="file" class="form-control" id="photo_filename" name="photo_filename">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
