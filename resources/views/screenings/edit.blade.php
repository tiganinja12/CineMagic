@extends('layouts.app')
@section('title','Alterar Sessão' )
@section('content')
    <form method="POST" action="{{route('screenings.update', ['screening' => $screening]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('screenings.create-edit')
        <input type="hidden" name="date" value="{{$screening->date}}">
        <input type="hidden" name="start_time" value="{{$screening->start_time}}">
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('screenings.edit', ['screening' => $screening]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
