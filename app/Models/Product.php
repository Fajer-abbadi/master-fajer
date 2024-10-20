<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'stock', 'category_id', 'store_id',
    ];

    // علاقة مع التصنيفات (Categories)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // علاقة مع المتاجر (Stores)
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // علاقة مع الصور (Images)
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // علاقة مع عناصر الطلبات (Order Items)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // علاقة مع المراجعات (Reviews)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

