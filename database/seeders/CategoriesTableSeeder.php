<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // التصنيفات الأساسية الموجودة
        Category::create(['name' => 'Tops']);
        Category::create(['name' => 'Bottoms']);
        Category::create(['name' => 'Dresses']);
        Category::create(['name' => 'Outerwear']);

        // التصنيفات الجديدة التي طلبتِ إضافتها
        Category::create(['name' => 'Heels']);
        Category::create(['name' => 'Accessories']);
        Category::create(['name' => 'Hijabs']);
        Category::create(['name' => 'Jackets']);
        Category::create(['name' => 'Hoodies']);
        Category::create(['name' => 'Skirts']);
        Category::create(['name' => 'Abayas']);
        Category::create(['name' => 'Jumpsuits']);
    }
}

