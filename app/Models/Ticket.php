<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'screening_id', 'seat_id', 'purchase_id', 'price', 'qrcode_url', 'status'
    ];

    public function screening()
    {
        return $this->belongsTo(Screening::class, 'screening_id', 'id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

}
