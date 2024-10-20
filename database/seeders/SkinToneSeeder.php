<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // تأكدي من إضافة هذا السطر

class SkinToneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('skin_tone_results')->insert([
            [
                'skin_tone' => 'light',
                'shade_recommendations' => json_encode(['Light Pink', 'Peach', 'Soft Coral']),
            ],
            [
                'skin_tone' => 'medium',
                'shade_recommendations' => json_encode(['Rose', 'Warm Beige', 'Bronze']),
            ],
            [
                'skin_tone' => 'dark',
                'shade_recommendations' => json_encode(['Deep Berry', 'Chocolate Brown', 'Plum']),
            ]
        ]);
    }
}
