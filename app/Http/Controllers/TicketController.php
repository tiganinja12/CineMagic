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
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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


    public function checkTicket(Request $request)
    {
        $ticketId = $request->input('ticket_id');


        // Encontre o bilhete pelo ID
        $ticket = Ticket::find($ticketId);

        // Verifique se o bilhete existe
        if (!$ticket) {
            return back()->with('alert-msg', 'Bilhete não encontrado')->with('alert-type', 'danger');
        }

        // Verifique o status do bilhete
        if ($ticket->status == 'valid') {
            // Atualize o status do bilhete para inválido
            $ticket->status = 'invalid';
            $ticket->save();

            return back()->with('alert-msg', 'Bilhete era válido e agora foi invalidado')->with('alert-type', 'success');
        }

        return back()->with('alert-msg', 'Bilhete é inválido')->with('alert-type', 'danger');
    }

    public function show(Ticket $ticket)
    {
        // Load the related models
        $ticket->load('purchase.customer.user', 'screening.movie', 'screening.theater', 'seat');

        // Get the user
        $user = $ticket->purchase->customer->user;

        // Return the view with the ticket and user data
        return view('tickets.show', compact('ticket', 'user'));
    }


    public function downloadTicketPDF(Ticket $ticket)
    {
        $ticket->load('purchase.customer.user', 'screening.movie', 'screening.theater', 'seat');

        $user = $ticket->purchase->customer->user;

        $pdf = PDF::loadView('tickets.pdf', [
            'user' => $user,
            'ticket' => $ticket,
            'movie' => $ticket->screening->movie,
            'theater' => $ticket->screening->theater,
            'purchase' => $ticket->purchase,
            'screening' => $ticket->screening,
            'seat' => $ticket->seat
        ]);

        return $pdf->download('ticket_' . $ticket->id . '.pdf');
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

    public function showCart(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $customer = Customer::find(Auth::user()->id);

        return view('cart', compact('carrinho', 'customer'));
    }

    public function create(Request $request)
    {
        $configuration = Configuration::first();
        $carrinho = $request->session()->get('carrinho', []);
        $customer = Customer::find(Auth::user()->id);

        // Validate the inputs
        $validatedData = $request->validate([
            'payment_type' => 'required|string',
            'nif' => 'nullable|digits:9',
            'payment_ref' => 'nullable|digits:16',
        ]);

        // Update customer with the latest inputs
        $customer->update([
            'payment_type' => $validatedData['payment_type'],
            'nif' => $validatedData['nif'] ?? $customer->nif,
            'payment_ref' => $validatedData['payment_ref'] ?? $customer->payment_ref,
        ]);

        // Create the purchase
        $purchase = Purchase::create([
            'customer_id' => $customer->id,
            'date' => date('Y-m-d'),
            'customer_email' => $customer->user->email,
            'discount' => $configuration->registered_customer_ticket_discount,
            'total_price' => ($configuration->ticket_price - $configuration->registered_customer_ticket_discount) * count($carrinho),
            'nif' => $validatedData['nif'], // Use input NIF
            'payment_type' => $validatedData['payment_type'], // Use selected payment type
            'payment_ref' => $validatedData['payment_ref'], // Use input payment reference
            'screening_id' => $request->screening_id,
            'seat_id' => $request->seat_id,
            'customer_name' => Auth::user()->name
        ]);

        // Create the tickets
        foreach ($carrinho as $row) {
            $ticket = Ticket::create([
                'customer_id' => $customer->id,
                'screening_id' => $row['screening'],
                'seat_id' => $row['seat_id'],
                'price' => $configuration->ticket_price,
                'purchase_id' => $purchase->id,
                'status' => 'valid'
            ]);

            // Generate QR code URL
            $qrCodeUrl = route('tickets.show', $ticket->id) . '?token=' . bin2hex(random_bytes(16));

            // Save the QR code URL
            $ticket->update(['qrcode_url' => $qrCodeUrl]);
        }

        // Clear the cart session
        $request->session()->forget('carrinho');

        return back()
            ->with('alert-msg', 'Bilhetes comprados com sucesso!')
            ->with('alert-type', 'danger');
    }
}
