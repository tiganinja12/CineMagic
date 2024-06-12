@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>
    @if(session('alert-msg'))
        <div class="alert alert-{{ session('alert-type') }}">
            {{ session('alert-msg') }}
        </div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
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
            <label for="nif">NIF Number</label>
            <input type="text" class="form-control" id="nif" name="nif" value="{{ old('nif', $customer->nif ?? '') }}">
        </div>
        <div class="form-group">
            <label for="payment_type">Default Payment Type</label>
            <select class="form-control" id="payment_type" name="payment_type">
                <option value="MBWAY" {{ old('payment_type', $customer->payment_type ?? '') == 'MBWAY' ? 'selected' : '' }}>MBWAY</option>
                <option value="PAYPAL" {{ old('payment_type', $customer->payment_type ?? '') == 'PAYPAL' ? 'selected' : '' }}>PAYPAL</option>
                <option value="VISA" {{ old('payment_type', $customer->payment_type ?? '') == 'VISA' ? 'selected' : '' }}>VISA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="payment_ref">Default Payment Details</label>
            <input type="text" class="form-control" id="payment_ref" name="payment_ref" value="{{ old('payment_ref', $customer->payment_ref ?? '') }}">
        </div>
        <div class="form-group">
            <label for="photo_filename">Photo</label>
            <input type="file" class="form-control" id="photo_filename" name="photo_filename">
            @if ($user->photo_filename)
                <img src="{{ asset('storage/photos/' . $user->photo_filename) }}" alt="Profile Photo" class="img-thumbnail" width="150">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
