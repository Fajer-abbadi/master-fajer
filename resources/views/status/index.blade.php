@extends('layout.admin_master')

@section('content')
    <h1>Manage Statuses</h1>
    <a href="{{ route('status.create') }}" class="btn btn-primary mb-3">Add New Status</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->name }}</td>
                    <td>{{ $status->description }}</td>
                    <td>
                        <a href="{{ route('status.edit', $status->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('status.destroy', $status->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
