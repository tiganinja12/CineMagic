@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Total Ticket Sales by Month</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ticketSalesByMonth as $sales)
                <tr>
                    <td>{{ $sales->year }}</td>
                    <td>{{ $sales->month }}</td>
                    <td>{{ $sales->total_sales }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ticketSalesByMonth->links() }}
</div>
@endsection
