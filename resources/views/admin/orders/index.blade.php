@extends('layout.admin_master')

@section('content')
    <div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Orders</h1>

        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width: 100%; border-collapse: collapse; background-color: #f5f5f9; border: 1px solid #ddd; margin-top: 10px;">
            <thead>
                <tr style="background-color: #A688CA; color: #333; text-align: left;">
                    <th style="padding: 12px 15px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 12px 15px; border: 1px solid #ddd;">User</th>
                    <th style="padding: 12px 15px; border: 1px solid #ddd;">Total Amount</th>
                    <th style="padding: 12px 15px; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 12px 15px; border: 1px solid #ddd; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr style="border-bottom: 1px solid #a977ae; transition: background-color 0.3s;">
                        <td style="padding: 10px 15px; color: #333; text-align: center;">{{ $order->id }}</td>
                        <td style="padding: 10px 15px; color: #333;">{{ $order->user->name }}</td>
                        <td style="padding: 10px 15px; color: #333;">${{ number_format($order->total_amount, 2) }}</td>
                        <td style="padding: 10px 15px; color: #333;">{{ $order->status }}</td>
                        <td style="padding: 10px 15px; text-align: center;">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn" style="background-color: #A688CA; color: #fff; padding: 6px 12px; border-radius: 5px; font-size: 13px; margin-right: 5px; text-decoration: none; transition: 0.3s;">View</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn" style="background-color: #6B429C; color: #fff; padding: 6px 12px; border-radius: 5px; font-size: 13px; margin-right: 5px; text-decoration: none; transition: 0.3s;">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background-color: #8441d5; color: #fff; padding: 6px 12px; border-radius: 5px; font-size: 13px; border: none; cursor: pointer; transition: 0.3s;" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
