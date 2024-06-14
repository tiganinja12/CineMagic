@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ticket Sales by Customer</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Total Spent</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salesByCustomer as $sales)
                <tr>
                    <td>{{ $sales->name }}</td>
                    <td>{{ $sales->total_spent }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $salesByCustomer->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>
@endsection
