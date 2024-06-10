@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h5>New Movie</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('movies.shared.fields', ['movie' => $movie, 'genres' => $genres])
                        <div class="mt-3">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
