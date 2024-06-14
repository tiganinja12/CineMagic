<!-- resources/views/theaters/seats/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Seat for {{ $theater->name }}</h1>

    <form method="POST" action="{{ route('theaters.seats.store', $theater->id) }}">
        @csrf
        <div class="form-group">
            <label for="row">Row</label>
            <input type="text" class="form-control" id="row" name="row" required>
        </div>
        <div class="form-group">
            <label for="seat_number">Seat Number</label>
            <input type="number" class="form-control" id="seat_number" name="seat_number" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Seat</button>
    </form>
</div>
@endsection
