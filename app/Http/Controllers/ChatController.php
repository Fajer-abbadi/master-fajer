<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // تأكد من استيراد موديل Message

class ChatController extends Controller
{
    // دالة لعرض صفحة الدردشة
    public function index()
    {
        return view('admin.chat.chat'); // عرض واجهة الدردشة
    }

    // دالة لجلب الرسائل بين المستخدم والإدمن
    public function getMessages($userId)
    {
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'ASC')->get();

        return response()->json($messages);
    }

    // دالة لإرسال رسالة
    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return response()->json($message);
    }
}
