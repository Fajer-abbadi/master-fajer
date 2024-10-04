<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    // علاقة مع المنتجات (Products)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
