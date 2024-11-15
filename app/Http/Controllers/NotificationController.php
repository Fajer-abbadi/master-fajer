<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class NotificationController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
        $unreadCount = Message::where('receiver_id', $userId)->where('is_read', 0)->count();

        return view('notifications.index', compact('unreadCount'));

}
    public function getUnreadMessages()
    {
        $userId = auth()->id(); // جلب المعرف الصحيح للمستخدم الحالي
        $messages = Message::where('receiver_id', $userId)
                           ->where('is_read', 0)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return response()->json(['messages' => $messages]);
    }

    public function showNotifications()
    {
        $userId = auth()->id(); // تأكد من أن المستخدم مسجل دخول
        $messages = Message::where('receiver_id', $userId)->where('is_read', 0)->get(); // اجلب الرسائل غير المقروءة

        $unreadCount = $messages->count();

        return view('home.index', compact('messages', 'unreadCount')); // تمرير المتغيرات إلى الـ view
    }
    public function showMessages()
    {
        $userId = Auth::id(); // معرف المستخدم الحالي
        $messages = Message::where('receiver_id', $userId)->where('is_read', 0)->get();
        $unreadCount = $messages->count();

        return view('home.index', compact('messages', 'unreadCount'));
    }



}
