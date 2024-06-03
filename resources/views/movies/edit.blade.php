@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h5>Edit Movie #{{ $movie->id }}</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('movies.update', $movie) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('movies.shared.fields')
                        <div class="mt-3">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
