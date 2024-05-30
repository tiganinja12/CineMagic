<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'screening_id', 'seat_id', 'purchase_id', 'price', 'qrcode_url', 'status'
    ];

    public function screening()
    {
        return $this->belongsTo(Screening::class);
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