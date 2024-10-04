<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price',
    ];

    // علاقة مع الطلبات (Orders)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // علاقة مع المنتجات (Products)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

