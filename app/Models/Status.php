<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // تحديد اسم الجدول إذا كان مختلفًا عن الاسم الافتراضي
    protected $table = 'status';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'name', 'description',
    ];

    // علاقة مع الطلبات (Orders)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
