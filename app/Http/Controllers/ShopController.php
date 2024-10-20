<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // تحقق من القيم المرسلة
        // dd($request->all());

        // جلب جميع التصنيفات
        $categories = Category::all();

        // جلب المنتجات بناءً على التصنيف المحدد إذا كان موجوداً
        $products = Product::query();

        // فلترة حسب التصنيف
        if ($request->has('category_id')) {
            $products = $products->where('category_id', $request->category_id);
        }

        // فلترة حسب السعر
        if ($request->has('min_price') && $request->has('max_price')) {
            $products = $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // فلترة حسب السايز
        if ($request->has('size')) {
            $products = $products->whereIn('size', $request->size);
        }

        // فلترة حسب الألوان
        if ($request->has('color')) {
            $products = $products->whereIn('color', $request->color);
        }

        // تفعيل الترقيم (pagination)
        $products = $products->paginate(9);

        return view('home.shop', compact('categories', 'products'));
    }

}
