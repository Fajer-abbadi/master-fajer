<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'country', 'phone', 'user_id'
    ];

    // العلاقة مع موديل User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
