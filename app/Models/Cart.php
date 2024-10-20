<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'product_id',
        'user_id',

        'quantity',
    ];

    // تعريف العلاقة مع جدول المنتجات
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

