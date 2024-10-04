<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'rating', 'comment',
    ];

    // علاقة مع المستخدمين (Users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة مع المنتجات (Products)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

