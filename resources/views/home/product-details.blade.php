
@extends('layout.master');
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Women’s</a>
                        <span>Essential structured blazer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @foreach($product->images as $key => $image)
                            <a class="pt @if($key === 0) active @endif" href="#product-{{ $key + 1 }}">
                                <img src="{{ asset('storage/image-product/' . $image->image_url) }}" alt="{{ $product->name }}">
                            </a>
                            @endforeach
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach($product->images as $key => $image)
                                <img data-hash="product-{{ $key + 1 }}" class="product__big__img" src="{{ asset('storage/image-product/' . $image->image_url) }}" alt="{{ $product->name }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}<span>Brand: {{ $product->brand }}</span></h3>
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star" style="color: {{ $i <= $averageRating ? '#FFD700' : '#dcdcdc' }};"></i>
                            @endfor
                            <span>({{ $product->reviews_count }} reviews)</span>
                        </div>


                        <div class="product__price">
                            @if($product->is_hot == 1 && $product->discount_price > 0)
                                <span class="new-price">${{ $product->discount_price }}</span>
                            @else
                                <span class="price">${{ $product->price }}</span>
                            @endif
                        </div>

                        <p>{{ $product->description }}</p>
                        <div class="product__details__button">
                          <!-- زر السلة مع معرف المنتج -->
                       <!-- زر السلة مع معرف المنتج -->
<a href="#" class="cart-btn" data-product-id="{{ $product->id }}" style="display: inline-flex; align-items: center; background-color: #CA1515; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
    <span class="icon_bag_alt" style="margin-right: 8px;"></span> Add to Cart
</a>

<!-- جافا سكريبت لإضافة المنتج للسلة باستخدام AJAX -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.cart-btn').addEventListener('click', function(e) {
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
                    // تحديث عدد المنتجات في السلة
                    let cartCount = document.querySelector('.cart-count');
                    cartCount.textContent = parseInt(cartCount.textContent) + 1;

                    // عرض تنبيه نجاح
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart',
                        text: 'The product has been added to your cart!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an issue adding the product to your cart.',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while adding to cart.',
                });
            });
        });
    });

</script>


                            <ul>
                                <li>
                                    <a href="#" class="add-to-wishlist" data-product-id="{{ $product->id }}" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 1px solid #ddd; border-radius: 50%; background-color: #fff; color: #e74c3c; font-size: 18px;">
                                        <span class="icon_heart_alt"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        <label>
                                            <input type="radio">
                                            {{ $product->color }}
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                         <label class="active">
                                            <input type="radio">
                                            {{ $product->size }}
                                         </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( {{ $product->reviews->count() }} )</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                <p>{{ $product->long_description }}</p>
                            </div>

                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Specification</h6>
                                <p>{{ $product->specifications }}</p>
                            </div>

                            <div class="tab-pane" id="tabs-3" role="tabpanel" style="padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
                                <h6 style="font-family: Arial, sans-serif; font-size: 22px; font-weight: bold; color: #2c3e50; margin-bottom: 16px;">
                                    Reviews ( {{ $product->reviews->count() }} )
                                </h6>

                                <!-- Review Form for Logged-in Users -->
                                @auth
                                <form id="reviewForm" style="margin-bottom: 20px;">
                                    @csrf
                                    <textarea name="comment" placeholder="Write your review..." required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ddd; margin-bottom: 10px; font-family: Arial, sans-serif; font-size: 14px;"></textarea>
                                    <input type="number" name="rating" min="1" max="5" placeholder="Rating (1-5)" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ddd; margin-bottom: 10px; font-family: Arial, sans-serif; font-size: 14px;">
                                    <button type="submit" style="background-color: #CA1515; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-family: Arial, sans-serif; font-size: 14px; font-weight: bold;">
                                        Submit
                                    </button>
                                </form>
                                @endauth

                                <!-- Reviews List with Scroll -->
                                <ul id="reviewList" style="max-height: 300px; overflow-y: auto; list-style-type: none; padding: 0;">
                                    @foreach ($allreviews as $review)
                                    <li class="review th-comment-item" style="margin-bottom: 20px; padding: 15px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        <div class="th-post-comment">
                                            <div class="comment-content">
                                                <h4 class="name" style="font-family: Arial, sans-serif; color: #2c3e50; font-weight: bold; font-size: 16px; margin-bottom: 4px;">
                                                    {{ optional($review->user)->name ?? 'Unknown User' }}
                                                </h4>
                                                <span class="commented-on" style="font-family: Arial, sans-serif; color: #7f8c8d; font-size: 12px;">
                                                    <i class="fa fa-clock"></i> {{ $review->created_at }}
                                                </span>
                                                <br>
                                                <span class="list-rating" style="color: #E2B93B; margin-top: 4px; display: inline-block;">
                                                    @for ($i = 0; $i < $review->rating; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </span>
                                                <p class="text" style="font-family: Arial, sans-serif; color: #34495e; font-size: 14px; line-height: 1.5; margin-top: 10px;">
                                                    {{ $review->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related products section -->
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/image-product/' . $relatedProduct->images->first()->image_url) }}">
                            <ul class="product__hover">
                                <!-- زر التفاصيل -->
                                <li><a href="{{ route('product.details', $relatedProduct->id) }}" style="background-color: #fff; color: #333; padding: 10px; border-radius: 50%;"><i class="fa fa-expand"></i></a></li>

                                <!-- زر المفضلة -->
                                <li>
                                    <a href="#" class="add-to-wishlist" data-product-id="{{ $relatedProduct->id }}" style="background-color: #fff; color: #e74c3c; padding: 10px; border-radius: 50%;">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </li>

                                <!-- زر السلة -->
                                <li>
                                    <a href="#" class="add-to-cart" data-product-id="{{ $relatedProduct->id }}" style="background-color: #fff; color: #2ecc71; padding: 10px; border-radius: 50%;">
                                        <i class="fa fa-shopping-bag"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('product.details', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a></h6>
                            <div class="rating">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <div class="product__price">${{ $relatedProduct->price }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- JavaScript -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // إضافة المنتج للمفضلة مرة واحدة فقط
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
                                    // تحديث العداد الخاص بالمفضلة
                                    let wishlistCount = document.querySelector('.wishlist-count');
                                    wishlistCount.textContent = parseInt(wishlistCount.textContent) + 1;

                                    // عرض تنبيه SweetAlert
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Added to Wishlist',
                                        text: 'The product has been added to your wishlist!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else if (data.message === 'already_exists') {
                                    // إذا كانت القطعة مضافة مسبقاً
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Already Added',
                                        text: 'This product is already in your wishlist.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'There was an issue adding the product to your wishlist.',
                                    });
                                }
                            });
                        }, { once: true }); // إضافة المستمع مرة واحدة فقط للمفضلة
                    });

                    // إضافة المنتج للسلة عدة مرات
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
                                    // تحديث العداد الخاص بالسلة
                                    let cartCount = document.querySelector('.cart-count');
                                    cartCount.textContent = parseInt(cartCount.textContent) + 1;

                                    // عرض تنبيه SweetAlert
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Added to Cart',
                                        text: 'The product has been added to your cart!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else if (data.message === 'already_exists') {
                                    // إذا كانت القطعة مضافة مسبقاً إلى السلة
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Already in Cart',
                                        text: 'This product is already in your cart.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'There was an issue adding the product to your cart.',
                                    });
                                }
                            });
                        });
                    });
                });
            </script>

        </div>
    </section>
    <!-- Product Details Section End -->

                                <!-- JavaScript to Handle AJAX Review Submission -->
                                <script>
                                    document.getElementById('reviewForm').addEventListener('submit', function(e) {
                                        e.preventDefault();

                                        let formData = new FormData(this);

                                        fetch(`{{ route('product.addReview', $product->id) }}`, {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json',
                                            },
                                            body: formData
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                // Append the new review at the top of the list
                                                let reviewList = document.getElementById('reviewList');
                                                let newReview = document.createElement('li');
                                                newReview.classList.add('review', 'th-comment-item');
                                                newReview.innerHTML = `
                                                    <div class="th-post-comment">
                                                        <div class="comment-content">
                                                            <h4 class="name">{{ Auth::user()->name }}</h4>
                                                            <span class="commented-on"><i class="fa fa-clock"></i> ${new Date().toLocaleString()}</span>
                                                            <br>
                                                            <span class="list-rating" style="color : #E2B93B;">
                                                                ${'⭐'.repeat(data.review.rating)}
                                                            </span>
                                                            <p class="text">${data.review.comment}</p>
                                                        </div>
                                                    </div>
                                                `;
                                                reviewList.prepend(newReview);

                                                // Clear the form
                                                document.getElementById('reviewForm').reset();
                                            } else {
                                                alert(data.message);
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                    });
                                </script>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Related products section -->
            {{-- <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/image-product/' . $relatedProduct->images->first()->image_url) }}">
                            <ul class="product__hover">
                                <li><a href="{{ route('product.details', $relatedProduct->id) }}"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('product.details', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a></h6>
                            <div class="rating">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <div class="product__price">${{ $relatedProduct->price }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> --}}
        </div>
    </section>

    <!-- Product Details Section End -->

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
