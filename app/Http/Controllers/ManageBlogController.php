<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ManageBlogController extends Controller
{
    // عرض جميع البوستات
    public function index()
    {
        $posts = Post::all();
        return view('admin.blog.index', compact('posts'));
    }

    // عرض صفحة إنشاء بوست جديد
    public function create()
    {
        return view('admin.blog.create');
    }

    // حفظ بوست جديد
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/posts');
            $post->image = basename($imagePath);
        }

        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('blog.index')->with('success', 'Post created successfully');
    }

    // عرض صفحة تعديل البوست
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.blog.edit', compact('post'));
    }

    // تحديث بيانات البوست
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/posts');
            $post->image = basename($imagePath);
        }

        $post->save();

        return redirect()->route('blog.index')->with('success', 'Post updated successfully');
    }

    // حذف البوست
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('blog.index')->with('success', 'Post deleted successfully');
    }
}
