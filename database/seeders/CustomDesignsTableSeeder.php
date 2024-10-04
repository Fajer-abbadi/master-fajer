<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomDesign;

class CustomDesignsTableSeeder extends Seeder
{
    public function run()
    {
        // إدخال تصاميم مخصصة تجريبية
        CustomDesign::create([
            'user_id' => 3, // Customer User
            'design_data' => json_encode(['color' => 'red', 'fabric' => 'cotton']),
            'delivery_time' => '2023-09-15'
        ]);
    }
}

