<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function edit($id)
{
    $order = Order::findOrFail($id);  // جلب الطلب المحدد باستخدام ID
    $statuses = Status::all();  // جلب جميع الحالات من جدول status
    return view('admin.orders.edit', compact('order', 'statuses'));  // تمرير الحالات إلى الـ Blade
}



public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);
    // تأكد من أنك تقوم بتحديث status_id وليس status فقط
    $order->update($request->only('status_id'));
    return redirect()->route('orders.index')->with('success', 'Order updated successfully');
}



    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}

