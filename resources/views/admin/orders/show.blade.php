@extends('layout.admin_master')

@section('content')
    <div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Order Details</h1>

        <table style="width: 100%; border-collapse: collapse; background-color: #f5f5f9; border: 1px solid #ddd;">
            <tr style="background-color: #A688CA; color: #fff;">
                <th style="padding: 12px 15px; text-align: left; width: 30%;">Order ID:</th>
                <td style="padding: 12px 15px; color: #333;">{{ $order->id }}</td>
            </tr>
            <tr>
                <th style="padding: 12px 15px; text-align: left;">User Name:</th>
                <td style="padding: 12px 15px; color: #333;">{{ $order->user->name }}</td>
            </tr>
            <tr>
                <th style="padding: 12px 15px; text-align: left;">Total Amount:</th>
                <td style="padding: 12px 15px; color: #333;">${{ number_format($order->total_amount, 2) }}</td>
            </tr>
            <tr>
                <th style="padding: 12px 15px; text-align: left;">Status:</th>
                <td style="padding: 12px 15px; color: #333;">{{ $order->status }}</td>
            </tr>
            <tr>
                <th style="padding: 12px 15px; text-align: left;">Created At:</th>
                <td style="padding: 12px 15px; color: #333;">{{ $order->created_at }}</td>
            </tr>
        </table>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('orders.index') }}" class="btn" style="background-color: #A688CA; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                Back to Orders
            </a>
        </div>
    </div>
@endsection
