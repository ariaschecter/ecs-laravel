@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('payment/add') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="example-select" class="form-label">Select User</label>
                <select class="form-select" id="id" name="id">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <label for="payment_price" class="form-label">Price</label>
                <input type="number" id="payment_price" name="payment_price"
                    class="form-control @error('payment_price') is-invalid @enderror" value="{{ old('payment_price') }}"
                    placeholder="Full Name">
            </div>
            @error('payment_price') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="example-select" class="form-label">Select Payment Method</label>
                <select class="form-select" id="payment_method_id" name="payment_method_id">
                    @foreach ($payment_methods as $payment_method)
                    <option value="{{ $payment_method->payment_method_id }}">{{ $payment_method->payment_method_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <label for="payment_picture" class="form-label">Payment Picture</label>
                <input type="file" id="payment_picture" name="payment_picture"
                    class="form-control @error('payment_picture') is-invalid @enderror">
            </div>
            @error('payment_picture') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="example-select" class="form-label">Payment Status</label>
                <select class="form-select" id="payment_status" name="payment_status">
                    <option value="PENDING">PENDING</option>
                    <option value="DECLINE">DECLINE</option>
                    <option value="SUCCESS">SUCCESS</option>
                </select>
            </div>

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection