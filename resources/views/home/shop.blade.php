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
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="1" data-max="100"></div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <p>Price:</p>
                                            <input type="text" name="min_price" id="minamount" value="{{ request('min_price', 1) }}">
                                            <input type="text" name="max_price" id="maxamount" value="{{ request('max_price', 100) }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-custom-filter">Filter</button>
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
                                        <li><a href="#"><span class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('product.details', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                                    <div class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa fa-star"></i>
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

