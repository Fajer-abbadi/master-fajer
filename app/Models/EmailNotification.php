<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $fillable = [
        'user_id', 'notification_type', 'message', 'sent_at',
    ];

    // علاقة مع المستخدمين (Users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

