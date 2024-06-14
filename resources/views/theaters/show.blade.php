<!-- resources/views/theaters/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $theater->name }}</h1>
    <a href="{{ route('theaters.seats.create', $theater->id) }}" class="btn btn-primary">Add Single Seat</a>
    <a href="{{ route('theaters.seats.bulkCreate', $theater->id) }}" class="btn btn-secondary">Bulk Generate Seats</a>

    <h2 class="mt-4">Seats</h2>
    @if($theater->seats->isEmpty())
        <p>No seats available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Row</th>
                    <th>Seat Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($theater->seats as $seat)
                <tr>
                    <td>{{ $seat->row }}</td>
                    <td>{{ $seat->seat_number }}</td>
                    <td>
                        <form action="{{ route('theaters.seats.destroy', [$theater->id, $seat->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this seat?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
