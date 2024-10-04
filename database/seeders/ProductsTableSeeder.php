<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Basic T-Shirt',
            'description' => 'A simple, versatile t-shirt.',
            'price' => 10.99,
            'category_id' => 1, // Assuming 'Tops' is the first category
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Jeans',
            'description' => 'Classic blue jeans.',
            'price' => 29.99,
            'category_id' => 2, // Assuming 'Bottoms' is the second category
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Summer Dress',
            'description' => 'A lightweight dress for summer.',
            'price' => 39.99,
            'category_id' => 3, // Assuming 'Dresses' is the third category
            'stock' => 30,
        ]);
    }
}
