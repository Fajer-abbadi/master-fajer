<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add(Request $request) {
        try {
            $product_id = $request->input('product_id');
            $user_id = auth()->id();

            // تحقق أن `product_id` ليس null
            if (!$product_id) {
                return response()->json(['success' => false, 'message' => 'Product ID is required.']);
            }

            // تأكد من عدم تكرار المنتج في قائمة الأمنيات
            if (!Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->exists()) {
                Wishlist::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id
                ]);

                return response()->json(['success' => true, 'message' => 'Added to wishlist']);
            } else {
                return response()->json(['success' => false, 'message' => 'Product already in wishlist']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }



    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('home.wishlist', compact('wishlistItems'));
    }
    public function show($id)
{
    $product = Product::with('images')->findOrFail($id);

    // جلب المراجعات مع بيانات المستخدمين المرتبطة
    $allreviews = $product->reviews()->with('user')->get();

    return view('home.product-details', compact('product', 'allreviews'));
}
public function remove($wishlistItemId)
{
    $wishlistItem = Wishlist::find($wishlistItemId);

    if (!$wishlistItem) {
        return redirect()->back()->with('error', 'Item not found in wishlist.');
    }

    $wishlistItem->delete();

    return redirect()->back()->with('success', 'Item removed from wishlist.');


}

}
