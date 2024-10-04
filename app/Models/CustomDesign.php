<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomDesign extends Model
{
    protected $fillable = [
        'user_id', 'design_data', 'delivery_time',
    ];

    // علاقة مع المستخدمين (Users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

