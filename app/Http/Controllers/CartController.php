<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Coupon; // تأكد من استيراد موديل الكوبون
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // عرض صفحة السلة
    public function showCart(Request $request)
{
    // جلب بيانات السلة للمستخدم الحالي
    $cartItems = Cart::where('user_id', Auth::id())
                      ->with('product')  // جلب معلومات المنتج مع كل عنصر
                      ->get();

    // حساب المجموع الكلي
    $subtotal = $cartItems->sum(function($cartItem) {
        return $cartItem->product->price * $cartItem->quantity;
    });

    // التحقق مما إذا كانت هناك قيمة للخصم والإجمالي في الجلسة
    $discount = session()->get('discount_amount', 0);
    $total = session()->get('total', $subtotal); // إذا لم يكن هناك إجمالي مخزن، استخدم المجموع الافتراضي

    return view('home.shop-cart', compact('cartItems', 'subtotal', 'total', 'discount'));
}


    // زيادة الكمية
    public function increaseQuantity($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        }

        return redirect()->route('cart.show')->with('success', 'Product quantity increased successfully!');
    }

    // إنقاص الكمية
    public function decreaseQuantity($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->save();
            } else {
                // إذا كانت الكمية 1، يتم حذف المنتج من السلة
                $cartItem->delete();
            }
        }

        return redirect()->route('cart.show')->with('success', 'Product quantity decreased successfully!');
    }

    // إزالة منتج من السلة
    public function removeFromCart($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.show')->with('success', 'Product removed from cart');
        }

        return redirect()->route('cart.show')->with('error', 'Product not found in cart');
    }


// CartController.php
public function applyDiscount(Request $request)
{
    // ابحث عن الكوبون في قاعدة البيانات
    $coupon = Coupon::where('code', $request->coupon_code)
                    ->where('is_active', 1)
                    ->where('expiry_date', '>=', now()) // التحقق من صلاحية الكوبون
                    ->first();

    if (!$coupon) {
        // إذا لم يتم العثور على الكوبون
        return redirect()->route('cart.show')->with('discount_error', 'Invalid or expired coupon code.');
    }

    // احصل على المنتجات من السلة للمستخدم الحالي
    $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

    // احسب المجموع الكلي قبل الخصم
    $subtotal = $cartItems->sum(function ($cartItem) {
        return $cartItem->product->price * $cartItem->quantity;
    });

    // احسب الخصم
    $discountAmount = $subtotal * ($coupon->discount / 100);

    // التأكد من أن الخصم لا يتجاوز الحد الأقصى المسموح به
    if ($discountAmount > $coupon->max_discount_amount) {
        $discountAmount = $coupon->max_discount_amount;
    }

    // احسب التوتال بعد الخصم
    $total = $subtotal - $discountAmount;

    // قم بحفظ الخصم في الجلسة
    session()->put('discount_amount', $discountAmount);
    session()->put('total', $total);

    return redirect()->route('cart.show')->with('discount_message', 'Coupon applied successfully.');
}

}
