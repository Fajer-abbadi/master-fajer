<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailNotification;

class EmailNotificationsTableSeeder extends Seeder
{
    public function run()
    {
        // إدخال إشعارات تجريبية
        EmailNotification::create([
            'user_id' => 3, // Customer User
            'notification_type' => 'order_status',
            'message' => 'Your order has been shipped!',
            'sent_at' => now()
        ]);

        EmailNotification::create([
            'user_id' => 3, // Customer User
            'notification_type' => 'promotion',
            'message' => 'Check out our latest summer sales!',
            'sent_at' => now()
        ]);
    }
}

