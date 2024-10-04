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

            OrdersTableSeeder::class,
            ImagesTableSeeder::class,
        ]);
    }
}