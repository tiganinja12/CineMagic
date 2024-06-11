<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'genre_code', 'year', 'poster_filename', 'synopsis', 'trailer_url',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_code', 'code');
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}
