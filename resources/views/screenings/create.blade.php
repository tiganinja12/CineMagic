@extends('layouts.app')
@section('title', 'Nova Sessão' )
@section('content')
    <form method="POST" action="{{route('screenings.store')}}" class="form-group">
        @csrf
        @include('screenings.create_screen')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('screenings.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
