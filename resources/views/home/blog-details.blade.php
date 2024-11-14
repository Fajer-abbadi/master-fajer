@extends('layout.master')

@section('content')
    <style>
        .blog__details__pic img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .blog__details__content {
            padding: 20px;
        }

        .blog__details__comment h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .comment-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #C40206;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            margin-right: 10px;
            text-transform: uppercase;
        }

        .comment-content {
            width: 100%;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .comment-actions {
            display: flex;
            gap: 10px;
        }

        .comment-actions a, .comment-actions form button {
            color: #007bff;
            cursor: pointer;
            text-decoration: none;
            background: none;
            border: none;
            padding: 0;
            font-size: 14px;
        }

        .comment-actions a:hover, .comment-actions form button:hover {
            text-decoration: underline;
        }

        .reaction {
            cursor: pointer;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .reaction.heart {
            color: #ccc;
        }

        .reaction.heart.active {
            color: red;
        }

        .edit-form {
            display: none;
        }

        .blog__details__comment form textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .blog__details__comment form button {
            background-color: #C40206;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .blog__details__comment form button:hover {
            background-color: #555;
        }
    </style>

    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="blog__details__pic">
                        <img src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ $post->title }}">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="blog__details__content">
                        <div class="blog__details__text">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ $post->content }}</p>
                        </div>

                        <!-- Comments Section -->
                        <div class="blog__details__comment">
                            <h3>Comments ({{ $post->comments->count() }})</h3>
                            <ul style="padding: 0; list-style: none;">
                                @foreach($post->comments as $comment)
                                    <li class="comment-item" id="comment-{{ $comment->id }}">
                                        <div class="comment-avatar">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <strong>{{ $comment->user->name }}</strong>
                                                <div class="comment-actions">
                                                    @if($comment->user_id === auth()->id())
                                                        <button type="button" onclick="enableEdit({{ $comment->id }})">Edit</button>
                                                        <form action="{{ route('comments.delete', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit">Delete</button>
                                                        </form>
                                                    @endif
                                                    {{-- <span class="reaction heart" onclick="toggleHeart(this)">&#10084;</span> --}}
                                                </div>
                                            </div>
                                            <!-- Displayed Comment Text -->
                                            <p class="comment-text" id="comment-text-{{ $comment->id }}">{{ $comment->comment }}</p>

                                            <!-- Edit Form, initially hidden -->
                                            <form action="{{ route('comments.update', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST" style="display: none;" id="edit-form-{{ $comment->id }}">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="comment" required>{{ $comment->comment }}</textarea>
                                                <button type="submit">Save</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            @auth
                            <form action="{{ route('posts.addComment', $post->id) }}" method="POST">
                                @csrf
                                <textarea name="comment" placeholder="Add a comment" required></textarea>
                                <button type="submit">Submit</button>
                            </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function enableEdit(commentId) {
            document.getElementById(`comment-text-${commentId}`).style.display = 'none';
            document.getElementById(`edit-form-${commentId}`).style.display = 'block';
        }

        function toggleHeart(element) {
            element.classList.toggle('active');
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
