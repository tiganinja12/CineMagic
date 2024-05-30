<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screening extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'movie_id', 'theater_id', 'date', 'start_time'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}