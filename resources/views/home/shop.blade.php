@extends('layout.master');
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
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
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    @foreach ($categories as $category)
                                    <div class="card">
                                        <div>
                                            <a href="{{ route('shop.index', ['category_id' => $category->id]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <form method="GET" action="{{ route('shop.index') }}">
                                <div class="filter-range-wrap">
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <p>Price:</p>
                                            <label>Min:</label>
                                            <input type="number" name="min_price" value="{{ request('min_price', 1) }}" min="1" style="width: 60px; margin-right: 10px;">
                                            <label>Max:</label>
                                            <input type="number" name="max_price" value="{{ request('max_price', 100) }}" max="100" style="width: 60px;">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-custom-filter" style="margin-top: 10px;">Filter</button>
                            </form>
                        </div>


                        <!-- size Filter -->

                        <form method="GET" action="{{ route('shop.index') }}">
                            <div class="size__list">
                                @foreach (['xxs', 'xs', 's', 'm', 'l', 'xl'] as $size)
                                <label for="{{ $size }}">
                                    <input type="checkbox" name="size[]" value="{{ $size }}" id="{{ $size }}"
                                    {{ request('size') && in_array($size, request('size')) ? 'checked' : '' }}>
                                    {{ strtoupper($size) }}
                                </label>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-filter">Filter</button>
                        </form>



                        <!-- Color Filter -->
                        <form method="GET" action="{{ route('shop.index') }}">
                            <div class="size__list color__list">
                                @foreach (['black', 'white', 'red', 'grey', 'blue', 'beige', 'green', 'yellow'] as $color)
                                <label for="{{ $color }}">
                                    <input type="checkbox" name="color[]" value="{{ $color }}" id="{{ $color }}"
                                    {{ request('color') && in_array($color, request('color')) ? 'checked' : '' }}>
                                    {{ ucfirst($color) }}
                                </label>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-filter">Filter</button>
                        </form>

                    </div>
                </div>

                <!-- Product Display Section -->
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/image-product/' . ($product->images->first() ? $product->images->first()->image_url : 'default.jpg')) }}">
                                    <ul class="product__hover">
                                        <!-- عرض التفاصيل -->
                                        <li>
                                            <a href="{{ route('product.details', ['id' => $product->id]) }}" style="background-color: #fff; color: #333; padding: 9px; border-radius: 50%;">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </li>

                                        <!-- إضافة إلى المفضلة -->
                                        <li>
                                            <a href="#" class="add-to-wishlist" data-product-id="{{ $product->id }}" style="background-color: #fff; color: #e74c3c; padding: 9px; border-radius: 50%;">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </li>

                                        <!-- إضافة إلى السلة -->
                                        <li>
                                            <a href="#" class="add-to-cart" data-product-id="{{ $product->id }}" style="background-color: #fff; color: #2ecc71; padding: 9px; border-radius: 50%;">
                                                <i class="fa fa-shopping-bag"></i>
                                            </a>
                                        </li>
                                    </ul>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // تفعيل زر "إضافة إلى المفضلة"
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
                    // تحديث عدد المفضلة في الأيقونة
                    let wishlistCount = document.querySelector('.wishlist-count');
                    wishlistCount.textContent = parseInt(wishlistCount.textContent) + 1;

                    // رسالة تأكيد الإضافة
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

    // تفعيل زر "إضافة إلى السلة"
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            let productId = this.getAttribute('data-product-id');

            // تعطيل الزر مؤقتاً لمنع النقرات المتعددة
            this.disabled = true;

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
                    // تحديث عدد السلة في الأيقونة
                    let cartCount = document.querySelector('.cart-count');
                    cartCount.textContent = parseInt(cartCount.textContent) + 1;

                    // رسالة تأكيد الإضافة
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart',
                        text: 'The product has been added to your cart!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                // إعادة تفعيل الزر بعد انتهاء العملية
                this.disabled = false;
            });
        });
    });
});



</script>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('product.details', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                                    <div class="rating">
                                        @php
                                            $averageRating = round($product->reviews->avg('rating'));
                                        @endphp

                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $averageRating)
                                                <i class="fa fa-star" style="color: #FFD700;"></i> <!-- نجم ممتلئ باللون الذهبي -->
                                            @else
                                                <i class="fa fa-star" style="color: #ccc;"></i> <!-- نجم فارغ باللون الرمادي -->
                                            @endif
                                        @endfor
                                    </div>

                                    <div class="product__price">${{ $product->price }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- Pagination -->
                    <div class="pagination__option text-center">
                        {{ $products->links('vendor.pagination.default') }}
                    </div>

                </div>
            </div>
        </div>

        <style>
            .btn-custom-filter {
    background-color: transparent;
    color: #CA1515; /* لون النص */
    border: 2px solid #CA1515; /* لون الإطار */
    font-size: 14px;
    padding: 5px 15px;
    border-radius: 0;
    font-weight: bold;
}

.btn-custom-filter:hover {
    background-color: #CA1515;
    color: #fff;
}
.sidebar__categories a {
    color: #000; /* اللون الأسود */
    font-weight: normal; /* يمكن تعديل السماكة */
    text-decoration: none; /* إزالة الخط السفلي */
}

.sidebar__categories a:hover {
    color: #8e0e0e; /* لون مختلف عند التمرير */
    text-decoration: underline;
}
.btn-filter {
    background-color: transparent;
    color: #CA1515; /* لون النص */
    border: 2px solid #CA1515; /* لون الإطار */
    font-size: 14px;
    padding: 5px 15px;
    border-radius: 0;
    font-weight: bold;جعل النص عريض */
}

.btn-filter:hover {
    background-color: #8e0e0e; /* عند التمرير يصبح لون الخلفية أحمر */
    color: #fff; /* لون النص يصبح أبيض */
}

        </style>
    </section>

    <!-- Shop Section End -->

    <!-- Instagram Begin -->
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
    <!-- Instagram End -->

    @endsection

