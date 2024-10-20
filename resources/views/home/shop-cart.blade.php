@extends('layout.master')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td class="cart__product__item">
                                        <img style="width: 80px; height: auto; object-fit: cover;"
                                            src="{{ asset('storage/image-product/' . $cartItem->product->images->first()->image_url) }}"
                                            alt="{{ $cartItem->product->name }}">
                                        <div class="cart__product__item__title">
                                            <h6>{{ $cartItem->product->name }}</h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">${{ $cartItem->product->price }}</td>
                                    <td class="cart__quantity">
                                        <div class="quantity-control" style="display: flex; justify-content: center; align-items: center;">
                                            <form action="{{ route('cart.decrease', $cartItem->id) }}" method="GET" style="display: inline;">
                                                <button type="submit" class="minus-btn" style="background-color: #fff; border: none; cursor: pointer;">
                                                    <i class="fa-solid fa-circle-minus" style="color: black;">-</i> <!-- تغيير اللون إلى الأسود -->
                                                </button>
                                            </form>
                                            <input type="text" value="{{ $cartItem->quantity }}" style="width: 40px; text-align: center; border: 1px solid #ddd; margin: 0 5px;" readonly>
                                            <form action="{{ route('cart.increase', $cartItem->id) }}" method="GET" style="display: inline;">
                                                <button type="submit" class="plus-btn" style="background-color: #fff; border: none; cursor: pointer;">
                                                    <i class="fa-solid fa-circle-plus" style="color: black;">+</i> <!-- تغيير اللون إلى الأسود -->
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <td class="cart__total">${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                                    <td class="cart__close">
                                        <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon_close" style="border: none; background: transparent; cursor: pointer;"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>





        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <!-- إرسال الكود للسيرفر -->
                    <form action="{{ route('cart.applyDiscount') }}" method="POST">
                        @csrf
                        <input type="text" name="coupon_code" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>

                    @if (session('discount_message'))
                        <p style="color: green;">{{ session('discount_message') }}</p>
                    @elseif (session('discount_error'))
                        <p style="color: red;">{{ session('discount_error') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>${{ number_format($subtotal, 2) }}</span></li>
                        @if (session()->has('discount_amount'))
                            <li>Discount <span>-${{ number_format(session('discount_amount'), 2) }}</span></li>
                        @endif
                        <li>Total <span>${{ number_format($total, 2) }}</span></li>
                    </ul>
                    <a href="{{ route('checkout') }}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>


    </div>
</section>
<!-- Shop Cart Section End -->

@endsection
