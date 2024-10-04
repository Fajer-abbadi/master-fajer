<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'user_id' => 3, // Assuming 'Customer User' is the third user
            'total_amount' => 50.98,
            'status_id' => 1, // Assuming 'Pending' is the first status
        ]);

        Order::create([
            'user_id' => 3,
            'total_amount' => 29.99,
            'status_id' => 2, // Assuming 'Processing' is the second status
        ]);
    }
}
