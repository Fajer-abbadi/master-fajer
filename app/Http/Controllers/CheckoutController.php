<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\BillingInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // عرض صفحة الـ Checkout
    public function index()
    {
        // جلب بيانات السلة للمستخدم الحالي
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // التأكد من أن السلة ليست فارغة
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty!');
        }

        // حساب المجموع الكلي
        $subtotal = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
        $total = $subtotal;
        // عرض صفحة الدفع مع بيانات السلة والمجموع الكلي
        return view('home.checkout', compact('cartItems', 'subtotal','total'));
    }

    // تخزين بيانات الفوترة وإتمام الطلب
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // جلب user_id الخاص بالمستخدم الحالي
        $user_id = Auth::id();

        // تخزين معلومات الفوترة في جدول billing_information
        BillingInformation::create([
            'user_id' => $user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

        // ** يمكن إضافة عملية تخزين بيانات الطلب هنا في جدول `orders` **

        // حذف محتويات السلة بعد إتمام الطلب
        Cart::where('user_id', $user_id)->delete();

        // إعادة التوجيه إلى صفحة نجاح عملية الدفع
        return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
    }

    // عرض صفحة النجاح بعد إتمام الطلب
    public function success()
    {
        return view('home.success'); // صفحة تعرض رسالة نجاح
    }
}
