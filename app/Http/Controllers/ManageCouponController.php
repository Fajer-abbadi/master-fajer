<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class ManageCouponController extends Controller
{
    // عرض كل الكوبونات
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    // عرض فورم إضافة كوبون جديد
    public function create()
    {
        return view('coupons.create');
    }

    // تخزين كوبون جديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons|max:50',
            'discount' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'is_active' => 'required|boolean',
            'expiry_date' => 'required|date',
        ]);

        Coupon::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'max_discount_amount' => $request->max_discount_amount,
            'is_active' => $request->is_active,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully');
    }

    // عرض كوبون معين
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.show', compact('coupon'));
    }

    // عرض فورم تعديل كوبون
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.edit', compact('coupon'));
    }

    // تحديث بيانات الكوبون
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|max:50|unique:coupons,code,' . $id,
            'discount' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'is_active' => 'required|boolean',
            'expiry_date' => 'required|date',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'code' => $request->code,
            'discount' => $request->discount,
            'max_discount_amount' => $request->max_discount_amount,
            'is_active' => $request->is_active,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully');
    }

    // حذف كوبون
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully');
    }
}

