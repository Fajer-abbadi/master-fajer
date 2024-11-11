@extends('layout.admin_master')

@section('content')
<div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Manage Blog Posts</h1>

    <!-- زر الإضافة -->
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('blog.create') }}" class="btn" style="background-color: #A688CA; color: #fff; padding: 8px 16px; border-radius: 5px; font-size: 14px; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            + Add New Post
        </a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background-color: #f5f5f9; border: 1px solid #ddd; margin-top: 10px;">
        <thead>
            <tr style="background-color: #A688CA; color: #333; text-align: left;">
                <th style="padding: 12px 15px; border: 1px solid #ddd;">Title</th>
                <th style="padding: 12px 15px; border: 1px solid #ddd;">Content</th>
                <th style="padding: 12px 15px; border: 1px solid #ddd;">Image</th>
                <th style="padding: 12px 15px; border: 1px solid #ddd; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr style="border-bottom: 1px solid #a977ae; transition: background-color 0.3s;">
                    <td style="padding: 10px 15px; color: #333;">{{ $post->title }}</td>
                    <td style="padding: 10px 15px; color: #333; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $post->content }}</td>
                    <td style="padding: 10px 15px;">
                        <img src="{{ asset('storage/posts/' . $post->image) }}" width="100" alt="Post Image" style="border-radius: 8px;">
                    </td>
                    <td style="padding: 10px 15px; text-align: center;">
                        <a href="{{ route('blog.edit', $post->id) }}" class="btn" style="background-color: #A688CA; color: #fff; padding: 6px 12px; border-radius: 5px; font-size: 13px; margin-right: 5px; text-decoration: none; transition: 0.3s;">Edit</a>
                        <form action="{{ route('blog.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: #6B429C; color: #fff; padding: 6px 12px; border-radius: 5px; font-size: 13px; border: none; cursor: pointer; transition: 0.3s;" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
