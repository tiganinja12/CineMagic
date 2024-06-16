@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ticket Details</div>
                    <div class="card-body">
                        <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
                        <p><strong>Customer:</strong> {{ $user->name }}</p>
                        <p><strong>Movie:</strong> {{ $ticket->screening->movie->title }}</p>
                        <p><strong>Theater:</strong> {{ $ticket->screening->theater->name }}</p>
                        <p><strong>Date:</strong> {{ $ticket->screening->date }}</p>
                        <p><strong>Time:</strong> {{ $ticket->screening->start_time }}</p>
                        <p><strong>Seat:</strong> {{ $ticket->seat->row }}-{{ $ticket->seat->seat_number }}</p>
                        <div>
                            <img src="{{ asset('storage/' . $ticket->qrcode_url) }}" alt="QR Code">
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('tickets.downloadTicketPDF', $ticket->id) }}" class="btn btn-primary">Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
