@extends('layout.master')

@section('content')
<div class="profile-container">
    <div class="sidebar">
      <!-- صورة الملف الشخصي الآن في الجانب الأيسر -->
      <div class="profile-picture-sidebar">
        @if(Session::has('profile_image'))
            <img src="{{ asset('images/' . Session::get('profile_image')) }}" alt="Profile Picture" class="profile-picture">
        @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-picture">
        @endif
      </div>
      <ul>
        <li><a href="#" id="profile-link"><i class="fa fa-user"></i> Profile</a></li>
        <li><a href="#" id="orders-link"><i class="fa fa-shopping-bag"></i> Orders</a></li>
        <li><a href="#" id="cart-link"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
      </ul>
    </div>

    <div class="main-content">
      <!-- Profile Section -->
      <div id="profile-section">
        <h2>Profile</h2>

        <!-- تعديل البيانات الشخصية ورفع صورة جديدة -->
        <form method="POST" action="{{ route('user.updateProfile') }}" enctype="multipart/form-data">
          @csrf
          <label>First Name</label>
          <input type="text" name="first_name" value="{{ old('first_name', $billingInformation->first_name ?? '') }}">

          <label>Last Name</label>
          <input type="text" name="last_name" value="{{ old('last_name', $billingInformation->last_name ?? '') }}">

          <label>Email</label>
          <input type="email" name="email" value="{{ $user->email }}">

          <label>Location</label>
          <input type="text" name="city" value="{{ old('city', $billingInformation->city ?? '') }}">

          <label>Phone</label>
          <input type="text" name="phone" value="{{ old('phone', $billingInformation->phone ?? '') }}">

          <!-- رفع صورة جديدة -->
          <label>Profile Image</label>
          <input type="file" name="profile_image">

          <button type="submit" class="save-btn">Save</button>
        </form>
      </div>

      <!-- Orders Section -->
      <div id="orders-section" style="display:none;">
        <h2>Your Orders</h2>
        @if($orders->count() > 0)
            <div class="order-cards">
                @foreach($orders as $order)
                    <div class="order-card">
                        <h3>Order #{{ $order->id }}</h3>
                        <p>Status: <strong>{{ $order->status }}</strong></p>
                        <p>Date: {{ $order->created_at->format('d M Y') }}</p>
                        <p>Total: ${{ $order->total }}</p>
                        <a href="#" class="view-order-btn">View Details</a>
                    </div>
                @endforeach
            </div>
        @else
            <p>You have no orders yet.</p>
        @endif
      </div>

      <!-- Cart Section -->
      <div id="cart-section" style="display:none;">
        <h2>My Cart</h2>
        @if($cartItems->count() > 0)
            <div class="cart-cards">
                @foreach($cartItems as $item)
                    <div class="cart-card">
                        <img src="{{ asset('storage/image-product/' . $item->product->image) }}" alt="Product Image" class="cart-product-image">
                        <p>{{ $item->product->image }}</p>

                        <h3>{{ $item->product->name }}</h3>
                        <p>Price: ${{ $item->product->price }}</p>
                        <p>Quantity: {{ $item->quantity }}</p>
                        <a href="#" class="remove-item-btn">Remove</a>
                    </div>
                @endforeach
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
      </div>
    </div>
</div>

<!-- CSS Styles -->
<style>
    body {
        font-family: 'Arial', sans-serif;
    }
    .profile-container {
        display: flex;
        height: 100vh;
    }
    .sidebar {
        background: linear-gradient(135deg, #A10119, #A10119);
        width: 200px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .profile-picture-sidebar {
        margin-bottom: 20px;
    }
    .profile-picture {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-bottom: 20px;
    }
    .sidebar ul {
        list-style: none;
        padding: 0;
        width: 100%;
    }
    .sidebar ul li {
        margin-bottom: 20px;
        text-align: center;
    }
    .sidebar ul li a {
        color: white;
        text-decoration: none;
        font-size: 18px;
    }
    .sidebar ul li a i {
        margin-right: 10px;
    }
    .main-content {
        flex-grow: 1;
        padding: 40px;
    }
    .profile-picture {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-bottom: 20px;
    }
    form label {
        display: block;
        margin-top: 10px;
    }
    form input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .save-btn {
        background: linear-gradient(135deg, #A10119, #A10119);
        color: white;
        border: none;
        padding: 10px 20px;
        margin-top: 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    /* تصميم جميل للطلبات */
    .order-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .order-card {
        background: #f5f5f5;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        width: 250px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    .order-card:hover {
        transform: scale(1.05);
    }
    .order-card h3 {
        margin: 0;
        margin-bottom: 10px;
    }
    .view-order-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 15px;
        background: #d02828;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .view-order-btn:hover {
        background: #CA1515;
    }

    /* تصميم الكارت */
    .cart-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .cart-card {
        background: #f5f5f5;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        width: 250px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    .cart-card img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-bottom: 10px;
    }
    .remove-item-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 15px;
        background: #d02828;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .remove-item-btn:hover {
        background: #CA1515;
    }
</style>

<script>
    document.getElementById('profile-link').addEventListener('click', function() {
        document.getElementById('profile-section').style.display = 'block';
        document.getElementById('orders-section').style.display = 'none';
        document.getElementById('cart-section').style.display = 'none';
    });

    document.getElementById('orders-link').addEventListener('click', function() {
        document.getElementById('profile-section').style.display = 'none';
        document.getElementById('orders-section').style.display = 'block';
        document.getElementById('cart-section').style.display = 'none';
    });

    document.getElementById('cart-link').addEventListener('click', function() {
        document.getElementById('profile-section').style.display = 'none';
        document.getElementById('orders-section').style.display = 'none';
        document.getElementById('cart-section').style.display = 'block';
    });
</script>

<br><br>
<!-- Instagram Section -->
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpeg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpeg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
