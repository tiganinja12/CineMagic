<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'nif',
        'customer_name',
        'payment_type',
        'payment_ref',
        'customer_id',
        'date',
        'total_price',
        'customer_email',
    ];

    public function Customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id') -> withTrashed();
    }

    public function Tickets() {
        return $this->hasMany(Ticket::class, 'ticket_id', 'id');
    }
}
