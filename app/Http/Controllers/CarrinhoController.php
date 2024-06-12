<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index(Request $request)
    {

        return view('cart.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }



    public function store_bilhete(Request $request, Screening $screening, Seat $seat)
    {
        $carrinho = $request->session()->get('carrinho', []);

        $screeningSeat = $screening->id + $seat->id;
        $carrinho[$screeningSeat] = [
            'id' => $screeningSeat,
            'movie' => $screening->movie->title,
            'poster_filename' => $screening->movie->poster_filename,
            'movie_id' => $screening->movie->id,
            'theater' => $screening->theater_id,
            'row' => $seat->row,
            'date' => $screening->date,
            'screening' => $screening->id,
            'hour' => $screening->start_time,
            'seat_number' => $seat->seat_number,
            'seat_id' => $seat->id
        ];

        $tamanhoCarrinho = count($carrinho);
        $request->session()->put('tamanhoCarrinho', $tamanhoCarrinho);

        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionado a sessao "' . $screening->id . '" ao carrinho!')
            ->with('alert-type', 'success');
    }

    public function update_carrinho(Request $request, Screening $screening, Seat $seat) {

        $carrinho = $request->session()->get('carrinho', []);

        $screeningSeat = $screening->id + $seat->id;

        $carrinho[$screeningSeat] = [
            'id' => $screeningSeat,
            'movie' => $screening->movie->title,
            'poster_filename' => $screening->movie->poster_filename,
            'movie_id' => $screening->movie->id,
            'theater' => $screening->theater_id,
            'row' => $seat->row,
            'date' => $screening->date,
            'screening' => $screening->id,
            'hour' => $screening->start_time,
            'seat_number' => $seat->seat_number,
            'seat_id' => $seat->id
        ];

        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', "Atualizado com sucesso")
            ->with('alert-type', 'success');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }

    public function destroy_bilhete(Request $request, Ticket $ticket) {
        $carrinho = $request->session()->get('carrinho', []);

        if (array_key_exists($ticket->id, $carrinho)) {
            unset($carrinho[$ticket->id]);

            $request->session()->put('carrinho', $carrinho);
            return back()
                ->with('alert-msg', 'Foram removidas todos os bilhetes do carrinho')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'O carrinho já estava limpo!')
            ->with('alert-type', 'warning');
    }

    public function carrinho_show(Request $request, $id)
    {
        $screening = Screening::find($id);
        $user    = auth()->user();
        $carrinho = $request->session()->get('carrinho', []);

        if($screening):
            return view('carrinho.index', compact('screening', 'user', 'carrinho','movie'));
        endif;
    }
}
