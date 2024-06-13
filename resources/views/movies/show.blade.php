@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ $movie->title }}</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="{{ $movie->poster_filename ? asset('storage/posters/' . $movie->poster_filename) : asset('storage/posters/default.png') }}"
                                style="width:10rem;height:15rem;" alt="{{ $movie->title }}">
                        </div>
                        <p><strong>Genre:</strong> {{ $movie->genre->name ?? 'No Genre' }}</p>
                        <p><strong>Year:</strong> {{ $movie->year }}</p>
                        <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
                        @if ($movie->trailer_url)
                            <a href="{{ $movie->trailer_url }}" class="btn btn-primary" target="_blank">Watch Trailer</a>
                        @endif
                        <div class="filme_sessoes border-b border-gray-400">
                            <div class="container mx-auto px-4 py-16">
                                <h2 class="text-4xl text-white font-semibold">Sessoes</h2>
                                <br>
                                @if ($screenings->count())
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Data
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Horario
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Sala
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-center">
                                                        Comprar
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($screenings as $screening)
                                                    <tr class="bg-slate-800 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                        <th scope="row" class="px-6 py-4 font-semibold text-white whitespace-nowrap">
                                                            {{ $screening->date }}
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            {{ $screening->start_time }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ $screening->theater_id }}
                                                        </td>
                                                        <td class="px-6 py-4 text-center">
                                                            <a
                                                            href="{{ route('movies.show_session', ['movie' => $movie, 'screening' => $screening]) }}">
                                                            <button type="button"
                                                                class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 h-10"><i
                                                                    class="fa fa-shopping-cart text-white"></i></button>
                                                        </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-center text-white font-bold">Este filme não tem sessões 😔!</p>
                                @endif
                                <!-- Pagination -->
                                <div class="mt-1">
                                    {{ $screenings }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
