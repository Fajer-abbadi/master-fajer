@extends('layout.master')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
        </div>
        <form action="{{ route('checkout.store') }}" method="POST" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>First Name <span>*</span></p>
                                <input type="text" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Last Name <span>*</span></p>
                                <input type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Country <span>*</span></p>
                                <input type="text" name="country" required>
                            </div>
                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" required>
                                <input type="text" name="address_optional" placeholder="Apartment, suite, unit, etc (optional)">
                            </div>
                            <div class="checkout__form__input">
                                <p>Town/City <span>*</span></p>
                                <input type="text" name="city" required>
                            </div>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Phone <span>*</span></p>
                                <input type="text" name="phone" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Email <span>*</span></p>
                                <input type="email" name="email" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Your order</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Product</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                <!-- Loop through cart items and display them -->
                                @foreach ($cartItems as $cartItem)
                                    <li>{{ $loop->iteration }}. {{ $cartItem->product->name }} <span>${{ $cartItem->product->price * $cartItem->quantity }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>${{ number_format($subtotal, 2) }}</span></li>
                                <li>Total <span>${{ number_format($total, 2) }}</span></li>
                            </ul>
                        </div>
                        <div class="checkout__order__widget">
                            <label for="paypal">
                                PayPal
                                <input type="radio" id="paypal" name="payment_method" value="paypal" required>
                                <span class="checkmark"></span>
                            </label>
                            <label for="credit_card">
                                Credit Card
                                <input type="radio" id="credit_card" name="payment_method" value="credit_card" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" id="placeOrderBtn" class="site-btn">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
    document.getElementById('placeOrderBtn').addEventListener('click', function(event) {
        // منع إرسال الفورم مؤقتاً
        event.preventDefault();

        // تنفيذ أي عملية تحقق أو شروط هنا إذا كنت تريد

        // إظهار التنبيه بنجاح
        alert('Order placed successfully!');

        // بعد التنبيه، يمكنك السماح للفورم بالعمل وإرساله
        document.querySelector('form.checkout__form').submit();
    });
</script>

    </div>
</section>
<!-- Checkout Section End -->

@endsection
