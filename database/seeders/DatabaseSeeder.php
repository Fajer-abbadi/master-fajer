<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            statusTableSeeder::class,
            CouponsTableSeeder::class,
            OrdersTableSeeder::class,
            ImagesTableSeeder::class,
            ReviewsTableSeeder::class,
            StoresTableSeeder::class,
            SkinToneSeeder::class,
            OrderItemsTableSeeder::class,
            CustomDesignsTableSeeder::class,
        ]);
    }
}
