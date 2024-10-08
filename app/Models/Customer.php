<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nif', 'payment_type', 'payment_ref'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id') -> withTrashed();

    }

    public function purchases() {
        return $this->hasMany(Purchase::class, 'customer_id', 'id');
    }

}

