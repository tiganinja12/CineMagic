<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code', 'name'
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'genre_code', 'code');
    }
}