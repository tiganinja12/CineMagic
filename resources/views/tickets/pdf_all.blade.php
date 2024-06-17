<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tickets PDF</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Purchase Details</h2>
        <p><strong>Customer:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Purchase ID:</strong> {{ $purchase->id }}</p>
        <p><strong>Date:</strong> {{ $purchase->date }}</p>

        <h3 class="text-lg font-semibold mt-6 mb-4">Tickets</h3>
        @foreach($tickets as $ticket)
            <div class="border p-4 mb-4">
                <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
                <p><strong>Movie:</strong> {{ $ticket->screening->movie->title }}</p>
                <p><strong>Theater:</strong> {{ $ticket->screening->theater->name }}</p>
                <p><strong>Date:</strong> {{ $ticket->screening->date }}</p>
                <p><strong>Time:</strong> {{ $ticket->screening->start_time }}</p>
                <p><strong>Seat:</strong> {{ $ticket->seat->row }}-{{ $ticket->seat->seat_number }}</p>
                <div>
                    <img src="{{ asset('storage/' . $ticket->qrcode_url) }}" alt="QR Code">
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
