@extends('layout.master');
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Section Begin -->
    <section class="contact spad" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <div class="container" style="max-width: 800px;">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact__content text-center">
                        <div class="contact__address mb-4">
                            <h5>Contact Info</h5>
                            <ul style="list-style: none; padding: 0;">
                                <li>
                                    <h6><i class="fa fa-map-marker"></i> Address</h6>
                                    <p>Al-Salt, Al-Shaheed Street, near Al-Hussein Governmental Hospital
                                    </p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-phone"></i> Phone</h6>
                                    <p>0798109947 | 0798888102</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Support</h6>
                                    <p>Support.Favittoria@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__form">
                            <h5>SEND MESSAGE</h5>
                            <form id="contact-form">
                                <input type="text" id="name" placeholder="Name" required style="width: 100%; margin-bottom: 10px;">
                                <input type="email" id="email" placeholder="Email" required style="width: 100%; margin-bottom: 10px;">
                                <textarea id="message" placeholder="Message" required style="width: 100%; margin-bottom: 10px;"></textarea>
                                <button type="submit" class="site-btn" style="width: 100%;">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault(); // منع إعادة تحميل الصفحة

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const website = document.getElementById('website').value;
            const message = document.getElementById('message').value;

            // تحقق من صحة البيانات
            if (name && email && message) {
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: 'Thank you for contacting us. We will get back to you soon.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // إعادة تعيين القيم في الفورم بعد إغلاق SweetAlert
                    document.getElementById('contact-form').reset();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields.',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>

<!-- Contact Section End -->

<!-- Instagram Begin -->
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpeg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpeg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/favittoria_23?igsh=MXY2Zms1ODk1dzFiOQ%3D%3D&utm_source=qr">@ Favittoria_shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Instagram End -->

@endsection
