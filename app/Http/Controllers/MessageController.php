<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    protected $adminId = 5; // تأكد من أن هذا هو معرف الأدمن الثابت

    // عرض صفحة الدردشة للأدمن مع المستخدمين
    public function index()
    {
        return view('admin.chat.chat');
    }

    // دالة لجلب الرسائل بين المستخدم والأدمن
    public function getMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'ASC')->get();

        return response()->json($messages);
    }


    // دالة لإرسال رسالة
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'receiver_id' => 'required|integer'
        ]);

        $receiverId = Auth::id() === $this->adminId ? $request->receiver_id : $this->adminId;

        try {
            // استخدام DB::table للحفظ المباشر في قاعدة البيانات
            $message = DB::table('messages')->insert([
                'sender_id' => Auth::id(),
                'receiver_id' => $receiverId,
                'message' => $request->message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // التحقق من نجاح عملية الإدخال وإرجاع النتيجة المناسبة
            if ($message) {
                return response()->json(['success' => true, 'message' => 'Message sent successfully', 'data' => $message]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to save message'], 500);
            }

        } catch (\Exception $e) {
            // تسجيل الخطأ في السجل
            Log::error('Failed to insert message: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to save message', 'error' => $e->getMessage()], 500);
        }
    }

    // دالة لجلب قائمة المستخدمين للأدمن فقط
    public function getUserList()
    {
        if (Auth::id() !== $this->adminId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $users = User::where('id', '<>', $this->adminId)->get(['id', 'name']); // جلب قائمة المستخدمين باستثناء الأدمن
        return response()->json($users);
    }
    public function getNewMessages(Request $request)
{
    $lastMessageId = $request->input('lastMessageId'); // آخر رسالة تم تحميلها

    $messages = Message::where('id', '>', $lastMessageId)
                       ->where(function ($query) {
                           $query->where('sender_id', Auth::id())
                                 ->orWhere('receiver_id', Auth::id());
                       })
                       ->orderBy('created_at', 'ASC')
                       ->get();

    return response()->json($messages);
}

}
