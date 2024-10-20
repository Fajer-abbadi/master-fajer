@extends('layout.admin_master')

@section('content')
    <h1>Edit Order</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status_id">Status</label>
            <select class="form-control" name="status_id" required>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>

@endsection
