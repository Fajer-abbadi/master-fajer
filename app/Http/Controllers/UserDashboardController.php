<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\BillingInformation;
use App\Models\Order;
use App\Models\Cart;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $billingInformation = BillingInformation::where('user_id', $user->id)->first();
        $orders = Order::where('user_id', $user->id)->get();
        $cartItems = Cart::where('user_id', $user->id)->get();

        return view('home.userdashboard', compact('user', 'billingInformation', 'orders', 'cartItems'));
    }

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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // استخدام المعاملة لتحديث كلا الجدولين معاً
        DB::transaction(function () use ($user, $request) {
            // تحديث بيانات الفوترة (Billing Information)
            BillingInformation::updateOrCreate(
                ['user_id' => $user->id],
                $request->only(['first_name', 'last_name', 'address', 'city', 'country', 'phone'])
            );

            // التعامل مع الصورة الشخصية
            if ($request->hasFile('profile_image')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($user->profile_image) {
                    Storage::delete('images/' . $user->profile_image);
                }

                // حفظ الصورة الجديدة
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images', $imageName, 'public');

                // تحديث حقل الصورة في جدول المستخدمين
                $user->profile_image = $imageName;
            }

            // حفظ تحديثات المستخدم
            $user->save();
        });

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح.');
    }
}
