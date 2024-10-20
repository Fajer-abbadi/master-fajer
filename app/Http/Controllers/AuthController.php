<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function loginForm()
    {
        return view('auth.auth');  // استخدم نفس الصفحة لكل من تسجيل الدخول والتسجيل
    }

    // عملية تسجيل الدخول
   // login logic in AuthController.php
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // توجيه حسب الدور
        $userRole = auth()->user()->role;
        if ($userRole == 'admin') {
            return redirect()->route('admin.index');
        } elseif ($userRole == 'super_admin') {
            return redirect()->route('admin.index'); // تعديل إذا كان مسار مختلف
        } else {
            return redirect()->route('home.index');
        }
    }

    return back()->withErrors([
        'email' => 'بيانات الاعتماد المدخلة غير صحيحة.',
    ]);
}


    // عرض صفحة التسجيل
    public function registerForm()
    {
        return view('auth.auth');
    }

    // عملية التسجيل
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // إنشاء مستخدم جديد
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // بشكل افتراضي مستخدم عادي
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }

    // عملية تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}

