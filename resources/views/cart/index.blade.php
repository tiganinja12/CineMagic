@extends('layouts.app')
@section('title', 'Carrinho')
@section('content')

<div class="filme_sessoes border-b border-gray-400">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl text-white font-semibold">Carrinho</h2>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Filme</th>
                        <th scope="col" class="px-6 py-3">opcoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrinho as $row)
                    <tr class="bg-slate-800 border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            <div class="container mx-auto sm:flex">
                                <img src="{{ $row['poster_filename'] ? asset('storage/posters/' . $row['poster_filename']) : asset('storage/posters/default.png') }}"
                                    class="card-img-top p-3" style="max-width: 150px; max-height: 200px;"
                                    alt="{{ $row['movie'] }}">
                                <div class="md:ml-16 mt-10">
                                    <h2 class="text-2xl text-white font-semibold "> {{ $row['movie'] }}</h2>
                                    <p class="mx-1">Data: {{ $row['date'] }}</p>
                                    <p class="mx-1">Horas: {{ $row['hour'] }}</p>
                                    <p class="mx-1">Lugar: {{ $row['row'] }}{{ $row['seat_number'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="w-80">
                            <div>
                                <a href="{{ route('movies.show_session', ['movie' => $row['movie_id'], 'screening' => $row['screening']]) }}">
                                    <button type="submit"
                                        class="w-64 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Adicionar
                                        mais um bilhete</button>
                                </a>
                                <p></p>
                                <form action="{{ route('carrinho.bilhete.destroy', ['ticket' => $row['id']]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-64 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Apagar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="sm:flex justify-between text-gray-400 mt-2">
            <form action="{{ route('carrinho.destroy') }}" method="POST" class="mb-2">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-64 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Apagar carrinho
                </button>
            </form>

            @auth
            @if (is_null(Auth::user()->customer))
            <a>O USER E O QUE: {{ is_null(Auth::user()->customer) }}</a>
            @if (Auth::user()->type == 'C')
            @endif
            @else
            <div class="mb-2">
                <a href="#" data-toggle="modal" data-target="#payModal">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Pagar
                    </button>
                </a>
            </div>
            @endif
            @endauth
        </div>

        @guest
        <a href="{{ route('login') }}">
            <button type="button"
                class="w-64 mt-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Tem
                de efetuar o login para proceder à compra</button>
        </a>
        @endguest

        <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-slate-800">
            <div class="modal-body text-center">
                <h5 class="text-black" id="payModalLabel">Pretende proceder ao pagamento?</h5>
                <br>
                <form action="{{ route('bilheteira.create') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="payment_type" class="text-white">Tipo de Pagamento</label>
                        <select name="payment_type" id="payment_type" class="form-control">
                            <option value="VISA" {{ Auth::user()->customer->payment_type == 'VISA' ? 'selected' : '' }}>VISA</option>
                            <option value="PAYPAL" {{ Auth::user()->customer->payment_type == 'PAYPAL' ? 'selected' : '' }}>PAYPAL</option>
                            <option value="MBWAY" {{ Auth::user()->customer->payment_type == 'MBWAY' ? 'selected' : '' }}>MBWAY</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="nif" class="text-black">NIF</label>
                        <input type="text" name="nif" id="nif" class="form-control" value="{{ Auth::user()->customer->nif }}">
                        @if ($errors->has('nif'))
                            <span class="text-red-500">{{ $errors->first('nif') }}</span>
                        @endif
                    </div>
                    <div class="form-group mt-3">
                        <label for="payment_ref" class="text-black">Referência de Pagamento</label>
                        <input type="text" name="payment_ref" id="payment_ref" class="form-control" value="{{ Auth::user()->customer->payment_ref }}">
                        @if ($errors->has('payment_ref'))
                            <span class="text-red-500">{{ $errors->first('payment_ref') }}</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-center mt-4">
                        <button type="submit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Sim</button>
                        <button data-dismiss="modal" type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Nao</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



        @endsection