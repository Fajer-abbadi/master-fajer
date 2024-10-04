<?php
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::resource('orders', OrderController::class);

Route::resource('products', ProductController::class);

// مسارات إدارة CRUD للمستخدمين
Route::resource('manage-users', UserController::class);

Route::resource('users', UserController::class);

Route::resource('admin/users', UserController::class)->middleware('role:super_admin');

// Route for admin dashboard
Route::get('/admin', [AdminController::class, 'showDashboard'])->name('admin.index');

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
