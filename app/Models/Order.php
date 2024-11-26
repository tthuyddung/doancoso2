<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Add 'product_id' to the fillable array
    protected $fillable = [
        'user_id',
        'product_id',      // <-- Add this line
        'name',
        'number',
        'email',
        'method',
        'destination',
        'address',
        'rental_hours',
        'total_price',
        'total_products',
         'payment_status'
    ];
}
