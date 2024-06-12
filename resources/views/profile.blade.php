@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <img src="{{ $user->photo_filename }}" alt="Profile Picture" class="rounded-circle" width="100" height="100">
                    <h4>{{ $user->name }}</h4>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
