<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total_amount', 'status_id',
    ];

    // علاقة مع المستخدمين (Users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة مع حالات الطلبات (Statuses)
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // علاقة مع عناصر الطلبات (Order Items)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

