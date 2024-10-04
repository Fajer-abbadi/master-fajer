<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class statusTableSeeder extends Seeder
{
    public function run()
    {
        Status::create(['name' => 'Pending', 'description' => 'Order is pending approval']);
        Status::create(['name' => 'Processing', 'description' => 'Order is being processed']);
        Status::create(['name' => 'Shipped', 'description' => 'Order has been shipped']);
        Status::create(['name' => 'Delivered', 'description' => 'Order has been delivered']);
    }
}
