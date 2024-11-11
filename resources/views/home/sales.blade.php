@extends('layout.master')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./"><i class="fa fa-home"></i> Home</a>
                        <span>Sales</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/image-product/' . ($product->images->first() ? $product->images->first()->image_url : 'default.jpg')) }}">
                                    <div class="sale-badge">SALE</div> <!-- علامة السيل -->
                                    <ul class="product__hover">
                                        <li><a href="{{ route('product.details', ['id' => $product->id]) }}" style="background-color: #fff; color: #333; padding: 2px; border-radius: 50%;"><i class="fa fa-expand"></i></a></li>
                                        <li>
                                            <a href="#" class="add-to-wishlist" data-product-id="{{ $product->id }}" style="background-color: #fff; color: #e74c3c; padding: 2px; border-radius: 50%;">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="add-to-cart" data-product-id="{{ $product->id }}" style="background-color: #fff; color: #2ecc71; padding: 2px; border-radius: 50%;">
                                                <i class="fa fa-shopping-bag"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('product.details', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                                    <div class="rating">
                                        @php
                                            $averageRating = round($product->reviews->avg('rating'));
                                        @endphp

                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $averageRating)
                                                <i class="fa fa-star" style="color: #FFD700;"></i> <!-- نجمة معبأة -->
                                            @else
                                                <i class="fa fa-star-o" style="color: #FFD700;"></i> <!-- نجمة فارغة -->
                                            @endif
                                        @endfor
                                    </div>

                                    <div class="product__price">
                                        <span style="text-decoration: line-through; color: gray; font-size: 14px; margin-right: 5px;">
                                            ${{ $product->price }}
                                        </span>
                                        <span style="text-decoration: none !important; color: #C40206; font-weight: bold; font-size: 16px;">
                                            ${{ $product->discount_price }}
                                        </span>
                                    </div>




                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagination__option text-center">
                        {{ $products->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <!-- Custom Styles -->
    <style>
        /* الشارة للبيع */
        .sale-badge {
            background-color: #C40206;
            color: white;
            font-size: 14px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* تنسيق السعر القديم */


        /* إضافة تنسيق للموقع النسبي للعنصر */
        .product__item__pic {
            position: relative;
        }
    </style>


    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // إضافة المنتج للمفضلة
            document.querySelectorAll('.add-to-wishlist').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let productId = this.getAttribute('data-product-id');

                    fetch(`/wishlist/add`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_id: productId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let wishlistCount = document.querySelector('.wishlist-count');
                            wishlistCount.textContent = parseInt(wishlistCount.textContent) + 1;
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Wishlist',
                                text: 'The product has been added to your wishlist!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else if (data.message === 'already_exists') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Already Added',
                                text: 'This product is already in your wishlist.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });

            // إضافة المنتج للسلة
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let productId = this.getAttribute('data-product-id');

                    fetch(`/cart-add`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_id: productId, quantity: 1 })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let cartCount = document.querySelector('.cart-count');
                            cartCount.textContent = parseInt(cartCount.textContent) + 1;
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Cart',
                                text: 'The product has been added to your cart!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
