<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // جلب جميع المنشورات من قاعدة البيانات
        $posts = Post::all();

        // تمرير المنشورات إلى واجهة المدونة
        return view('home.blog', compact('posts'));
    }
}

