<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
                'code' => 'DISCOUNT10',
                'discount' => 10.00,
                'max_discount_amount' => 50.00,
                'is_active' => true,
                'expiry_date' => Carbon::now()->addDays(30)->toDateString(),
            ],
            [
                'code' => 'SUMMER20',
                'discount' => 20.00,
                'max_discount_amount' => 100.00,
                'is_active' => true,
                'expiry_date' => Carbon::now()->addDays(60)->toDateString(),
            ],
            [
                'code' => 'WINTER50',
                'discount' => 50.00,
                'max_discount_amount' => 200.00,
                'is_active' => false, // غير فعال
                'expiry_date' => Carbon::now()->addDays(90)->toDateString(),
            ]
        ]);
    }
}

