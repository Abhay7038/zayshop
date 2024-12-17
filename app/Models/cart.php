<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'product_image',
        'description',
        'sid',
        'brand',
        'price',
        'total_price',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public static function clear()
    {
        // Logic to clear the cart
        // For example:
        $cartItems = Cart::all();
    
        // Delete each cart item individually
        $cartItems->each(function ($item) {
            $item->delete();
        });
    }
}


