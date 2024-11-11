<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Display the chat page
    public function index($receiverId = null)
    {
        $userId = Auth::id();

        // Fetch all chat partners
        $chatPartners = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with('sender', 'receiver')
            ->get()
            ->map(function ($message) use ($userId) {
                return $message->sender_id == $userId ? $message->receiver : $message->sender;
            })
            ->unique('id'); // Prevent duplicates

        // Get the last message with each chat partner
        $chatPartners->map(function ($partner) use ($userId) {
            $lastMessage = Message::where(function ($query) use ($userId, $partner) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $partner->id);
            })
                ->orWhere(function ($query) use ($userId, $partner) {
                    $query->where('sender_id', $partner->id)
                        ->where('receiver_id', $userId);
                })
                ->orderBy('created_at', 'desc')
                ->first();

            $partner->lastMessage = $lastMessage; // Attach last message to the partner
            return $partner;
        });

        $messages = collect();
        $receiver = null; // Default receiver to null

        if ($receiverId) {
            // Fetch the messages between the logged-in user and the selected receiver
            $messages = Message::where(function ($query) use ($userId, $receiverId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $receiverId);
            })
                ->orWhere(function ($query) use ($userId, $receiverId) {
                    $query->where('sender_id', $receiverId)
                        ->where('receiver_id', $userId);
                })
                ->orderBy('created_at', 'asc')
                ->get();

            // Update all messages sent to the logged-in user to mark them as read

            // Log::info('Unread messages marked as read', ['updatedRows' => $unreadMessages]);
            // Log::info('Unread messages marked as read', ['updatedRows' => $unreadMessages2]);

            $newMessagesCount = Message::where('is_read', false)->count();

            // Fetch the user details of the receiver
            $receiver = User::find($receiverId);
        }

        return view('admin.chat.chat', compact('messages', 'receiverId', 'chatPartners', 'receiver'));
    }


    // Fetch messages between the admin and the selected user
    public function getMessages($receiverId, Request $request)
    {
        $userId = Auth::id();
        $lastId = $request->input('last_id', 0);

        $messages = Message::where(function ($query) use ($userId, $receiverId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($userId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $userId);
            })
            ->where('id', '>', $lastId) // جلب الرسائل الجديدة فقط
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }


    // Send a message to the selected user
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message_content' => 'required',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message_content,
        ]);


        return redirect()->route('admin.chat', ['receiverId' => $request->receiver_id]);
    }
    public function chatView()
{
    $userId = Auth::id();

    // Check for unread messages
    $unreadMessages = Message::where('receiver_id', $userId)
                             ->where('is_read', false)
                             ->exists();

    return view('admin.chat.index', compact('unreadMessages'));
}
public function chat($receiverId)
{
    // تحديث الرسائل إلى "مقروءة" مباشرة عند الدخول للدردشة
    Message::where('receiver_id', $receiverId)->where('is_read', 0)->update(['is_read' => 1]);

    // استرجاع الرسائل بعد التحديث
    $messages = Message::where('receiver_id', $receiverId)->get();

    return view('admin.chat', compact('messages'));
}
public function showChat($receiverId)
{
    // تحديث كل الرسائل الغير مقروءة إلى مقروءة
    Message::where('receiver_id', auth()->id())
        ->where('sender_id', $receiverId)
        ->where('is_read', 0)
        ->update(['is_read' => 1]);

    // جلب بيانات الشات
    $messages = Message::where(function ($query) use ($receiverId) {
        $query->where('sender_id', auth()->id())
              ->where('receiver_id', $receiverId);
    })->orWhere(function ($query) use ($receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', auth()->id());
    })->get();

    $receiver = User::find($receiverId);
    return view('admin.chat', compact('messages', 'receiver'));
}

}
