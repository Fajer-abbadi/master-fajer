@extends('layout.admin_master')

@section('content')
    <div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Create New Category</h1>

        <form action="{{ route('categories.store') }}" method="POST" style="max-width: 600px; margin: 0 auto;">
            @csrf
            <div class="mb-4">
                <label for="name" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Category Name</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text" style="background-color: #A688CA; color: #fff;"><i class="bx bx-tag"></i></span>
                    <input type="text" name="name" class="form-control" required style="border-color: #A688CA;">
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn" style="background-color: #A688CA; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    Create Category
                </button>
            </div>
        </form>
    </div>
@endsection
