@extends('layouts.app')
@section('title', $movie->title)

@section('selectbar')
    <form class="d-md-flex input-group w-auto my-auto" method="GET" action="{{ route('movies.index') }}" class="form-group">
        <select class="custom-select" name="genero" id="inputgenero" aria-label="Genero">
            <option id="dropdown-button"value="" {{ '' == old('genre', $genre) ? 'selected' : '' }}>Todos Generos</option>
            @foreach ($genres as $code => $name)
                <option value={{ $code }} {{ $code == old('genre', $genre) ? 'selected' : '' }}>
                    {{ $name }}</option>
            @endforeach
        </select>
        <button type="submit"><span class="input-group-text border-0 h-10 border-white bg-slate-800 text-gray-100"><i
                    class="fas fa-search"></i></span></button>
    </form>
@endsection

@section('content')
    @if ($theater != null)
        <div class='ml-8 mr-8'>
            <div class="container mx-auto text-center flex justify-center h-screen">
                <div>
                    <h2 class="text-4xl text-white font-semibold mb-2"> {{ $movie->title }}</h2>
                    <div class="sm:flex text-gray-400  justify-center">

                        <span class="mx-1">{{ $theater->name }}</span>
                        <span class="mx-2">|</span>
                        <span class="mx-1">Data: {{ $screening->date }}</span>
                        <span class="mx-2">|</span>
                        <span class="mx-1">Hora: {{ $screening->start_time }}</span>

                    </div>
                    @guest
                        <h2 class="text-4xl text-white font-semibold mb-2">Escolha o seu lugar:</h2>
                    @endguest
                    @if (Auth::user() != null)

                        @if (Auth::user()->type == 'E')
                            <h2 class="text-4xl text-white font-semibold mb-2">Escolha o lugar para validar o bilhete:</h2>
                        @else
                            <h2 class="text-4xl text-white font-semibold mb-2">Escolha o seu lugar:</h2>
                        @endif
                    @endif
                    <table class='mt-5'>
                        <thead>
                            <tr>
                                <th></th>
                                @for ($j = 1; $j <= $columns; $j++)
                                    <th class='text-center text-l text-white'>{{ $j }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <th class='text-l text-white'>{{ $row->row }}</th>
                                    @foreach ($seats as $seat)
                                        @php($i = false)
                                        @foreach ($tickets as $ticket)
                                            @if ($seat->id == $ticket->seat_id)
                                                @php($i = true)
                                            @endif
                                        @endforeach
                                        @if (!$i && $seat->row == $row->row)
                                            <td>
                                                <form
                                                    action="{{ route('carrinho.bilhete.store', ['screening' => $screening, 'seat' => $seat]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="submit" value=""
                                                        class="w-12 h-12 m-2 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm text-center"></input>
                                                </form>
                                            </td>
                                        @elseif($i && $seat->row == $row->row)
                                            <th>
                                                @if (Auth::user() != null)
                                                    @if (Auth::user()->type == 'E')
                                                        @php($j = false)
                                                        @foreach ($invalidtickets as $bilhetesInvalido)
                                                            @if ($seat->id == $bilhetesInvalido->seat_id)
                                                                @php($j = true)
                                                            @endif
                                                        @endforeach
                                                        @if (!$j)
                                                            <form
                                                                action="{{ route('movies.show_validate', ['movie' => $movie, 'screening' => $screening, 'seat' => $seat]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="submit" value=""
                                                                    class="w-12 h-12  m-2 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm text-center"></input>
                                                            </form>
                                                        @else
                                                            <button disabled type="button"
                                                                class="w-12 h-12 m-2  text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm"></button>
                                                        @endif
                                                    @else
                                                        <button disabled type="button"
                                                            class="w-12 h-12 m-2  text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm"></button>
                                                    @endif
                                                @endif
                                            </th>
                                        @endif
                                    @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <h2 class="text-4xl text-white font-semibold mb-2">Não existe sala para ver este filme :|</h2>
    @endif
@endsection
