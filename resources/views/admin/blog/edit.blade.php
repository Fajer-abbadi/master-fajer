@extends('layout.admin_master')

@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if($post->image)
                <img src="{{ asset('storage/posts/' . $post->image) }}" width="150" alt="Current Image">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
@endsection
