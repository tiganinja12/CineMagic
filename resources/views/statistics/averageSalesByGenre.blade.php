@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Average Ticket Sales By Genre</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Genre</th>
                <th>Average Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($averageSalesByGenre as $sale)
                <tr>
                    <td>{{ $sale->name }}</td>
                    <td>{{ number_format($sale->average_sales, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $averageSalesByGenre->links() }}
</div>
@endsection
