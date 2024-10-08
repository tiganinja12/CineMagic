@extends('layouts.app')
@section('title', 'Historico de compras')
@section('content')

<div class="movie-info bord-b border-white ml-8 mr-8">
    <h2 class="text-4xl text-white font-semibold mb-4 "> Bilhetes</h2>

    <div class="filme_sessoes border-b border-gray-400">
        <div class="container  mx-auto px-4 py-16">
            <br>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Screening
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Seat
                            </th>
                            <th scope="col" class="text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($tickets as $ticket )
                        <tr class="bg-slate-800 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-semibold text-white whitespace-nowrap">
                                {{$ticket->id}}
                            </th>
                            <td class="px-6 py-4">
                                {{$ticket->sessao_id}}
                            </td>
                            <td class="px-6 py-4">
                                {{$ticket->lugar_id}}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('tickets.show', $ticket) }}">
                                    <button type="button" class="text-white bg-gradient-to-br from-blue-500 to-blue-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 h-10">
                                        View Ticket
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$tickets->withQueryString()->links()}}
        <br>
    </div>
    <br>
</div>
@endsection
