@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Statistics</h1>
    <div class="list-group">
        <a href="{{ route('statistics.ticketSalesByMonth') }}" class="list-group-item list-group-item-action">Total Ticket Sales by Month</a>
        <a href="{{ route('statistics.ticketSalesByYear') }}" class="list-group-item list-group-item-action">Total Ticket Sales by Year</a>
        <a href="{{ route('statistics.averageSalesByMovie') }}" class="list-group-item list-group-item-action">Average Ticket Sales by Movie</a>
        <a href="{{ route('statistics.salesByCustomer') }}" class="list-group-item list-group-item-action">Ticket Sales by Customer</a>
    </div>
</div>
@endsection
