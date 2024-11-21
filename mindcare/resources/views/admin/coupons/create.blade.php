@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <h2 class="h3 mb-4">Create Coupon</h2>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Coupon Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>
        </div>
        <div class="mb-3">
            <label for="discount_percentage" class="form-label">Discount Percentage</label>
            <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage') }}" required min="1" max="100">
        </div>
        <div class="mb-3">
            <label for="valid_from" class="form-label">Valid From</label>
            <input type="date" class="form-control" id="valid_from" name="valid_from" value="{{ old('valid_from') }}" required>
        </div>
        <div class="mb-3">
            <label for="valid_until" class="form-label">Valid Until</label>
            <input type="date" class="form-control" id="valid_until" name="valid_until" value="{{ old('valid_until') }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Coupon</button>
    </form>
</div>

<!-- SweetAlert for errors -->
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Duplicate Coupon Code',
            text: '{{ $errors->first('code') }}',
        });
    </script>
@endif
@endsection
