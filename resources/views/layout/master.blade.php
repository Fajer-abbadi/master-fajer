<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">


</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">login</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->
<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <!-- Logo Section -->
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo" style="text-align: center;">
                    <img src="{{ asset('img/fofologo.png') }}" alt="fofoLogo" style="width: auto; height: 50px;">
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu" style="display: flex; justify-content: center; align-items: center;">
                    <ul style="display: flex; justify-content: center; align-items: center; list-style: none; padding: 0; margin: 0;">
                        <li style="margin: 0 15px;"><a href="{{ url('/') }}" style="text-decoration: none; color: #333;">Home</a></li>
                        <li style="margin: 0 15px;"><a href="{{ route('women.sales') }}" style="text-decoration: none; color: #333;">Sales</a></li>
                        <li style="margin: 0 15px;"><a href="{{ url('/shop') }}" style="text-decoration: none; color: #333;">Shop</a></li>
                        <li style="margin: 0 15px; position: relative;">
                           <div style="position: relative;">
    <a href="#" style="text-decoration: none; color: #333;"
       onmouseover="showDropdown()" onmouseout="hideDropdown()">Pages</a>
       <div style="position: relative;" onmouseenter="showDropdown()" onmouseleave="hideDropdown()">
        <ul id="pagesDropdown"
            style="position: absolute; top: 110%; left: 0; display: none; background: #fff; list-style: none; padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
            <li><a href="{{ route('cart.show') }}" style="text-decoration: none; color: #333; display: block; padding: 5px;">Shop Cart</a></li>
            <li><a href="{{ url('/checkout') }}" style="text-decoration: none; color: #333; display: block; padding: 5px;">Checkout</a></li>
        </ul>
    </div>

    <script>
        function showDropdown() {
            document.getElementById('pagesDropdown').style.display = 'block';
        }

        function hideDropdown() {
            document.getElementById('pagesDropdown').style.display = 'none';
        }
    </script>


                        </li>
                        <li style="margin: 0 15px;"><a href="{{ url('/blog') }}" style="text-decoration: none; color: #333;">Blog</a></li>
                        <li style="margin: 0 15px;"><a href="{{ url('/contact') }}" style="text-decoration: none; color: #333;">Contact</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Right Section for Account and Icons -->
            <div class="col-lg-3">
                <div class="header__right" style="display: flex; align-items: center; justify-content: flex-end;">
                    <div class="header__right__auth" style="margin-right: 20px;">
                        @if(Auth::check())
                        <div style="position: relative; display: inline-block;">
                            <!-- أيقونة المستخدم التي تنقل إلى صفحة الداشبورد -->
                            <a href="{{ route('user.dashboard') }}" style="text-decoration: none; color: rgb(140, 133, 133); font-size: 16px; margin-right: 10px;">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>

                            <!-- زر الإشعار لعرض الرسائل -->
                            <button id="notificationButton" style="background: none; border: none; color: rgb(140, 133, 133); position: relative; cursor: pointer;">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                <span id="notificationCount" style="position: absolute; top: -5px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                    {{ $unreadCount ?? 0 }}
                                </span>
                            </button>

                            <!-- قائمة الرسائل المنسدلة -->
                            <div id="notificationDropdown" style="display: none; position: absolute; top: 30px; right: 0; background: white; border: 1px solid #ddd; border-radius: 5px; width: 250px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 1000;">
                                <div style="padding: 10px; font-weight: bold; border-bottom: 1px solid #ddd;">Messages</div>
                                <div id="notificationMessages" style="max-height: 200px; overflow-y: auto; padding: 10px;">
                                    <!-- الرسائل ستظهر هنا -->
                                </div>
                            </div>

                            <script>
                                // عند الضغط على زر الإشعار لتصفير العداد وعرض الرسائل
                                document.getElementById('notificationButton').addEventListener('click', function() {
                                    // تصفير العداد
                                    document.getElementById('notificationCount').textContent = '0';

                                    // عرض أو إخفاء قائمة الرسائل
                                    const messageDropdown = document.getElementById('notificationDropdown');
                                    messageDropdown.style.display = messageDropdown.style.display === 'none' ? 'block' : 'none';

                                    // جلب الرسائل وعرضها في القائمة
                                    fetch('{{ route("notifications.unread") }}')
                                        .then(response => response.json())
                                        .then(data => {
                                            const messageList = document.getElementById('notificationMessages');
                                            messageList.innerHTML = ''; // تفريغ القائمة قبل عرض الرسائل الجديدة

                                            if (data.messages.length === 0) {
                                                messageList.innerHTML = '<div style="padding: 10px; color: gray;">No new messages</div>';
                                            } else {
                                                data.messages.forEach(message => {
                                                    const messageItem = document.createElement('div');
                                                    messageItem.style.padding = '10px';
                                                    messageItem.style.borderBottom = '1px solid #eee';
                                                    messageItem.textContent = message.message;
                                                    messageList.appendChild(messageItem);
                                                });
                                            }
                                        })
                                        .catch(error => console.error('Error fetching messages:', error));
                                });

                                // تحديث العداد تلقائيًا كل 30 ثانية لمعرفة إذا كان هناك رسائل جديدة
                                setInterval(function() {
                                    fetch('{{ route("notifications.unread") }}')
                                        .then(response => response.json())
                                        .then(data => {
                                            const notificationCount = document.getElementById('notificationCount');
                                            // إذا كانت هناك رسائل غير مقروءة، يعرض الرقم 1، وإلا يعرض 0
                                            notificationCount.textContent = data.messages.length > 0 ? '1' : '0';
                                        })
                                        .catch(error => console.error('Error fetching unread count:', error));
                                }, 30000); // 30000 ميلي ثانية = 30 ثانية
                            </script>







                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background-color: transparent; border: none; color: rgb(140, 133, 133); font-size: 16px; cursor: pointer;">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" style="text-decoration: none; color: rgb(140, 133, 133); font-size: 16px;">Login</a>
                        @endif
                    </div>

                    <!-- Wishlist Icon -->
                    <a href="{{ route('wishlist.index') }}" class="wishlist-icon" style="display: inline-flex; align-items: center; justify-content: center; position: relative; text-decoration: none; background-color: #fff; border-radius: 50%; width: 40px; height: 40px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-left: 10px;">
                        <i class="fa fa-heart" style="font-size: 20px; color: #e74c3c;"></i>
                        <span class="wishlist-count" style="font-size: 12px; background-color: #f00; color: #fff; border-radius: 50%; padding: 2px 6px; position: absolute; top: -5px; right: -5px; font-weight: bold;">
                            {{ $wishlistCount ?? 0 }}
                        </span>
                    </a>

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.show') }}" class="cart-icon" style="display: inline-flex; align-items: center; justify-content: center; position: relative; text-decoration: none; background-color: #fff; border-radius: 50%; width: 40px; height: 40px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-left: 10px;">
                        <i class="fa fa-shopping-bag" style="font-size: 20px; color: #2ecc71;"></i>
                        <span class="cart-count" style="font-size: 12px; background-color: #f00; color: #fff; border-radius: 50%; padding: 2px 6px; position: absolute; top: -5px; right: -5px; font-weight: bold;">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

    <!-- Header Section End -->


    @yield('content')



<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                    <p>At FAVittoria, we offer a curated selection of stylish, high-quality fashion to elevate your wardrobe. Discover unique pieces designed to reflect your individuality, with a seamless shopping experience and exceptional customer service.</p>

                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="{{ url('/blog') }}">Blogs</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="{{ url('/user/dashboard') }}">My Account</a></li>
                        <li><a href="{{ url('/checkout') }}">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#" id="newsletter-form">
                        <input type="text" id="email-input" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                </div>

                <script>
                    document.getElementById('newsletter-form').addEventListener('submit', function(event) {
                        event.preventDefault(); // لمنع إعادة تحميل الصفحة

                        // الحصول على قيمة البريد الإلكتروني (اختياري، إذا كنت تريد التحقق من الإدخال)
                        const email = document.getElementById('email-input').value;

                        if (email) { // التحقق من إدخال البريد الإلكتروني
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Subscribed!',
                                text: 'Thank you for subscribing to our newsletter.',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please enter a valid email address.',
                                confirmButtonText: 'OK'
                            });
                        }

                    });
                </script>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.cart-btn').click(function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var quantity = $('.pro-qty input').val();

        $.ajax({
            url: '{{route('cart.add1')}}',

            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    alert("Product added to cart");
                } else {
                    alert("Failed to add product");
                }
            },
            error: function(xhr) {
                alert('Error occurred while adding to cart.');
            }
        });
    });
});
</script>

<!-- تضمين مكتبة SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/mixitup.min.js') }}"></script>
<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
