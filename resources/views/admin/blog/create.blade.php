@extends('layout.admin_master')

@section('content')
<div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Add New Post</h1>

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label" style="font-weight: bold;">Title</label>
            <input type="text" class="form-control" id="title" name="title" required style="padding: 10px; border-radius: 5px; border: 1px solid #ddd; background-color: #f9f9ff;">
        </div>

        <!-- Content Field -->
        <div class="mb-3">
            <label for="content" class="form-label" style="font-weight: bold;">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required style="padding: 10px; border-radius: 5px; border: 1px solid #ddd; background-color: #f9f9ff;"></textarea>
        </div>

        <!-- Image Field -->
        <div class="mb-3">
            <label for="image" class="form-label" style="font-weight: bold;">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required style="padding: 8px; border-radius: 5px; background-color: #f9f9ff; border: 1px solid #ddd;">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn" style="background-color: #A688CA; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 14px; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">Create Post</button>
    </form>
</div>
@endsection
