<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // جلب جميع المنشورات من قاعدة البيانات
        $posts = Post::all();

        // تمرير المنشورات إلى الواجهة
        return view('home.blog', compact('posts'));
    }


    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('home.blog-details', compact('post'));
    }

    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    public function editComment(Post $post, Comment $comment)
    {
        return view('comments.edit', compact('post', 'comment'));
    }

    // دالة حذف التعليق
    public function deleteComment(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    public function toggleLike(Request $request, $postId)
{
    // الحصول على قائمة المنشورات المعجب بها من الجلسة، أو إعدادها كقائمة فارغة
    $likedPosts = session()->get('liked_posts', []);

    // إذا كانت المنشور معجب به بالفعل، أزل الإعجاب
    if (in_array($postId, $likedPosts)) {
        // حذف معرف المنشور من القائمة
        $likedPosts = array_diff($likedPosts, [$postId]);
        session()->put('liked_posts', $likedPosts);
        return response()->json(['liked' => false]);
    } else {
        // إذا لم يكن معجبًا به، أضف معرف المنشور إلى القائمة
        $likedPosts[] = $postId;
        session()->put('liked_posts', $likedPosts);
        return response()->json(['liked' => true]);
    }
}
public function updateComment(Request $request, Post $post, Comment $comment)
{
    // التحقق من أن المستخدم هو مالك التعليق
    if ($comment->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
    }

    // تحقق من صحة البيانات المرسلة
    $request->validate([
        'comment' => 'required|string',
    ]);

    // تحديث التعليق
    $comment->update([
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Comment updated successfully.');
}

}


