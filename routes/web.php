<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductdetailsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ManageCouponController;
use App\Http\Controllers\ManageStatusController;
use App\Http\Controllers\ManageBlogController;
use App\Http\Controllers\ChatController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// route of adminpages
// Routes for Login and Register
Route::get('/login', [AuthController::class, 'loginForm'])->name('login1');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register1');

// Route for Home Page

// Routes for Products CRUD
Route::resource('products', ProductController::class);

// Routes for Orders CRUD
Route::resource('orders', OrderController::class);

// Routes for User Management (CRUD for users)
Route::resource('manage-users', UserController::class);
Route::resource('users', UserController::class);

// Admin dashboard routes
// Route::middleware('role:super_admin')->group(function () {
//     Route::get('/admin', [AdminController::class, 'showDashboard'])->name('admin.index');
//     Route::resource('admin/users', UserController::class); // إدارة المستخدمين في لوحة الادمن
// });
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');



// Routes for Categories CRUD
Route::resource('categories', CategoryController::class);

// Routes for Reviews CRUD
Route::resource('reviews', ReviewController::class);

// Route for chat
Route::get('/admin/chat', function () {
    return view('admin.chat');
})->name('admin.chat');

// Route for email
Route::get('/admin/email', function () {
    return view('admin.email');
})->name('admin.email');
// routes/web.php
Route::resource('coupons', ManageCouponController::class);
Route::resource('status', ManageStatusController::class);

Route::prefix('admin')->group(function () {
    Route::get('/blog', [ManageBlogController::class, 'index'])->name('admin.blog.index'); // صفحة عرض كل البوستات
    Route::get('/blog/create', [ManageBlogController::class, 'create'])->name('blog.create'); // صفحة إنشاء بوست جديد
    Route::post('/blog', [ManageBlogController::class, 'store'])->name('blog.store'); // حفظ بوست جديد
    Route::get('/blog/{id}/edit', [ManageBlogController::class, 'edit'])->name('blog.edit'); // صفحة تعديل البوست
    Route::put('/blog/{id}', [ManageBlogController::class, 'update'])->name('blog.update'); // تحديث البوست
    Route::delete('/blog/{id}', [ManageBlogController::class, 'destroy'])->name('blog.destroy'); // حذف البوست
});

Route::get('/admin/chat', [ChatController::class, 'index'])->name('admin.chat'); Route::get('/admin/chat/messages/{user}', [ChatController::class, 'getMessages'])->name('chat.getMessages'); // لجلب الرسائل
Route::post('/admin/chat/send', [ChatController::class, 'sendMessage'])->name('chat.sendMessage'); // لإرسال الرسائل


// end route of admin page////////////////////////////////////////////////////////////////////////////////




Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/get-products', [HomeController::class, 'getProducts'])->name('products.filter');

Route::get('/women', function () {
    return view('home.women');  // صفحة Women's
});
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');



Route::get('/pages', function () {
    return view('home.pages');  // صفحة Pages
});

Route::get('/blog', function () {
    return view('home.blog');  // صفحة Blog
});

Route::get('/contact', function () {
    return view('home.contact');  // صفحة Contact
});
// Route::get('/checkout', function () {
//     return view('home.checkout');
// })->name('checkout');

// Route::get('/shop-cart', function () {
//     return view('home.shop-cart');
// });

Route::get('/women-sales', [ProductController::class, 'womenSales'])->name('women.sales');

Route::get('/product-details/{id}', [ProductdetailsController::class, 'show'])->name('product.details');


Route::get('/login', function () {
    return view('auth.login');
})->name('login2');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/wishlist', function () {
//     return view('home.wishlist');
// });
Route::post('/check-skin-tone', function (Request $request) {
    // استرجاع لون البشرة المدخل من قبل المستخدم
    $skinTone = $request->input('skin_tone');

    // استرجاع التوصيات الخاصة بلون البشرة من قاعدة البيانات
    $result = DB::table('skin_tone_results')
                ->where('skin_tone', $skinTone)
                ->first();

    // إرسال النتيجة كـ JSON
    return response()->json($result);
   // Route للسلة

// Route للمفضلة
// عرض صفحة تفاصيل المنتج
Route::get('/product/{id}', [ProductDetailsController::class, 'show'])->name('product.details');

// إضافة منتج للسلة
// إضافة منتج إلى المفضلة
// Route::post('/wishlist', [ProductDetailsController::class, 'addToWishlist'])->name('wishlist.add');


});

Route::post('/store-cart', [ProductDetailsController::class, 'addToCart'])->name('cart.add1');
// عرض السلة
// عرض السلة
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

// إضافة منتج للسلة
Route::post('/cart-add', [CartController::class, 'addToCart'])->name('cart.add');

// زيادة الكمية
Route::get('/cart-increase/{id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');

// إنقاص الكمية
Route::get('/cart-decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');

// إزالة منتج من السلة
Route::delete('/cart-remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
// عرض السلة

// تطبيق كود الخصم
Route::post('/cart/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');
Route::post('/checkout/billing', [CheckoutController::class, 'storeBillingInfo'])->name('checkout.billing');
Route::post('/checkout/order', [CheckoutController::class, 'storeOrder'])->name('checkout.order');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard')->middleware('auth');
Route::post('/user/update', [UserDashboardController::class, 'updateProfile'])->name('user.updateProfile')->middleware('auth');

Route::resource('posts', PostController::class)->middleware('auth');

// لإضافة تعليق على منشور
Route::post('/posts/{post}/comment', [PostController::class, 'addComment'])->name('posts.addComment');
Route::get('/blog/{post}', [PostController::class, 'show'])->name('blog.details');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
