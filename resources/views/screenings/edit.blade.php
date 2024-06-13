@extends('layouts.app')
@section('title', 'Alterar Sessão')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Editar Sessão #{{ $screening->id }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('screenings.update', $screening) }}" class="form-group">
                            @csrf
                            @method('PUT')
                            @include('screenings.create-edit', ['screening' => $screening, 'movies' => $movies, 'theaters' => $theaters])
                            <div class="form-group text-right mt-3">
                                <input type="submit" class="btn btn-success" value="Update">
                                <a href="{{ route('screenings.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
