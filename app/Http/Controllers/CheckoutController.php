<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\BillingInformation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // عرض صفحة الـ Checkout
    public function index()
    {
        $biling = BillingInformation::where('user_id', Auth::id())->first();
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        $subtotal = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        $discount = session()->get('discount_amount', 0); // جلب الخصم من الجلسة
        $total = $subtotal - $discount;

        return view('home.checkout', compact('cartItems', 'subtotal', 'discount', 'total', 'biling'));
    }

    // تخزين بيانات الفوترة فقط
    public function storeBillingInfo(Request $request)
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

        // جلب الـ user_id للمستخدم الحالي
        $user_id = Auth::id();

        // استخدام updateOrCreate للتحقق إذا كان هناك ريكورد للمستخدم وتحديثه أو إنشاء ريكورد جديد
        BillingInformation::updateOrCreate(
            ['user_id' => $user_id], // الشرط: إذا كان السجل يحتوي على user_id للمستخدم الحالي
            [ // البيانات التي سيتم تحديثها أو إنشاؤها
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
            ]
        );

        // إعادة المستخدم لنفس الصفحة مع رسالة نجاح
        return redirect()->route('checkout')->with('success', 'Billing information saved successfully!');
    }


    // تخزين الطلب وعناصر الطلب وحذفها من الكارت
    public function storeOrder(Request $request)
    {
        // جلب الـ user_id للمستخدم الحالي
        $user_id = Auth::id();

        // التحقق من طريقة الدفع أولاً
        $request->validate([
            'payment_method' => 'required|in:COD,credit_card',
        ]);

        // إذا كانت طريقة الدفع عبر بطاقة الائتمان، نقوم بالتحقق من صحة البيانات الخاصة بالبطاقة
        if ($request->payment_method === 'credit_card') {
            $request->validate([
                'card_number' => 'required|digits:16', // رقم البطاقة يجب أن يكون مكون من 16 رقمًا
                'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/?([0-9]{2})$/'], // تحقق من النمط MM/YY
                'cvv' => 'required|digits_between:3,4', // الـ CVV يجب أن يكون 3 أو 4 أرقام
            ]);
        }

        // جلب عناصر الكارت
        $cartItems = Cart::where('user_id', $user_id)->with('product')->get();

        // حساب المجموع الكلي مع الخصم
        $subtotal = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
        $discount = session()->get('discount_amount', 0); // جلب الخصم من الجلسة
        $total = $subtotal - $discount;

        // تخزين معلومات الطلب في جدول orders
        $order = Order::create([
            'user_id' => $user_id,
            'total_amount' => $total,
            'status' => 'pending',
            'status_id' => 1,  // يمكنك تخصيصه حسب الحالة
        ]);

        // حفظ عناصر الطلب في جدول order_items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // حذف العناصر من الكارت بعد إنشاء الطلب
        Cart::where('user_id', $user_id)->delete();
        $request->session()->forget(['discount_amount', 'total']);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('home.index')->with('success', 'Order placed successfully!');
    }

}
