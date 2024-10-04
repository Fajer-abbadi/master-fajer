@extends('layout.admin_master')

@section('content')
    <h1>Order Details</h1>

    <table class="table">
        <tr>
            <th>Order ID:</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>User Name:</th>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <th>Total Amount:</th>
            <td>${{ $order->total_amount }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ $order->status }}</td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td>{{ $order->created_at }}</td>
        </tr>
    </table>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
@endsection
