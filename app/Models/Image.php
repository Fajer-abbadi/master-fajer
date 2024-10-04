<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id', 'image_url',
    ];

    // علاقة مع المنتجات (Products)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

