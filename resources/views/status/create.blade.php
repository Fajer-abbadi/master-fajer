@extends('layout.admin_master')

@section('content')
    <div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Add New Status</h1>

        <form action="{{ route('status.store') }}" method="POST" style="max-width: 600px; margin: 0 auto;">
            @csrf

            <div class="mb-4">
                <label for="name" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Status Name</label>
                <input type="text" name="name" class="form-control" id="name" required style="border-color: #A688CA;">
            </div>

            <div class="mb-4">
                <label for="description" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Description</label>
                <textarea name="description" class="form-control" id="description" style="border-color: #A688CA;"></textarea>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn" style="background-color: #A688CA; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    Add Status
                </button>
            </div>
        </form>
    </div>
@endsection
