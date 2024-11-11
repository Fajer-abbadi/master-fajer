@extends('layout.master')

@section('content')
    <style>
        .blog__item {
            padding: 20px;
            position: relative;
        }

        .blog__item__text {
            position: relative;
        }

        /* تنسيق القلب */
        .like-heart {
            position: absolute;
            bottom: 10px; /* لضبط الأيقونة في الأسفل */
            right: 10px; /* لضبط الأيقونة في الجانب الأيمن */
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .like-heart.active {
            color: red;
        }
    </style>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic large__item set-bg" data-setbg="{{ asset('storage/posts/' . $post->image) }}"></div>
                        <div class="blog__item__text">
                            <h6><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h6>
                            <ul>
                                <li>by <span>{{ $post->user->name }}</span></li>
                                <li>{{ $post->created_at->format('M d, Y') }}</li>
                            </ul>
                            <!-- أيقونة القلب في المساحة البيضاء -->
                            <span
                                class="like-heart {{ in_array($post->id, session('liked_posts', [])) ? 'active' : '' }}"
                                onclick="toggleHeart({{ $post->id }}, this)">
                                &#10084;
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <script>
        function toggleHeart(postId, element) {
            fetch(`/posts/${postId}/toggle-like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    element.classList.add('active');
                } else {
                    element.classList.remove('active');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
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
