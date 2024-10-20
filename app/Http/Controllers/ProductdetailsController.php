<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;  // تأكد من استيراد موديل Cart
use App\Models\Wishlist;  // تأكد من استيراد موديل Wishlist
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductdetailsController extends Controller
{
    public function show($id)
    {
        // جلب المنتج باستخدام الـ ID
        $product = Product::with('images')->findOrFail($id);

        // جلب المنتجات ذات الصلة بناءً على نفس التصنيف
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->take(4) // حدد العدد المناسب لعرضه
                                  ->get();

        // جلب جميع المراجعات
        $allreviews = $product->reviews()->get();

        // تمرير المنتجات ذات الصلة والمراجعات للعرض
        return view('home.product-details', compact('product', 'relatedProducts', 'allreviews'));
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to add items to the cart']);
        }

        // جلب المنتج باستخدام ID
        $product = Product::find($request->product_id);

        // تحقق إذا كان المنتج موجود
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        // إضافة المنتج للسلة
        Cart::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
 'user_id' => Auth::id(), // سحب user_id للمستخدم المسجل الدخول
        ]);

        return response()->json(['success' => true, 'message' => 'Product added to cart']);
    }

    // public function addToWishlist(Request $request)
    // {
    //     // تحقق مما إذا كان المستخدم مسجل دخولًا
    //     if (!Auth::check()) {
    //         return response()->json(['success' => false, 'message' => 'You must be logged in to add items to the wishlist']);
    //     }

    //     // جلب المنتج باستخدام ID
    //     $product = Product::find($request->product_id);

    //     // تحقق إذا كان المنتج موجود
    //     if (!$product) {
    //         return response()->json(['success' => false, 'message' => 'Product not found']);
    //     }

    //     // إضافة المنتج للمفضلة
    //     Wishlist::create([
    //         'product_id' => $product->id,
    //         'user_id' => auth()->id()  // إذا كان المستخدم مسجلاً دخولاً
    //     ]);

    //     return response()->json(['success' => true, 'message' => 'Product added to wishlist']);
    // }
}
