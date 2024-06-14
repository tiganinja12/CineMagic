@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Total Ticket Sales By Year</h1>
    <div id="ticketSalesByYearChart" style="width: 900px; height: 500px;"></div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Total Sales'],
            @foreach($ticketSalesByYear as $sale)
                ['{{ $sale->year }}', {{ $sale->total_sales }}],
            @endforeach
        ]);

        var options = {
            title: 'Total Ticket Sales By Year',
            hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('ticketSalesByYearChart'));
        chart.draw(data, options);
    }
</script>
@endsection
