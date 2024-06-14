<!-- resources/views/theaters/seats/bulk_create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bulk Generate Seats for {{ $theater->name }}</h1>

    <form method="POST" action="{{ route('theaters.seats.bulkStore', $theater->id) }}">
        @csrf
        <div class="form-group">
            <label for="start_row">Start Row</label>
            <input type="text" class="form-control" id="start_row" name="start_row" required>
        </div>
        <div class="form-group">
            <label for="end_row">End Row</label>
            <input type="text" class="form-control" id="end_row" name="end_row" required>
        </div>
        <div class="form-group">
            <label for="start_seat">Start Seat Number</label>
            <input type="number" class="form-control" id="start_seat" name="start_seat" required>
        </div>
        <div class="form-group">
            <label for="end_seat">End Seat Number</label>
            <input type="number" class="form-control" id="end_seat" name="end_seat" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Seats</button>
    </form>
</div>
@endsection
