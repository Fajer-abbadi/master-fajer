<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\SkinToneResult;
use Illuminate\Http\Request;

class SkinToneController extends Controller
{
    public function getRecommendations($skinTone)
    {
        // استرجاع البيانات من الجدول بناءً على نوع البشرة
        $result = SkinToneResult::where('skin_tone', $skinTone)->first();

        // إذا وجدت النتائج، عرض التوصيات
        if ($result) {
            return response()->json([
                'skin_tone' => $result->skin_tone,
                'recommendations' => json_decode($result->shade_recommendations)
            ]);
        } else {
            return response()->json([
                'error' => 'No recommendations found for this skin tone'
            ]);
        }
    }
}

