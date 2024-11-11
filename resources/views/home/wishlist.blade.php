@extends('layout.master')

@section('content')
<div class="container" style="margin-top: 50px;">
    <table class="table" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 15px; text-align: center;">Product</th>
                <th style="padding: 15px; text-align: center;">Price</th>
                <th style="padding: 15px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wishlistItems as $item)
                <tr>
                    <td style="padding: 15px; text-align: center;">
                        <div class="wishlist-product" style="display: flex; align-items: center;">
                            <img src="{{ asset('storage/image-product/' . $item->product->images->first()->image_url) }}" alt="Product Image" class="img-thumbnail" style="width: 100px; height: 100px;">
                            <div class="wishlist-details" style="margin-left: 15px;">
                                <h4 style="margin: 0; font-size: 18px;">{{ $item->product->name }}</h4>
                                {{-- <p style="margin: 5px 0; color: #f39c12;">⭐⭐⭐⭐⭐</p> --}}
                            </div>
                        </div>
                    </td>
                    <td style="padding: 15px; text-align: center;">${{ $item->product->price }}</td>
                    <td style="padding: 15px; text-align: center;">
                       <!-- زر إضافة للسلة -->
                       <form id="addToCartForm-{{ $item->product->id }}" data-product-id="{{ $item->product->id }}" style="display: inline;">
                        @csrf
                        <button type="button" class="btn btn-primary add-to-cart-btn" style="background-color: #221e1e; border-color: #231e1f; padding: 10px 20px; display: inline-flex; align-items: center;">
                            <i class="fa fa-shopping-cart" style="margin-right: 5px;"></i>
                        </button>
                    </form>

                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                            button.addEventListener('click', function(e) {
                                e.preventDefault();

                                // الحصول على معرف المنتج من زر "Add to Cart" المحدد فقط
                                const productId = this.closest('form').getAttribute('data-product-id');

                                // تعطيل الزر مؤقتًا لمنع النقر المتكرر
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
                                        // تحديث العدد في أيقونة السلة
                                        let cartCount = document.querySelector('.cart-count');
                                        cartCount.textContent = parseInt(cartCount.textContent) + 1;

                                        // عرض تنبيه "تمت الإضافة" باستخدام SweetAlert
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
                                            text: data.message || 'An error occurred while adding to cart.',
                                        });
                                    }
                                    // إعادة تفعيل الزر بعد اكتمال العملية
                                    this.disabled = false;
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while adding to cart.',
                                    });
                                    // إعادة تفعيل الزر إذا حدث خطأ
                                    this.disabled = false;
                                });
                            });
                        });
                    });
                    </script>



<!-- زر إزالة من المفضلة -->
<form action="{{ route('wishlist.remove', $item->id) }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-danger" style="background-color: #c40206; border-color: #c40206; padding: 10px 20px; display: inline-flex; align-items: center;">
        <i class="fa fa-times" style="margin-right: 5px;"></i>
    </button>
</form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br><br><br><br><br>
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
@endsection
