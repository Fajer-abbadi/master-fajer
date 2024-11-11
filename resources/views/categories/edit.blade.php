@extends('layout.admin_master')

@section('content')
    <div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Edit Category</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mb-6" style="border: 1px solid #A688CA; border-radius: 8px;">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #A688CA; color: #fff;">
                </div>
                <div class="card-body">

                    <!-- Category Name with Icon -->
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-name" style="color: #333;">Category Name</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" style="background-color: #A688CA; color: #fff;"><i class="bx bx-tag"></i></span>
                            <input type="text" name="name" class="form-control" id="basic-icon-default-name" value="{{ $category->name }}" required style="border-color: #A688CA;">
                        </div>
                    </div>

                    <!-- Description with Icon -->
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-description" style="color: #333;">Description</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" style="background-color: #A688CA; color: #fff;"><i class="bx bx-align-left"></i></span>
                            <textarea name="description" class="form-control" id="basic-icon-default-description" placeholder="Category description..." style="border-color: #A688CA;">{{ $category->description ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- Status with Icon -->
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-status" style="color: #333;">Status</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" style="background-color: #A688CA; color: #fff;"><i class="bx bx-check-shield"></i></span>
                            <select name="status" class="form-control" id="basic-icon-default-status" style="border-color: #A688CA;">
                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div style="text-align: center;">
                        <button type="submit" class="btn" style="background-color: #A688CA; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            Update Category
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
