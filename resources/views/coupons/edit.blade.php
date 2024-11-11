@extends('layout.admin_master')

@section('content')
    <div style="width: 90%; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Edit Coupon</h1>

        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST" style="max-width: 600px; margin: 0 auto;">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="code" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Coupon Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}" required style="border-color: #A688CA;">
            </div>

            <div class="mb-4">
                <label for="discount" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" value="{{ $coupon->discount }}" required style="border-color: #A688CA;">
            </div>

            <div class="mb-4">
                <label for="max_discount_amount" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Max Discount Amount ($)</label>
                <input type="number" class="form-control" id="max_discount_amount" name="max_discount_amount" value="{{ $coupon->max_discount_amount }}" style="border-color: #A688CA;">
            </div>

            <div class="mb-4">
                <label for="is_active" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Is Active</label>
                <select class="form-control" id="is_active" name="is_active" required style="border-color: #A688CA;">
                    <option value="1" {{ $coupon->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$coupon->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="expiry_date" style="color: #333; font-size: 16px; margin-bottom: 8px; display: block;">Expiry Date</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ $coupon->expiry_date }}" required style="border-color: #A688CA;">
            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn" style="background-color: #A688CA; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    Update Coupon
                </button>
            </div>
        </form>
    </div>
@endsection
