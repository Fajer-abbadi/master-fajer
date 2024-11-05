
@extends('layout.master');
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Women’s </a>
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
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>( {{ $product->reviews_count }} reviews )</span>
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
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                            <a href="" class="cart-btn" data-product-id="{{ $product->id }}">
                                <span class="icon_bag_alt"></span> Add to cart
                            </a>

                            <ul>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            </ul>
                        </div>


{{-- <script>
    // التعامل مع زر Wishlist
document.querySelector('.icon_heart_alt').addEventListener('click', function(e) {
    e.preventDefault();

    let productId = '{{ $product->id }}';  // product_id الخاص بالمنتج

    // إرسال البيانات إلى القائمة المفضلة باستخدام Fetch API
    fetch('/wishlist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'  // لتجنب مشاكل CSRF
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product added to wishlist successfully!');
        } else {
            alert('Error adding product to wishlist');
        }
    })
    .catch(error => console.error('Error:', error));
});
</script> --}}



                        <div class="product__details__widget">
                            <ul>
                                {{-- <li>
                                    <span>Availability:</span>
                                    <div class="stock__checkbox">
                                        <label for="stockin">
                                            In Stock
                                            <input type="checkbox" id="stockin" {{ $product->in_stock ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li> --}}
                                <li>
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        <label >
                                            <input type="radio">
                                            {{ $product->color }}                                        </label>

                                        </label>
                                        {{-- @endforeach --}}
                                    </div>
                                </li>
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                         <label   class="  active ">
                                            <input type="radio"  >
                                            {{ $product->size }}                                        </label>
                                         {{-- @foreach(['xs', 's', 'm', 'l'] as $size)
                                        <label for="{{ $size }}-btn" class="@if($loop->first) active @endif">
                                            <input type="radio" id="{{ $size }}-btn">
                                            {{ $size }}
                                        </label>
                                        @endforeach --}}
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
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6>Reviews ( {{ $product->reviews->count() }} )</h6>
                                @foreach ($allreviews as $review)
    <li class="review th-comment-item">
        <div class="th-post-comment">
            <div class="comment-content">
                <h4 class="name">{{ $review->user->name }}</h4>
                <span class="commented-on">
                    <i class="fa fa-clock"></i>{{ $review->created_at }}
                </span>
                <br>
                <span class="list-rating" style="color : #E2B93B;">
                    @php
                        $wholeStars = floor($review->rating);
                        $fraction = $review->rating - $wholeStars;
                        $halfStar = $fraction >= 0.5;
                        $emptyStars = 5 - $wholeStars - ($halfStar ? 1 : 0);
                    @endphp

                    @for ($i = 0; $i < $wholeStars; $i++)
                        <i class="fa fa-star"></i>
                    @endfor

                    @if ($halfStar)
                        <i class="fa fa-star-half-alt"></i>
                    @endif

                    @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="fa fa-star"></i>
                    @endfor

                    <span>({{ number_format($review->rating, 1) }})</span>
                </span>

                <p class="text">{{ $review->comment }}</p>
            </div>
        </div>
    </li>
@endforeach


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
            </div>
        </div>
    </section>

    <!-- Product Details Section End -->

    <!-- Instagram Begin -->
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
    <!-- Instagram End -->

    @endsection
