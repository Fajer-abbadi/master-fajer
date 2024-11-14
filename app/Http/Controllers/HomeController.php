<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index(Request $request)
{
    $category_id = $request->input('category_id');
    $categories = Category::all();

    if ($category_id) {
        $products = Product::where('category_id', $category_id)->with('images')->get();
    } else {
        $products = Product::with('images')->get();
        $hotProducts = Product::where('is_hot', true)->take(4)->get();
    }

    $receiverId = 5; // مثال: يمكنك تعيين معرف الأدمن هنا أو جلبه من قاعدة البيانات

    return view('home.index', compact('products', 'categories', 'hotProducts', 'receiverId'));
}




public function getProducts(Request $request)
{
    $category_id = $request->input('category_id');

    // إذا تم اختيار فئة معينة، جلب المنتجات حسب الفئة، مع جلب الصور المرتبطة
    if ($category_id) {
        $products = Product::with('images')->where('category_id', $category_id)->take(4)->get();
    } else {
        $products = Product::with('images')->take(8)->get();
    }

    // إعادة المنتجات بصيغة JSON
    return response()->json([
        'products' => $products->map(function ($product) {
            $averageRating = round($product->reviews->avg('rating')); // Calculate average rating and round it

            return [
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->stock,
                'images' => $product->images->map(function ($image) {
                    return $image->image_url; // جلب URL الصورة
                }), // قائمة من الصور
                'category_name' => $product->category->name,
                'productUrl' => route('product.details', ['id' => $product->id]) ,// Add the product details URL
                'averageRating' => $averageRating // Include average rating in JSON response

            ];
        })
    ]);
}

public function getHotProducts()
{
    // جلب المنتجات التي تم تعيين is_hot = true فقط
    $hotProducts = Product::with('images')->where('is_hot', true)->take(5)->get();

    return view('front.hotpieces', compact('hotProducts'));
}





    public function contact()
    {
        return view('home.contact');
    }

    public function shop()
    {
        return view('home.shop');
    }

    public function cart()
    {
        return view('home.shop-cart');
    }

    public function productDetails($id)
    {
        return view('home.product-details', ['id' => $id]);
    }
}
