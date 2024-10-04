<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showDashboard()
    {
        // حساب نسبة الزيادة في المبيعات مقارنة بالأمس (مثال)
        $todaySales = Order::whereDate('created_at', Carbon::today())->sum('total_amount');
        $yesterdaySales = Order::whereDate('created_at', Carbon::yesterday())->sum('total_amount');
        $salesPercentage = $yesterdaySales > 0 ? (($todaySales - $yesterdaySales) / $yesterdaySales) * 100 : 100;

        // اسم المدير الحالي (يمكن تعديله ليتناسب مع الحساب الذي تم تسجيل الدخول به)
        $adminName = auth()->check() ? auth()->user()->name : 'Admin';

        // إحصائيات أخرى
        $ordersCount = Order::count();
        $usersCount = User::count();
        $adminsCount = User::where('role', 'admin')->count();
        $totalSales = Order::sum('total_amount');
        $categories = Category::withCount('products')->get();

        return view('admin.index', compact(
            'ordersCount', 'usersCount', 'adminsCount', 'totalSales', 'categories', 'adminName', 'salesPercentage'
        ));
    }
}

