@extends('layout.admin_master')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-6">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Category Form</h5>
            <small class="text-body float-end">Category update</small>
          </div>
          <div class="card-body">

            <!-- Category Name with Icon -->
            <div class="mb-6">
              <label class="form-label" for="basic-icon-default-name">Category Name</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-tag"></i></span>
                <input type="text" name="name" class="form-control" id="basic-icon-default-name" value="{{ $category->name }}" required>
              </div>
            </div>

            <!-- Description with Icon -->
            <div class="mb-6">
              <label class="form-label" for="basic-icon-default-description">Description</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-align-left"></i></span>
                <textarea name="description" class="form-control" id="basic-icon-default-description" placeholder="Category description...">{{ $category->description ?? '' }}</textarea>
              </div>
            </div>

            <!-- Status with Icon -->
            <div class="mb-6">
              <label class="form-label" for="basic-icon-default-status">Status</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-check-shield"></i></span>
                <select name="status" class="form-control" id="basic-icon-default-status">
                  <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                  <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Category</button>

          </div>
        </div>
    </form>
@endsection
