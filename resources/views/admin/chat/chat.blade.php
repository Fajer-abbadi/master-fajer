@extends('layout.admin_master')

@section('content')
@php
    // تحديث جميع الرسائل غير المقروءة إلى مقروءة عند فتح الصفحة
    \App\Models\Message::where('receiver_id', auth()->id())
        ->where('sender_id', $receiver->id)
        ->where('is_read', 0)
        ->update(['is_read' => 1]);
@endphp

    <div style="width: 80%; margin: 20px auto; padding: 15px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 15px;">Chat with Users</h1>

        <div class="chat-container" style="display: flex; height: 500px; border-radius: 10px; overflow: hidden;">
            <!-- Sidebar for Users -->
            <div class="chat-sidebar" style="width: 18%; background-color: #A688CA; color: #fff; padding: 10px; border-radius: 10px 0 0 10px; overflow-y: auto;">
                <h3 style="font-size: 1em; color: #fff; text-align: center; margin-bottom: 10px;">Chats</h3>
                <ul id="user-list" style="list-style: none; padding: 0; margin: 0;">
                    @if ($chatPartners->isNotEmpty())
                        @foreach ($chatPartners as $partner)
                            <a href="{{ route('admin.chat', ['receiverId' => $partner->id]) }}" class="chat-history-item" style="display: block; color: #fff; text-decoration: none; transition: background-color 0.2s; border-radius: 5px; margin-bottom: 10px; padding: 8px; background-color: #9B89C9;">
                                <div style="font-size: 1em; font-weight: bold; color: #FFFFFF; margin-bottom: 4px;">
                                    {{ $partner->name ?? 'User ID: ' . $partner->id }}
                                </div>
                                <div style="font-size: 0.8em; color: #e0e0e0;">
                                    {{ $partner->lastMessage ? $partner->lastMessage->created_at->diffForHumans() : __('messages.Nohistory') }}
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p style="text-align: center; color: #e0e0e0;">{{ __('messages.Nohistory') }}</p>
                    @endif
                </ul>
            </div>

            <!-- Main Chat Area -->
            <div class="chat-main" style="flex: 1; display: flex; flex-direction: column; background-color: #f7f5fa; padding: 15px; border-radius: 0 10px 10px 0;">
                <!-- Chat Header with User Name -->
                <div id="chat-header" style="background-color: #9a66d1; color: #ffffff; padding: 10px; border-radius: 10px; font-weight: bold; margin-bottom: 10px; text-align: center;">
                    chat with {{ $receiver->name }}
                </div>

                <!-- Chat Messages Area -->
                <div id="messages" style="flex: 1; overflow-y: auto; padding: 10px; background-color: #A688CA; border-radius: 10px; box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);">
                    @foreach ($messages as $message)
                        <div class="message {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}" style="display: flex; margin-bottom: 8px; {{ $message->sender_id === Auth::id() ? 'justify-content: flex-end;' : 'justify-content: flex-start;' }}">
                            <div class="message-content" style="max-width: 60%; padding: 10px; border-radius: 10px; {{ $message->sender_id === Auth::id() ? 'background-color: #b7acc3; color: #e0e0e0;' : 'background-color: #9a66d1; color: #fff;' }}">
                                <p style="margin: 0; font-size: 0.9em;">{{ $message->message }}</p>
                                <span class="message-time" style="font-size: 0.75em; color: #e0e0e0; display: block; text-align: right; margin-top: 5px;">
                                    {{ $message->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Chat Input -->
                <div style="display: flex; align-items: center; padding: 8px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); margin-top: 10px;">
                    <form id="chat-form" action="{{ route('chat.sendMessage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
                        <input type="text" name="message_content" class="form-control" placeholder="Type a message..." required style="flex: 1; border: none; border-radius: 10px; padding: 10px;">
                        <button type="submit" class="btn" style="background-color: #A688CA; color: #fff; border-radius: 10px; padding: 10px 20px; margin-left: 10px;">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let lastMessageId = {{ $messages->last()->id ?? 0 }}; // Track the last message ID

        // Function to fetch new messages
        function fetchMessages() {
            $.ajax({
                url: '{{ route('chat.getMessages', ['receiverId' => $receiverId]) }}',
                method: 'GET',
                data: { last_id: lastMessageId },
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(message => {
                            lastMessageId = Math.max(lastMessageId, message.id);

                            const messageClass = message.sender_id == {{ Auth::id() }} ? 'sent' : 'received';
                            $('#messages').append(`
                                <div class="message ${messageClass}" style="display: flex; margin-bottom: 8px; ${messageClass === 'sent' ? 'justify-content: flex-end;' : 'justify-content: flex-start;'}">
                                    <div class="message-content" style="max-width: 60%; padding: 10px; border-radius: 10px; ${messageClass === 'sent' ? 'background-color: #9a66d1; color: #fff;' : 'background-color: #a688ca; color: #fff;'}">
                                        <p style="margin: 0; font-size: 0.9em;">${message.message}</p>
                                        <span class="message-time" style="font-size: 0.75em; color: #9a66d1; display: block; text-align: right; margin-top: 5px;">
                                            ${new Date(message.created_at).toLocaleTimeString()}
                                        </span>
                                    </div>
                                </div>
                            `);
                        });

                        // Scroll to the bottom of the messages div
                        $('#messages').scrollTop($('#messages')[0].scrollHeight);
                    }
                }
            });
        }

        // Fetch messages every 2 seconds
        setInterval(fetchMessages, 2000);

        // Send message via AJAX without reloading the page
        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            const messageContent = $('input[name="message_content"]').val();
            const receiverId = $('input[name="receiver_id"]').val();

            $.ajax({
                url: '{{ route('chat.sendMessage') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message_content: messageContent,
                    receiver_id: receiverId,
                },
                success: function() {
                    $('input[name="message_content"]').val('');
                    fetchMessages(); // Fetch messages again to display the new message
                }
            });
        });
    </script>
@endsection
