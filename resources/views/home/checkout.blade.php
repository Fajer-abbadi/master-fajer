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
    <div class="d-flex container">
    </div>
    <div class="d-flex container">

        <div class="row">
        </div>

        <!-- Form for billing information -->
        <form action="{{ route('checkout.billing') }}" method="POST" class="col-lg-7 p-3 checkout__form" id="billingForm">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h5>Billing detail</h5>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>First Name <span>*</span></p>
                        <input type="text" name="first_name" value="{{ $biling->first_name ?? '' }}" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Last Name <span>*</span></p>
                        <input type="text" name="last_name" value="{{ $biling->last_name ?? '' }}" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="checkout__form__input">
                        <p>Country <span>*</span></p>
                        <input type="text" name="country" value="{{ $biling->country ?? '' }}" required>
                    </div>
                    <div class="checkout__form__input">
                        <p>Address <span>*</span></p>
                        <input type="text" name="address" placeholder="Street Address" value="{{ $biling->address ?? '' }}" required>
                        <input type="text" name="address_optional" placeholder="Apartment, suite, unit, etc (optional)">
                    </div>
                    <div class="checkout__form__input">
                        <p>Town/City <span>*</span></p>
                        <input type="text" name="city" value="{{ $biling->city ?? '' }}" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Phone <span>*</span></p>
                        <input type="text" name="phone" value="{{ $biling->phone ?? '' }}" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="site-btn">Save Billing Information</button>
        </form>

        <!-- Form for placing the order -->
        <form action="{{ route('checkout.order') }}" method="POST" class="col-lg-5 checkout__form" id="orderForm">
            @csrf
            <div class="checkout__order">
                <h5>Your order</h5>
                <div class="checkout__order__product">
                    <ul>
                        <li>
                            <span class="top__text">Product</span>
                            <span class="top__text__right">Total</span>
                        </li>
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
                        COD
                        <input type="radio" id="COD" name="payment_method" value="COD" required>
                        <span class="checkmark"></span>
                    </label>
                    <label for="credit_card">
                        Credit Card
                        <input type="radio" id="credit_card" name="payment_method" value="credit_card" required>
                        <span class="checkmark"></span>
                    </label>
                </div>

                <!-- Credit Card Form -->
                <div id="creditCardForm" style="display: none;">
                    <div class="form-group">
                        <label for="card_number">Card Number</label>
                        <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Enter Card Number">
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder="MM/YY">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" class="form-control" placeholder="CVV">
                    </div>
                </div>

                <button type="submit" id="placeOrderBtn" class="site-btn">Place Order</button>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const creditCardOption = document.getElementById('credit_card');
                const codOption = document.getElementById('COD');
                const creditCardForm = document.getElementById('creditCardForm');

                creditCardOption.addEventListener('change', function () {
                    if (this.checked) {
                        creditCardForm.style.display = 'block';
                    }
                });

                codOption.addEventListener('change', function () {
                    if (this.checked) {
                        creditCardForm.style.display = 'none';
                    }
                });
            });

            document.getElementById('orderForm').addEventListener('submit', function (e) {
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

                if (paymentMethod === 'credit_card') {
                    const cardNumber = document.getElementById('card_number').value;
                    const expiryDate = document.getElementById('expiry_date').value;
                    const cvv = document.getElementById('cvv').value;

                    // التحقق من تعبئة حقول بطاقة الائتمان
                    if (cardNumber === '' || expiryDate === '' || cvv === '') {
                        alert('Please fill in all credit card details.');
                        e.preventDefault();  // منع الفورم من الإرسال
                        return;
                    }

                    // التحقق من صحة الرقم (يمكن إضافة طرق تحقق أكثر تعقيدًا مثل Luhn Algorithm)
                    if (!/^\d{16}$/.test(cardNumber)) {
                        alert('Please enter a valid 16-digit card number.');
                        e.preventDefault();
                        return;
                    }

                    // التحقق من صحة تاريخ الانتهاء (بسيط فقط للتحقق من النمط MM/YY)
                    if (!/^(0[1-9]|1[0-2])\/?([0-9]{2})$/.test(expiryDate)) {
                        alert('Please enter a valid expiry date in MM/YY format.');
                        e.preventDefault();
                        return;
                    }

                    // التحقق من صحة الـ CVV (يجب أن يكون 3 أو 4 أرقام)
                    if (!/^\d{3,4}$/.test(cvv)) {
                        alert('Please enter a valid CVV.');
                        e.preventDefault();
                        return;
                    }
                }
            });
        </script>


        <script>
            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session("success") }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        </script>

    </div>
</section>
<!-- Checkout Section End -->

@endsection
