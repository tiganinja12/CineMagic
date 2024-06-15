<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Ticket;

class PurchaseController extends Controller
{



    public function show(Request $request,User $user)
    {

        $qry=Purchase::query();
        if($user){
            $qry->where('customer_id',$user->id)->orderBy('date', 'desc');
        }
        $purchases=$qry->paginate(50);


        return view('purchases.show', compact('purchases', 'user'));
    }



    public function show_ticket(Request $request,Purchase $purchase)
    {
        $tickets=Ticket::where('purchase_id',$purchase->id);

        $tickets=$tickets->paginate(50);

        return view('purchases.show_ticket', compact('purchase', 'tickets'));
    }



}
