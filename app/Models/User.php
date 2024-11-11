<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',  'profile_image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // علاقة مع الطلبات (Orders)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // علاقة مع التصاميم المخصصة (Custom Designs)
    public function customDesigns()
    {
        return $this->hasMany(CustomDesign::class);
    }

    // علاقة مع المراجعات (Reviews)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // علاقة مع الإشعارات البريدية (Email Notifications)
    public function emailNotifications()
    {
        return $this->hasMany(EmailNotification::class);
    }

    // التحقق من دور المستخدم
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }
    public function billingInformation()
    {
        return $this->hasOne(BillingInformation::class);
    }
}
