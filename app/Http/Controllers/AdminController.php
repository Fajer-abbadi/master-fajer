<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

use App\Models\Category;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home.index')->withErrors(['error' => 'Access denied.']);
        }

        $todaySales = Order::whereDate('created_at', Carbon::today())->sum('total_amount');
        $yesterdaySales = Order::whereDate('created_at', Carbon::yesterday())->sum('total_amount');
        $salesPercentage = $yesterdaySales > 0 ? (($todaySales - $yesterdaySales) / $yesterdaySales) * 100 : 100;

        $ordersCount = Order::count();
        $usersCount = User::count();
        $adminsCount = User::where('role', 'admin')->count();
        $totalSales = Order::sum('total_amount');
        $categories = Category::withCount('products')->get();
        $adminName = auth()->check() ? auth()->user()->name : 'Admin'; // تأكد من تعريف adminName هنا

        return view('admin.index', compact(
            'ordersCount', 'usersCount', 'adminsCount', 'totalSales', 'categories', 'salesPercentage', 'todaySales', 'yesterdaySales', 'adminName',
        ));
    }


    public function showOrders()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function manageUsers(Request $request)
    {
        $role = $request->input('role', null);
        $users = User::when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $orderResults = Order::where('status', 'LIKE', "%$query%")
                            ->orWhere('order_number', 'LIKE', "%$query%")
                            ->get();

        $userResults = User::where('name', 'LIKE', "%$query%")
                          ->orWhere('email', 'LIKE', "%$query%")
                          ->get();

        $categoryResults = Category::where('name', 'LIKE', "%$query%")
                                  ->get();

        return view('admin.search_results', compact('orderResults', 'userResults', 'categoryResults'));
    }
    public function show($id)
{
    $product = Product::with('reviews')->find($id);

    dd($product); // سيظهر محتوى المنتج للتحقق من وجود البيانات

    if (!$product) {
        return redirect()->route('shop.index')->with('error', 'Product not found.');
    }

    return view('product-details', compact('product'));
}

}
