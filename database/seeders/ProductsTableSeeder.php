<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Products for the 'Tops' category
        Product::create([
            'name' => 'Basic T-Shirt',
            'description' => 'A simple, versatile t-shirt.',
            'price' => 34.99,
            'category_id' => 1,
            'stock' => 100,
            'size' => 'S',
            'color' => 'black',
            'is_hot' => 0,
            'discount_price' => 0,

        ]);

        Product::create([
            'name' => 'Long Sleeve Shirt',
            'description' => 'A classic long sleeve shirt.',
            'price' => 25.99,
            'category_id' => 1,
            'stock' => 80,
            'size' => 'S',
            'color' => 'black',
            'is_hot' => 0,
            'discount_price' => 0,
        ]);

        Product::create([
            'name' => 'Tank Top',
            'description' => 'A comfortable tank top.',
            'price' => 8.99,
            'category_id' => 1,
            'stock' => 50,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => 0,
        ]);

        Product::create([
            'name' => 'Polo Shirt',
            'description' => 'A stylish polo shirt.',
            'price' => 20.99,
            'category_id' => 1,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Bottoms' category
        Product::create([
            'name' => 'Jeans',
            'description' => 'Classic blue jeans.',
            'price' => 29.99,
            'category_id' => 2,
            'stock' => 50,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Shorts',
            'description' => 'Comfortable summer shorts.',
            'price' => 19.99,
            'category_id' => 2,
            'stock' => 60,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Sweatpants',
            'description' => 'Casual sweatpants for everyday wear.',
            'price' => 24.99,
            'category_id' => 2,
            'stock' => 45,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => 0,
        ]);

        Product::create([
            'name' => 'Chinos',
            'description' => 'Stylish chinos for work and casual outings.',
            'price' => 27.99,
            'category_id' => 2,
            'stock' => 35,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Dresses' category
        Product::create([
            'name' => 'Summer Dress',
            'description' => 'A lightweight dress for summer.',
            'price' => 39.99,
            'category_id' => 3,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Maxi Dress',
            'description' => 'A comfortable maxi dress.',
            'price' => 49.99,
            'category_id' => 3,
            'stock' => 25,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Cocktail Dress',
            'description' => 'A perfect dress for an evening out.',
            'price' => 59.99,
            'category_id' => 3,
            'stock' => 20,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Sundress',
            'description' => 'A casual sundress for a day at the park.',
            'price' => 35.99,
            'category_id' => 3,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 1,
            'discount_price' => 15.99,
        ]);

        // Products for the 'Outerwear' category
        Product::create([
            'name' => 'Blazer',
            'description' => 'A formal blazer for office wear.',
            'price' => 69.99,
            'category_id' => 4,
            'stock' => 15,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 1,
            'discount_price' => 30.99,
        ]);

        Product::create([
            'name' => 'Denim Jacket',
            'description' => 'A classic denim jacket.',
            'price' => 49.99,
            'category_id' => 4,
            'stock' => 20,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Winter Coat',
            'description' => 'A warm winter coat.',
            'price' => 89.99,
            'category_id' => 4,
            'stock' => 10,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 1,
            'discount_price' => '45.99',
        ]);

        Product::create([
            'name' => 'Windbreaker',
            'description' => 'A lightweight windbreaker.',
            'price' => 39.99,
            'category_id' => 4,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Heels' category
        Product::create([
            'name' => 'Classic Black Heels',
            'description' => 'Timeless black heels for any occasion.',
            'price' => 49.99,
            'category_id' => 5,
            'stock' => 50,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => 0,
        ]);

        Product::create([
            'name' => 'Strappy Sandals',
            'description' => 'Elegant strappy sandals for summer.',
            'price' => 39.99,
            'category_id' => 5,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 1,
            'discount_price' => 15.99,
        ]);

        Product::create([
            'name' => 'Wedge Heels',
            'description' => 'Comfortable and stylish wedge heels.',
            'price' => 59.99,
            'category_id' => 5,
            'stock' => 20,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => 0,
        ]);

        Product::create([
            'name' => 'Block Heels',
            'description' => 'Sturdy block heels for a night out.',
            'price' => 44.99,
            'category_id' => 5,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Accessories' category
        Product::create([
            'name' => 'Gold Necklace',
            'description' => 'A delicate gold necklace.',
            'price' => 99.99,
            'category_id' => 6,
            'stock' => 10,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Leather Belt',
            'description' => 'A classic leather belt for all outfits.',
            'price' => 19.99,
            'category_id' => 6,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Sunglasses',
            'description' => 'Fashionable sunglasses for sunny days.',
            'price' => 29.99,
            'category_id' => 6,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Wool Scarf',
            'description' => 'A warm wool scarf for the winter.',
            'price' => 25.99,
            'category_id' => 6,
            'stock' => 35,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Hijabs' category
        Product::create([
            'name' => 'Plain Hijab',
            'description' => 'A simple hijab for everyday wear.',
            'price' => 12.99,
            'category_id' => 7,
            'stock' => 80,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Silk Hijab',
            'description' => 'A luxurious silk hijab.',
            'price' => 29.99,
            'category_id' => 7,
            'stock' => 20,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Patterned Hijab',
            'description' => 'A hijab with unique patterns.',
            'price' => 19.99,
            'category_id' => 7,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Chiffon Hijab',
            'description' => 'A lightweight chiffon hijab.',
            'price' => 22.99,
            'category_id' => 7,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Add the remaining products similarly for categories 8 through 12 (Jackets, Hoodies, Skirts, Abayas, Jumpsuits)

        // Products for the 'Jackets' category
        Product::create([
            'name' => 'Leather Jacket',
            'description' => 'A stylish leather jacket.',
            'price' => 79.99,
            'category_id' => 8, // الفئة Jackets
            'stock' => 25,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Bomber Jacket',
            'description' => 'A casual bomber jacket.',
            'price' => 59.99,
            'category_id' => 8,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Puffer Jacket',
            'description' => 'A warm puffer jacket for winter.',
            'price' => 89.99,
            'category_id' => 8,
            'stock' => 20,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Denim Jacket',
            'description' => 'A trendy denim jacket.',
            'price' => 49.99,
            'category_id' => 8,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Hoodies' category
        Product::create([
            'name' => 'Basic Hoodie',
            'description' => 'A comfortable hoodie for everyday wear.',
            'price' => 29.99,
            'category_id' => 9, // الفئة Hoodies
            'stock' => 50,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Zippered Hoodie',
            'description' => 'A zippered hoodie for convenience.',
            'price' => 34.99,
            'category_id' => 9,
            'stock' => 45,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Oversized Hoodie',
            'description' => 'An oversized hoodie for a relaxed fit.',
            'price' => 39.99,
            'category_id' => 9,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Graphic Hoodie',
            'description' => 'A hoodie with trendy graphics.',
            'price' => 44.99,
            'category_id' => 9,
            'stock' => 35,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Skirts' category
        Product::create([
            'name' => 'Pencil Skirt',
            'description' => 'A formal pencil skirt for office wear.',
            'price' => 24.99,
            'category_id' => 10, // الفئة Skirts
            'stock' => 60,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Maxi Skirt',
            'description' => 'A flowing maxi skirt.',
            'price' => 29.99,
            'category_id' => 10,
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Pleated Skirt',
            'description' => 'A pleated skirt for a trendy look.',
            'price' => 34.99,
            'category_id' => 10,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Mini Skirt',
            'description' => 'A casual mini skirt for everyday wear.',
            'price' => 19.99,
            'category_id' => 10,
            'stock' => 50,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Abayas' category
        Product::create([
            'name' => 'Classic Black Abaya',
            'description' => 'A traditional black abaya for formal occasions.',
            'price' => 59.99,
            'category_id' => 11, // الفئة Abayas
            'stock' => 40,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Embroidered Abaya',
            'description' => 'An abaya with intricate embroidery.',
            'price' => 79.99,
            'category_id' => 11,
            'stock' => 25,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Open Front Abaya',
            'description' => 'An open front abaya for a modern look.',
            'price' => 69.99,
            'category_id' => 11,
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Kimono Style Abaya',
            'description' => 'A kimono-style abaya with a belt.',
            'price' => 89.99,
            'category_id' => 11,
            'stock' => 20,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        // Products for the 'Jumpsuits' category
        Product::create([
            'name' => 'Casual Jumpsuit',
            'description' => 'A comfortable jumpsuit for everyday wear.',
            'price' => 49.99,
            'category_id' => 12, // الفئة Jumpsuits
            'stock' => 30,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Formal Jumpsuit',
            'description' => 'A stylish jumpsuit for formal events.',
            'price' => 69.99,
            'category_id' => 12,
            'stock' => 20,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Denim Jumpsuit',
            'description' => 'A trendy denim jumpsuit.',
            'price' => 59.99,
            'category_id' => 12,
            'stock' => 25,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);

        Product::create([
            'name' => 'Sleeveless Jumpsuit',
            'description' => 'A sleeveless jumpsuit for summer.',
            'price' => 39.99,
            'category_id' => 12,
            'stock' => 35,
            'size' => 'null',
            'color' => 'null',
            'is_hot' => 0,
            'discount_price' => '0',
        ]);
    }
}


