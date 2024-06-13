@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Screenings') }}</div>
                <div class="card-body">
                    <a href="{{ route('screenings.create') }}" class="btn btn-primary mb-3">{{ __('Add Screening') }}</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Movie</th>
                                <th>Theater</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($screenings as $screening)
                                <tr>
                                    <td>{{ $screening->movie->title ?? 'No Movie' }}</td>
                                    <td>{{ $screening->theater->name ?? 'No Theater' }}</td>
                                    <td>{{ $screening->date }}</td>
                                    <td>{{ $screening->start_time }}</td>
                                    <td>
                                        <a href="{{ route('screenings.edit', $screening) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('screenings.destroy', $screening) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
