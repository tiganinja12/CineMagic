@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Total Ticket Sales by Year</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Year</th>
                <th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ticketSalesByYear as $sales)
                <tr>
                    <td>{{ $sales->year }}</td>
                    <td>{{ $sales->total_sales }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ticketSalesByYear->links() }}
</div>
@endsection
