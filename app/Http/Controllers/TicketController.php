<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationPost;
use App\Models\Configuration;
use PDF;
use App\Models\Customer;
use App\Models\Movie;
use App\Models\Purchase;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Theater;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function admin_index(Request $request)
    {
        $purchase = $request->purchase ?? '';
        $customer = $request->customer ?? '';
        $screening = $request->screening ?? '';
        $seat = $request->seat ?? '';

        $qry = Ticket::query();
        if ($purchase) {
            $qry->where('purchase_id', $purchase);
        }
        if ($customer) {
            $qry->where('cliente_id', $customer);
        }
        if ($screening) {
            $qry->where('sessao_id', $screening);
        }
        if ($seat) {
            $qry->where('seat_id', $seat);
        }

        $tickets = $qry->paginate(10);
        $purchases = Purchase::pluck('nome', 'code');
        $customers = Customer::pluck('nome', 'code');
        $screenings = Screening::pluck('nome', 'code');
        $seats = Seat::pluck('nome', 'code');

        return view('bilhetes.admin', compact('tickets', 'purchases', 'customers', 'screenings', 'seats', 'purchase', 'customer', 'screening', 'seat'));

    }


    public function invalidar_invalidardex(Request $request)
    {
        $ticket = Ticket::find($request->id);
        if($ticket->status == 'valid') {
            $ticket->status = 'invalid';
            $ticket->save();
            return back()->with('alert-msg', 'Bilhete válido!')->with('alert-type', 'success');
        }

        $ticket->save();
        return back()->with('alert-msg', 'Bilhete invalidado!')->with('alert-type', 'success');

    }

    public function downloadBilhetePDF(Ticket $ticket)
    {
        $screening=Screening::find($ticket->screening_id);
        $movie=Movie::find($screening->movie_id);
        $purchase=Purchase::find($ticket->purchase_id);
        $theater=Theater::find($screening->theater_id);
        $seat=Seat::find($ticket->seat_id);
        $customer=Customer::find($ticket->customer_id);
        $user=User::find($customer->id);

        $pdf = PDF::loadView('ticket\pdf',compact('ticket','movie','purchase','theater','screening','seat','customer','user'));
        return $pdf->download('ticket.pdf');

    }


    public function edit(Ticket $ticket)
    {
        $purchases = Purchase::all();
        $customers = Customer::all();
        $screenings = Screening::all();
        $seats = Seat::all();
        return view('bilhetes.edit', compact('ticket', 'purchases', 'customers', 'screenings', 'seats'));
    }

    public function update(ConfigurationPost $request, Ticket $ticket)
    {
        $ticket->fill($request->validated());

        $ticket->save();

        return redirect()->route('admin.tickets')
            ->with('alert-msg', 'Bilhete foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }


    public function show(Request $request, Ticket $ticket)
    {
        $purchases = Purchase::pluck('nome', 'code');
        $purchase = $request->query('purchase');

        $ticket = Ticket::find($ticket->id);
        $screenings = $ticket->status()->paginate(6);


        return view('bilhetes.show', compact('purchases', 'purchase', 'ticket','screenings'));
    }

    public function create(Request $request) {

        $configuration = Configuration::first();
        $carrinho = $request->session()->get('carrinho', []);
        $customer = Customer::find(Auth::user()->id);

        //dd($customer->user);

        $purchase = Purchase::create([
            'customer_id' => $customer->id,
            'date' => date('Y-m-d'),
            'customer_email' => $customer->user->email,
            'discount' => $configuration->registered_customer_ticket_discount,
            'total_price' => ($configuration->preco_bilhete_sem_iva - $configuration->registered_customer_ticket_discount) * count($carrinho),
            'nif' => $customer->nif,
            'payment_type' => $customer->payment_type,
            'payment_ref' => $customer->payment_ref,
            'screening_id' => $request->screening_id,
            'seat_id' => $request->seat_id,
            'customer_name' => Auth::user()->name
        ]);

        $purchase->save();


        foreach($carrinho as $row) {
            $ticket = Ticket::create([
                'customer_id' => $customer->id,
                'screening_id' => $row['screening'],
                'seat_id' => $row['seat_id'],
                'price' => $configuration->ticket_price,
                'purchase_id' => $purchase->id,
                'status' => 'valid'
            ]);

            $ticket->save();
        }

        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Bilhetes comprados com sucesso!')
            ->with('alert-type', 'danger');
    }


}
