@extends('layout.admin_master')

@section('content')
<div class="chat-header" style="padding:1px; background-color: #a90f0f; color: #050101; text-align: center;">
    <h1 style=" color: #f0ecec";>Chat with Users</h1>
</div>

<div class="chat-container" style="display: flex; height: calc(100vh - 100px); margin-left: 20px; margin-top: 10px; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <div class="chat-sidebar" style="width: 15%; background-color: #a90f0f; color: #ecf0f1; padding: 20px;">
        <h3 style="font-size: 18px; margin-bottom: 15px; color: #ecf0f1;">Users</h3>
        <ul id="user-list" style="list-style: none; padding: 0;">
            <li style="padding: 15px; border-bottom: 1px solid #34495e; cursor: pointer; transition: background-color 0.3s;">John Doe</li>
            <li style="padding: 15px; border-bottom: 1px solid #34495e; cursor: pointer; transition: background-color 0.3s;">Jane Smith</li>
            <!-- أضف المستخدمين الديناميكيين هنا -->
        </ul>
    </div>
    <div class="chat-main" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between; background-color: #ecf0f1; padding: 20px;">
        <div class="chat-messages" id="messages" style="flex: 1; padding: 15px; overflow-y: auto; background-color: #fff; border-radius: 5px; box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);">
            <!-- عرض الرسائل هنا -->
        </div>
        <div class="chat-input" style="display: flex; align-items: center; padding: 10px 0; border-top: 1px solid #ddd; background-color: #fff;">
            <textarea id="message-input" placeholder="Type your message..." rows="2" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; resize: none; margin-right: 10px;"></textarea>
            <button onclick="sendMessage()" class="btn btn-primary" style="padding: 10px 20px; background-color: #4a76a8; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; transition: background-color 0.3s;">Send</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function loadMessages(userId) {
        fetch(`/admin/chat/messages/${userId}`)
            .then(response => response.json())
            .then(messages => {
                let messagesContainer = document.getElementById('messages');
                messagesContainer.innerHTML = '';
                messages.forEach(msg => {
                    let messageClass = msg.sender_id === {{ auth()->id() }} ? 'user-message' : 'other-message';
                    messagesContainer.innerHTML += `<p class="${messageClass}" style="padding: 10px 15px; border-radius: 10px; margin: 10px 0; max-width: 70%; word-wrap: break-word; font-size: 15px; background-color: ${messageClass === 'user-message' ? '#4a76a8' : '#bdc3c7'}; color: ${messageClass === 'user-message' ? '#fff' : '#2c3e50'}; align-self: ${messageClass === 'user-message' ? 'flex-end' : 'flex-start'};">${msg.message}</p>`;
                });
                messagesContainer.scrollTop = messagesContainer.scrollHeight; // للتمرير للأسفل عند تحميل الرسائل
            });
    }

    function sendMessage() {
        let message = document.getElementById('message-input').value;
        let receiverId = /* ضع هنا ID الخاص بالمستخدم المستلم */;

        fetch('/admin/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                message: message,
                receiver_id: receiverId
            })
        }).then(() => {
            document.getElementById('message-input').value = '';
            loadMessages(receiverId);
        });
    }

    // استدعاء الدالة لتحميل الرسائل عند فتح الصفحة
    loadMessages(/* ضع هنا ID الخاص بالإدمن أو المستخدم */);
</script>
@endsection
