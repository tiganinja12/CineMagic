<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'theater_id', 'row', 'seat_number'
    ];

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}