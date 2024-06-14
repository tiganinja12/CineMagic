@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Average Ticket Sales By Movie</h1>

    <form method="GET" action="{{ route('statistics.averageSalesByMovie') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Search by movie title" value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <select name="genre" class="form-control">
                    <option value="">All Genres</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->code }}" {{ request('genre') == $genre->code ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Movie Title</th>
                <th>Average Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($averageSalesByMovie as $sale)
                <tr>
                    <td>{{ $sale->title }}</td>
                    <td>{{ number_format($sale->average_sales, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $averageSalesByMovie->links() }}
</div>
@endsection
