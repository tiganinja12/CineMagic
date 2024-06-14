@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Average Ticket Sales by Movie</h1>

    <form method="GET" action="{{ route('statistics.averageSalesByMovie') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <select name="genre" class="form-select">
                    <option value="">All Genres</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->code }}" {{ request('genre') == $genre->code ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="Movie Name" value="{{ request('name') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Movie</th>
                <th>Average Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($averageSalesByMovie as $sales)
                <tr>
                    <td>{{ $sales->title }}</td>
                    <td>{{ $sales->average_sales }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $averageSalesByMovie->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>
@endsection
