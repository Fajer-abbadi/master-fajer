@extends('layout.master');
@section('content')

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="single__item"
                        style="background-image: url('{{ asset('img/home1.jpg') }}'); background-size: cover; background-position: center; height: 600px;">
                        <div class="single__text text-center" style="padding-top: 400px; padding-bottom: 8px;">
                            <!-- إضافة صندوق بخلفية شفافة مع تأثير التمويه -->
                            <div
                                style="background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(5px); padding: 20px; border-radius: 10px; display: inline-block;">
                                <h1 style="color: #000;">WOMEN FASHION</h1>
                                <a style="color: #000;" href="#" class="btn btn-outline-light">Check Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <!-- عناوين الفلترة -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title" style="position: relative;">
                        <h4 style="font-size: 24px; font-weight: bold; margin-bottom: 10px; position: relative;">
                            New Products
                            <span style="content: ''; width: 50px; height: 2px; background-color: red; position: absolute; bottom: -5px; left: 0;"></span>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                        <!-- رابط لعرض جميع المنتجات -->
                        <li class="filter-category {{ request('category_id') == '' ? 'active' : '' }}" data-category="" style="list-style: none; font-size: 20px;">
                            <a href="javascript:void(0)" style="text-decoration: none; color: black; font-weight: 500; position: relative;">All</a>
                        </li>
                        <!-- الفئات المتاحة -->
                        @foreach ($categories as $category)
                            <li class="filter-category {{ request('category_id') == $category->id ? 'active' : '' }}" data-category="{{ $category->id }}" style="list-style: none; font-size: 15px;">
                                <a href="javascript:void(0)" style="text-decoration: none; color: black; font-weight: 500; position: relative;">{{ $category->name }}</a>
                                @if (request('category_id') == $category->id)
                                    <span style="content: ''; width: 100%; height: 2px; background-color: red; position: absolute; bottom: -5px; left: 0;"></span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- المنتجات -->
            <div class="row property__gallery" id="product-container">
                @foreach ($products as $product)
                @foreach ($product->images as $image)
                @endforeach
            @endforeach
            </div>
        </div>
    </section>


    <script>
   document.addEventListener('DOMContentLoaded', function() {
    // عند تحميل الصفحة، جلب جميع المنتجات
    fetch('/get-products', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // تحديد أن الطلب هو طلب AJAX
        }
    })
    .then(response => response.json())
    .then(data => {
        var productContainer = document.getElementById('product-container');
        productContainer.innerHTML = ''; // تفريغ المنتجات الحالية

        // إضافة المنتجات الجديدة
        data.products.forEach(function(product) {
            var imageUrl = product.images && product.images.length > 0
                ? '/storage/image-product/' + product.images[0]  // مسار الصورة من الستوريج
                : '/img/product/product-1.jpg';  // صورة افتراضية في حالة عدم وجود صور

            var productHTML = `
                <div class="col-lg-3 col-md-4 col-sm-6 mix ${product.category_name}">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" style="background-image: url('${imageUrl}');">
                            ${product.stock === 0 ? '<div class="label stockout">Out of stock</div>' : '<div class="label new">New</div>'}
                            <ul class="product__hover">
                                <li><a href="${imageUrl}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">${product.name}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="product__price">$${product.price}</div>
                        </div>
                    </div>
                </div>
            `;
            productContainer.insertAdjacentHTML('beforeend', productHTML); // إضافة المنتج إلى الـ container
        });
    });
});

document.querySelectorAll('.filter-category').forEach(function(element) {
    element.addEventListener('click', function() {
        var category_id = this.getAttribute('data-category');

        // إرسال طلب AJAX للحصول على المنتجات حسب الفئة
        fetch('/get-products?category_id=' + category_id, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest' // تحديد أن الطلب هو طلب AJAX
            }
        })
        .then(response => response.json())
        .then(data => {
            // تحديث المنتجات بناءً على البيانات المستلمة
            var productContainer = document.getElementById('product-container');
            productContainer.innerHTML = ''; // تفريغ المنتجات الحالية

            // إضافة المنتجات الجديدة
            data.products.forEach(function(product) {
                var imageUrl = product.images && product.images.length > 0
                    ? '/storage/image-product/' + product.images[0]  // مسار الصورة من الستوريج
                    : '/img/product/product-1.jpg';  // صورة افتراضية في حالة عدم وجود صور

                var productHTML = `
                    <div class="col-lg-3 col-md-4 col-sm-6 mix ${product.category_name}">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" style="background-image: url('${imageUrl}');">
                                ${product.stock === 0 ? '<div class="label stockout">Out of stock</div>' : '<div class="label new">New</div>'}
                                <ul class="product__hover">
                                    <li><a href="${imageUrl}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">${product.name}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="product__price">$${product.price}</div>
                            </div>
                        </div>
                    </div>
                `;
                productContainer.insertAdjacentHTML('beforeend', productHTML); // إضافة المنتج إلى الـ container
            });
        });
    });
});
    </script>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" style="background-color: #F4F4F4; padding: 5px 0;">
        <div class="container">
            <div class="row align-items-center">
                <!-- العمود الخاص بالصورة -->
                <div class="col-lg-6">
                    <div class="banner-image">
                        <img src="{{ asset('img/skintone.jpg') }}" alt="Skin Tone Banner" class="img-fluid">
                    </div>
                </div>

                <!-- العمود الخاص باختبار لون البشرة -->
                <div class="col-lg-6">
                    <div class="skin-tone-test-section">
                        <div class="section-header">
                            <h2 class="title">Discover Your Perfect Skin Tone Match</h2>
                            <p class="subtitle">Select your skin tone and find the perfect shade recommendations just for
                                you.</p>
                        </div>
                        <div class="skin-tone-test">
                            <form id="skinToneForm" method="POST" class="skin-tone-form">
                                @csrf
                                <label for="skin_tone" class="skin-tone-label">Select your Skin Tone:</label>
                                <select id="skin_tone" name="skin_tone" class="skin-tone-select">
                                    <option value="light">Light</option>
                                    <option value="medium">Medium</option>
                                    <option value="dark">Dark</option>
                                </select>
                                <button type="submit" class="btn-check">Check Your Shades</button>
                            </form>
                            <div id="result" class="shade-results"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('skinToneForm').addEventListener('submit', function(e) {
            e.preventDefault(); // منع إعادة التحميل

            const formData = new FormData(this);

            fetch('/check-skin-tone', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.shade_recommendations) {
                        const shades = JSON.parse(data.shade_recommendations);
                        document.getElementById('result').innerHTML = '<h3>Recommended shades:</h3>' + '<p>' +
                            shades.join(', ') + '</p>';
                    } else {
                        document.getElementById('result').innerHTML = '<p>No recommendations found.</p>';
                    }
                });
        });
    </script>

    <style>
       /* تعديل حجم الصورة لتقليل الارتفاع */
.banner-image img {
    width: 100%;
    max-height: 500px; /* تحديد الحد الأقصى للارتفاع */
    object-fit: cover;
    border-radius: 15px;
}

/* تعديل ارتفاع الفورم */
.skin-tone-test-section {
    background: #ffffff;
    padding: 40px 20px; /* تقليل الحشو الداخلي */
    border-radius: 20px;
    box-shadow: 0px 10px 40px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* تقليل المسافات بين العناصر */
.section-header .title {
    font-size: 28px; /* تصغير حجم العنوان */
    margin-bottom: 10px; /* تقليل المسافة تحت العنوان */
}

.section-header .subtitle {
    font-size: 16px;
    margin-bottom: 20px;
}

/* تعديل الفورم */
.skin-tone-select {
    padding: 8px; /* تقليل الحشو الداخلي */
    margin-bottom: 15px; /* تقليل المسافة بين الحقول */
}

.btn-check {
    background-color: #C40206;
    color: #fff;
    padding: 12px 30px; /* إعادة الحشو الداخلي الأكبر */
    border-radius: 30px; /* إعادة الحواف الدائرية */
    font-size: 18px; /* إعادة حجم النص */
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease; /* إضافة تأثير الانتقال */
}

.btn-check:hover {
    background-color: #A10205; /* تغيير لون الخلفية عند التمرير */
}


    </style>


    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    <!-- Banner Section End -->
<br><br><br>
    <!-- Trend Section Begin -->
    <section class="trend spad">

        <div class="slideshow-wrapper">
            <div class="slideshow-container">
                @foreach($hotProducts as $product)
                <div class="slide">
                    <img src="{{ asset('storage/image-product/' . $product->images->first()->image_url) }}" alt="{{ $product->name }}">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <div class="product__price">
                        @if($product->discount_price)
                            <span class="original-price">${{ $product->price }}</span> <!-- السعر قبل الخصم -->
                            ${{ $product->discount_price }} <!-- السعر بعد الخصم -->
                        @else
                            ${{ $product->price }} <!-- عرض السعر فقط إذا لم يكن هناك خصم -->
                        @endif
                    </div>

                </div>
                @endforeach

                @foreach($hotProducts as $product)
                <div class="slide">
                    <img src="{{ asset('storage/image-product/' . $product->images->first()->image_url) }}" alt="{{ $product->name }}">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <div class="product__price">
                        @if($product->discount_price)
                            <span class="original-price">${{ $product->price }}</span> <!-- السعر قبل الخصم -->
                            ${{ $product->discount_price }} <!-- السعر بعد الخصم -->
                        @else
                            ${{ $product->price }} <!-- عرض السعر فقط إذا لم يكن هناك خصم -->
                        @endif
                    </div>

                </div>
                @endforeach
            </div>
        </div>






<style>


  .trend {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #F4F4F4;
}


.slideshow-wrapper {
    overflow: hidden;
    width: 100%;
    display: flex;
    align-items: center;
    position: relative;
}

.slideshow-container {
    display: flex;
    animation: slide 20s linear infinite;
    width: calc(200%); /* عرض السلايدر ضعف العرض الأساسي */
}

@keyframes slide {
    0% {
        transform: translateX(0%);
    }
    100% {
        transform: translateX(-50%); /* نتحرك لنصف العرض */
    }
}

.slide {
    flex: 0 0 33.33%; /* ثلاث منتجات معاً */
    box-sizing: border-box;
    margin-right: 10px;
    text-align: center;
}

.slide img {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
}
.price {
    margin-top: 10px;
}

.old-price {
    text-decoration: line-through;
    color: #999;
    margin-right: 10px;
}

.new-price {
    color: #e74c3c; /* لون السعر المخفض */
    font-weight: bold;
}

.original-price {
    text-decoration: line-through; /* شطب السعر */
    color: red; /* لون مختلف */
}


</style>
<script>
    let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function showNextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    slides.forEach((slide, index) => {
        slide.style.transform = `translateX(-${currentIndex * 100}%)`;
    });
}

// تحريك السلايدر كل 3 ثوانٍ
setInterval(showNextSlide, 3000);

</script>
    </section>

    <!-- Trend Section End -->
<br><br><br>
    <!-- Discount Section Begin -->
    <section class="discount">
        <div class="container">
            <section class="discount">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 p-0">
                            <div class="discount__pic">
                                <img src="{{ asset('img/sale.jpeg') }}" alt="Sale Image">
                            </div>
                        </div>
                        <div class="col-lg-6 p-0">
                            <div class="discount__text">
                                <div class="discount__text__title">
                                    <span>Discount</span>
                                    <h2>Summer 2024</h2>
                                    <h5><span>Sale</span> 50%</h5>
                                </div>
                                <div class="discount__countdown" id="countdown-time">
                                    <div class="countdown__item">
                                        <span id="days">7</span>
                                        <p>Days</p>
                                    </div>
                                    <div class="countdown__item">
                                        <span id="hours">0</span>
                                        <p>Hours</p>
                                    </div>
                                    <div class="countdown__item">
                                        <span id="minutes">0</span>
                                        <p>Min</p>
                                    </div>
                                    <div class="countdown__item">
                                        <span id="seconds">0</span>
                                        <p>Sec</p>
                                    </div>
                                </div>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <script>
            // إعداد وقت النهاية ليكون بعد 7 أيام من الآن
            const countdownDate = new Date().getTime() + (7 * 24 * 60 * 60 * 1000); // 7 أيام من الآن

            // دالة العد التنازلي
            const countdownInterval = setInterval(function() {
                // الحصول على الوقت الحالي
                const now = new Date().getTime();
                // حساب الفرق بين الوقت الحالي ووقت النهاية
                const timeLeft = countdownDate - now;

                // حساب الأيام، الساعات، الدقائق، والثواني المتبقية
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                // عرض القيم في العناصر المحددة
                document.getElementById("days").innerHTML = days;
                document.getElementById("hours").innerHTML = hours;
                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                // إنهاء العد التنازلي إذا انتهى الوقت
                if (timeLeft < 0) {
                    clearInterval(countdownInterval);
                    document.getElementById("countdown-time").innerHTML = "EXPIRED";
                }
            }, 1000);
            </script>


    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-car"></i>
                        <h6>Free Shipping</h6>
                        <p>For all oder over $99</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-money"></i>
                        <h6>Money Back Guarantee</h6>
                        <p>If good have   </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-support"></i>
                        <h6>Online Support 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-headphones"></i>
                        <h6>Payment Secure</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

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
@stop
