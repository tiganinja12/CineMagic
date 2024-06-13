<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'code', 'name'
    ];

    public $timestamps = false;

    public function movies()
    {
        return $this->hasMany(Movie::class, 'genre_code', 'code');
    }

    public function hasActiveScreenings()
    {
        foreach ($this->movies as $movie) {
            if ($movie->screenings()->where('date', '>=', now())->count() > 0) {
                return true;
            }
        }
        return false;
    }
}