@extends('layout.master')

@section('content')
<div class="container" style="margin-top: 50px;">
    <h1 class="my-5" style="font-size: 36px; font-weight: bold;">My Wishlist</h1>
    <table class="table" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 15px; text-align: center;">Product</th>
                <th style="padding: 15px; text-align: center;">Price</th>
                <th style="padding: 15px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 15px; text-align: center;">
                    <div class="wishlist-product" style="display: flex; align-items: center;">
                        <img src="img/product1.jpg" alt="Product Image" class="img-thumbnail" style="width: 100px; height: 100px;">
                        <div class="wishlist-details" style="margin-left: 15px;">
                            <h4 style="margin: 0; font-size: 18px;">Chain bucket bag</h4>
                            <p style="margin: 5px 0; color: #f39c12;">⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </td>
                <td style="padding: 15px; text-align: center;">$150.00</td>
                <td style="padding: 15px; text-align: center;">
                    <button class="btn btn-primary" style="background-color: #221e1e; border-color: #231e1f; padding: 10px 20px;">Add to Cart</button>
                    <button class="btn btn-danger" style="background-color: #c40206; border-color: #c40206; padding: 10px 20px;">Remove</button>
                </td>
            </tr>

            <tr>
                <td style="padding: 15px; text-align: center;">
                    <div class="wishlist-product" style="display: flex; align-items: center;">
                        <img src="img/product2.jpg" alt="Product Image" class="img-thumbnail" style="width: 100px; height: 100px;">
                        <div class="wishlist-details" style="margin-left: 15px;">
                            <h4 style="margin: 0; font-size: 18px;">Zip-pockets pebbled tote briefcase</h4>
                            <p style="margin: 5px 0; color: #f39c12;">⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </td>
                <td style="padding: 15px; text-align: center;">$170.00</td>
                <td style="padding: 15px; text-align: center;">
                    <button class="btn btn-primary" style="background-color: #433a3b; border-color: #322d2d; padding: 10px 20px;">Add to Cart</button>
                    <button class="btn btn-danger" style="background-color: #c40206; border-color: #c40206; padding: 10px 20px;">Remove</button>
                </td>
            </tr>

        </tbody>
    </table>

</div>
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
@endsection
