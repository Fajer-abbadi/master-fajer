@extends('layout.admin_master')

@section('content')
    <h1>Edit Status</h1>

    <form action="{{ route('status.update', $status->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Status Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $status->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $status->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
@endsection
