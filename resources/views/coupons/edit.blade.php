@extends('layout.admin_master')

@section('content')
    <h1>Edit Coupon</h1>
    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Coupon Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}" required>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount (%)</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ $coupon->discount }}" required>
        </div>
        <div class="mb-3">
            <label for="max_discount_amount" class="form-label">Max Discount Amount ($)</label>
            <input type="number" class="form-control" id="max_discount_amount" name="max_discount_amount" value="{{ $coupon->max_discount_amount }}">
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Is Active</label>
            <select class="form-control" id="is_active" name="is_active" required>
                <option value="1" {{ $coupon->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$coupon->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ $coupon->expiry_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Coupon</button>
    </form>
@endsection
