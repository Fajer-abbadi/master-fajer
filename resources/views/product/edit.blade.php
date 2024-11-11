@extends('layout.admin_master')

@section('content')
    <div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Edit Product</h1>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="margin: 0; padding: 0; list-style-type: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" style="max-width: 600px; margin: 0 auto;">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required style="border-color: #A688CA;">
            </div>

            <div class="mb-4">
                <label for="description" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Description</label>
                <textarea class="form-control" id="description" name="description" required style="border-color: #A688CA;">{{ $product->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required style="border-color: #A688CA;">
            </div>

            <div class="mb-4">
                <label for="stock" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required style="border-color: #A688CA;">
            </div>

            <div class="mb-4">
                <label for="category_id" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Category</label>
                <select class="form-control" id="category_id" name="category_id" required style="border-color: #A688CA;">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($product) && $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn" style="background-color: #A688CA; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection
