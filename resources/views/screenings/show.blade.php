@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ $screening->movie->title }}</div>
                <div class="card-body">
                    <p><strong>Theater:</strong> {{ $screening->theater->name }}</p>
                    <p><strong>Date:</strong> {{ $screening->date }}</p>
                    <p><strong>Start Time:</strong> {{ $screening->start_time }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
