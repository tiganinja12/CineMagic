@extends('layouts.app')
@section('title', 'Historico de compras')

@section('content')
<div class="movie-info bord-b border-white ml-8 mr-8">
    <h2 class="text-4xl text-white font-semibold mb-4">Purchases</h2>

    <div class="filme_sessoes border-b border-gray-400">
        <div class="container mx-auto px-4 py-16">
            <br>
            @if($purchases->isNotEmpty())
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Payment Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                        <tr class="bg-slate-800 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-semibold text-white whitespace-nowrap">
                                {{ $purchase->date }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $purchase->payment_type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $purchase->total_price }} €
                            </td>
                            <td class="text-center">
                                <a href="{{ route('purchases.show_ticket', $purchase) }}">
                                    <button type="button" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 h-10">Mostrar bilhetes</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('tickets.all_tickets_pdf') }}">
                <button type="button" class="text-white bg-gradient-to-br from-green-500 to-blue-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 h-10">Download PDF de todos os bilhetes</button>
            </a>
            @else
            <p class="text-center text-white font-bold">Este user não possui recibos! :|</p>
            @endif
        </div>
        {{ $purchases->withQueryString()->links() }}
        <br>
    </div>
    <br>
</div>
@endsection
