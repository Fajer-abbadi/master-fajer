<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\BillingInformation;
use App\Models\Order;
use App\Models\Cart; // استخدام موديل Cart الحالي


class UserDashboardController extends Controller
{
    public function index()
    {
        // جلب المستخدم الحالي
        $user = Auth::user();

        // جلب بيانات الفواتير للمستخدم الحالي
        $billingInformation = BillingInformation::where('user_id', $user->id)->first();

        // جلب الطلبات للمستخدم الحالي
        $orders = Order::where('user_id', $user->id)->get();
        $cartItems = Cart::where('user_id', $user->id)->get();

        return view('home.userdashboard', compact('user', 'billingInformation', 'orders','cartItems'));}

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // التحقق من الصورة
        ]);

        // جلب بيانات الفواتير للمستخدم الحالي
        $billingInformation = BillingInformation::where('user_id', $user->id)->first();

        // تحديث بيانات الفواتير
        if ($billingInformation) {
            $billingInformation->update($request->all());
        } else {
            // إنشاء بيانات الفواتير إذا لم تكن موجودة
            BillingInformation::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'phone' => $request->phone,
            ]);
        }

        // إذا كان هناك صورة جديدة
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // تخزين مسار الصورة في الـ Session
            Session::put('profile_image', $imageName);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}




