<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    protected $fillable = [
        'orderid',
        'userid',
        'username',
        'description',
        'price',
        'order_status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relationship commented out until OrderItem model is created
    /*
    public function orderItems() 
    {
        return $this->hasMany(OrderItem::class);
    }
    */
}
