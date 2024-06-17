<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>All Tickets for {{ $user->name }}</h1>
    @foreach($purchases as $purchase)
        <h2>Purchase Date: {{ $purchase->date }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Screening</th>
                    <th>Seat</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchase->tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->screening_id }}</td>
                        <td>{{ $ticket->seat_id }}</td>
                        <td>{{ $ticket->price }} €</td>
                        <td>{{ $ticket->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    @endforeach
</body>
</html>
