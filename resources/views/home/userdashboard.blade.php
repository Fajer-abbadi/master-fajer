@extends('layout.master')

@section('content')
<div class="profile-container">
    <div class="background-container">
        <div class="profile-card">
            <div class="top-navigation">
                <ul>
                    <li><a href="#" id="profile-link"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="#" id="orders-link"><i class="fa fa-shopping-bag"></i> Orders</a></li>
                    <li><a href="#" id="cart-link"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                    <li><a href="#" id="chat-link"><i class="fa fa-comments"></i> Chat</a></li>
                </ul>
            </div>

            <div class="profile-picture">
                @if($user->profile_image)
                <img src="{{ asset('storage/images/' . $user->profile_image) }}" alt="Profile Image">
            @else
                <div style="width: 100px; height: 100px; background-color: #A10119; color: white; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: bold; border-radius: 50%; text-transform: uppercase;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            </div>

            <div id="profile-section" style="display: block;">
                <form method="POST" action="{{ route('user.updateProfile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-container">
                        <!-- Row 1: First and Last Name -->
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $billingInformation->first_name ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $billingInformation->last_name ?? '') }}">
                        </div>

                        <!-- Row 2: Address and City -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $billingInformation->address ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $billingInformation->city ?? '') }}">
                        </div>

                        <!-- Row 3: Country and Phone -->
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" value="{{ old('country', $billingInformation->country ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $billingInformation->phone ?? '') }}">
                        </div>

                        <!-- Row 4: Email Full Width -->
                        <div class="form-group full-width">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>
                        </div>

                        <!-- Row 5: Profile Image Upload Full Width -->
                        <div class="form-group full-width">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" id="profile_image" name="profile_image">
                        </div>
                    </div>
                    <button type="submit" class="save-btn">Save</button>
                </form>
            </div>

             <!-- Orders Section -->
             <div id="orders-section" style="display: none; padding: 20px; border: 1px solid #A10119; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); max-height: 300px; overflow-y: auto;">
                <div id="ordersContainer" style="max-height: 250px; overflow-y: auto;">
                    @if($orders->count() > 0)
                        <div class="order-cards" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
                            @foreach($orders as $order)
                                <div class="order-card" style="width: 250px; text-align: center; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                                    <h3>Order #{{ $order->id }}</h3>
                                    <p>Status: <strong>{{ $order->status }}</strong></p>
                                    <p>Date: {{ $order->created_at->format('d M Y') }}</p>
                                    <p>Total: ${{ $order->total_amount }}</p>
                                    <a href="#" class="view-order-btn" style="background-color: #A10119; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">View Details</a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No orders found.</p>
                    @endif
                </div>
            </div>



            <!-- Cart Section -->
            <div id="cart-section" style="display: none; padding: 20px; border: 1px solid #A10119; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); max-height: 300px; overflow-y: auto;">
                <div id="cartContainer" style="max-height: 250px; overflow-y: auto;">
                    @if(isset($cartItems) && count($cartItems) > 0)
                        <div class="cart-cards" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
                            @foreach($cartItems as $item)
                                <div class="cart-card" style="width: 200px; text-align: center; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                                    <img src="{{ asset('storage/image-product/' . ($item->product->images->first()->image_url ?? 'default.jpg')) }}" alt="{{ $item->product->name }}" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;">
                                    <h4>{{ $item->product->name }}</h4>
                                    <p>Quantity: {{ $item->quantity }}</p>
                                    <p>Price: ${{ $item->product->price }}</p>
                                    <a href="/cart" class="show-item-btn" style="color: #A10119; text-decoration: none;">Show</a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>
            </div>

            <div id="chatSection" style="display: none; margin-top: 20px;">
                <div style="background-color: #A10119; color: white; padding: 10px; border-radius: 8px 8px 0 0; text-align: center; font-size: 24px; font-weight: bold;">
                    Messages
                </div>
                <div style="padding: 20px; border: 1px solid #A10119; border-top: none; border-radius: 0 0 8px 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                    <!-- منطقة الرسائل مع سكرول داخل الديف -->
                    <div id="chatMessages" style="margin-bottom: 15px; height: 150px; overflow-y: auto; padding-right: 10px; border: 1px solid #ddd; border-radius: 8px;">
                        <!-- الرسائل ستظهر هنا -->
                    </div>

                    <!-- نموذج إرسال الرسالة -->
                    <form id="messageForm" method="POST" onsubmit="sendMessage(); return false;">
                        @csrf
                        <input type="hidden" name="receiver_id" id="receiver_id" value="1">
                        <textarea id="messageInput" name="message" placeholder="Type your message..." style="width: 100%; height: 80px; padding: 10px; border-radius: 8px; border: 1px solid #ccc; resize: none;"></textarea>
                        <button type="submit" style="background-color: #A10119; color: white; padding: 10px 20px; border: none; border-radius: 8px; margin-top: 10px; cursor: pointer; float: right;">Send</button>
                    </form>
                </div>
            </div>

            <script>
                document.getElementById('chat-link').addEventListener('click', function(event) {
                    event.preventDefault();

                    // إخفاء جميع الأقسام الأخرى
                    document.getElementById('profile-section').style.display = 'none';
                    document.getElementById('orders-section').style.display = 'none';
                    document.getElementById('cart-section').style.display = 'none';

                    // إظهار قسم الدردشة
                    document.getElementById('chatSection').style.display = 'block';
                });

                function addMessage(content, sender) {
                    const messageElement = document.createElement('div');
                    messageElement.textContent = content;
                    messageElement.style.padding = '8px 12px';
                    messageElement.style.borderRadius = '10px';
                    messageElement.style.maxWidth = '75%';
                    messageElement.style.wordWrap = 'break-word';
                    messageElement.style.marginBottom = '10px';

                    if (sender === 'user') {
                        messageElement.style.alignSelf = 'flex-end';
                        messageElement.style.backgroundColor = '#d1f5d3';
                        messageElement.style.color = '#333';
                    } else if (sender === 'admin') {
                        messageElement.style.alignSelf = 'flex-start';
                        messageElement.style.backgroundColor = '#f1f0f0';
                        messageElement.style.color = '#333';
                    }

                    document.getElementById('chatMessages').appendChild(messageElement);

                    // التمرير إلى أسفل الرسائل تلقائيًا عند إضافة رسالة جديدة
                    const chatMessagesDiv = document.getElementById('chatMessages');
                    chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;
                }

                function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const messageContent = messageInput.value.trim();
    const receiverId = document.getElementById('receiver_id').value;

    console.log("Message content:", messageContent);
    console.log("Receiver ID:", receiverId);

    if (messageContent) {
        addMessage(messageContent, 'user');
        fetch("{{ route('messages.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message: messageContent, receiver_id: receiverId })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response data:", data);
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Message sent successfully!',
                    text: 'Your message has been sent.',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Please try again.',
                    confirmButtonText: 'OK'
                });
            }
            messageInput.value = '';
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again later.',
                confirmButtonText: 'OK'
            });
        });
    }
}

            </script>






        </div>
        </div>

        </div>

        </div>
    </div>
</div>

<!-- CSS Styles -->
<style>
    .background-container {
        display: flex;
        justify-content: center;
        background: linear-gradient(135deg, #A10119, #A10119);
        padding-top: 100px;
        padding-bottom: 400px;
        overflow: visible;
        position: relative;
    }

    .profile-card {
        background-color: white;
        width: 600px;
        padding: 40px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        position: absolute;
        top: 50px;
    }

    .profile-picture {
        position: absolute;
        top: -60px;
        left: 50%;
        transform: translateX(-50%);
    }
    .profile-picture img {
        border-radius: 50%;
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 5px solid white;
    }

    .top-navigation {
        margin-top: 40px;
        margin-bottom: 20px;
    }
    .top-navigation ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: space-around;
    }
    .top-navigation ul li a {
        color: #A10119;
        text-decoration: none;
        font-size: 16px;
    }

    .form-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        max-width: 500px;
        margin: 20px auto;
    }
    .form-group {
        flex: 1 1 48%;
        text-align: left;
    }
    .full-width {
        flex-basis: 100%;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
        display: inline-block;
    }
    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .save-btn {
        background: linear-gradient(135deg, #A10119, #A10119);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }
</style>

<!-- JavaScript for Section Toggling -->
<script>
    document.getElementById('profile-link').addEventListener('click', function() {
        document.getElementById('profile-section').style.display = 'block';
        document.getElementById('orders-section').style.display = 'none';
        document.getElementById('cart-section').style.display = 'none';
        document.getElementById('chat-section').style.display = 'none';
    });

    document.getElementById('orders-link').addEventListener('click', function() {
        document.getElementById('profile-section').style.display = 'none';
        document.getElementById('orders-section').style.display = 'block';
        document.getElementById('cart-section').style.display = 'none';
        document.getElementById('chat-section').style.display = 'none';
    });

    document.getElementById('cart-link').addEventListener('click', function() {
        document.getElementById('profile-section').style.display = 'none';
        document.getElementById('orders-section').style.display = 'none';
        document.getElementById('cart-section').style.display = 'block';
        document.getElementById('chat-section').style.display = 'none';
    });

    document.getElementById('chat-link').addEventListener('click', function() {
        document.getElementById('profile-section').style.display = 'none';
        document.getElementById('orders-section').style.display = 'none';
        document.getElementById('cart-section').style.display = 'none';
        document.getElementById('chat-section').style.display = 'block';
    });
</script>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-8 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpeg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr" target="_blank">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpeg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr" target="_blank">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr" target="_blank">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr" target="_blank">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr" target="_blank">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr" target="_blank">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
