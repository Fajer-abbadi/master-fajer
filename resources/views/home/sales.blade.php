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
                <!-- Product Display Section -->
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/image-product/' . ($product->images->first() ? $product->images->first()->image_url : 'default.jpg')) }}">
                                    <div class="sale-badge">SALE</div> <!-- إضافة علامة السيل -->
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
                                    <div class="product__price">
                                        <span class="old-price">${{ $product->price }}</span>
                                        <span class="new-price">${{ $product->discount_price }}</span>
                                    </div>


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

        <!-- Custom Styles -->
        <style>
            /* تنسيق علامة السيل */
            .sale-badge {
                background-color: red;
                color: white;
                font-size: 14px;
                font-weight: bold;
                position: absolute;
                top: 10px;
                left: 10px;
                padding: 5px 10px;
                border-radius: 5px;
            }

            /* تنسيق الأسعار */
            .old-price {
    text-decoration: line-through !important; /* شطب السعر القديم */
    color: gray !important; /* لون السعر القديم */
    font-size: 14px !important;
}

.new-price {
    color: rgb(194, 20, 20) !important; /* لون السعر الجديد */
    font-weight: bold !important; /* جعل السعر الجديد بخط عريض */
    font-size: 16px !important;
    text-decoration: none !important; /* إزالة أي شطب على السعر الجديد */
}


            /* تنسيق للـ hover على المنتج */
            .product__item__pic {
                position: relative;
            }

            .product__item__pic:hover .sale-badge {
                background-color: rgb(118, 37, 37); /* لون مختلف عند الـ hover */
            }
        </style>
    </section>
    <!-- Shop Section End -->
@endsection
