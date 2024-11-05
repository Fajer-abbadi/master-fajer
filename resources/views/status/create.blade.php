@extends('layout.admin_master')

@section('content')
    <h1>Add New Status</h1>

    <form action="{{ route('status.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Status Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Status</button>
    </form>
@endsection
