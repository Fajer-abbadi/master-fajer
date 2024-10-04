<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // إدخال مراجعات تجريبية
        Review::create([
            'user_id' => 3, // Customer User
            'product_id' => 1, // Summer Dress
            'rating' => 5,
            'comment' => 'Loved this dress, very stylish!'
        ]);

        Review::create([
            'user_id' => 3, // Customer User
            'product_id' => 2, // Running Shoes
            'rating' => 4,
            'comment' => 'Very comfortable shoes for running!'
        ]);
    }
}

