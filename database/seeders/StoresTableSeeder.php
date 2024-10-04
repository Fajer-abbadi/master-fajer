<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoresTableSeeder extends Seeder
{
    public function run()
    {
        // إدخال متاجر تجريبية
        Store::create([
            'name' => 'Fashion Store',
            'description' => 'High-end fashion store',
            'address' => '123 Fashion Ave, City'
        ]);

        Store::create([
            'name' => 'Shoe Store',
            'description' => 'Quality shoes for all occasions',
            'address' => '456 Shoe St, City'
        ]);
    }
}
