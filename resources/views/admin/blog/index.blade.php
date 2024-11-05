@extends('layout.admin_master')

@section('content')
    <h1>Manage Blog Posts</h1>
    <a href="{{ route('blog.create') }}" class="btn btn-primary">Add New Post</a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td><img src="{{ asset('storage/posts/' . $post->image) }}" width="100" alt="Post Image">

                    </td>
                    <td>
                        <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('blog.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
