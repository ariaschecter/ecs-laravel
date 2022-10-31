@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('payment/edit/' . $payment->payment_id) }}">
            @csrf
            <div>
                <label for="payment_ref" class="form-label">Payment Reff</label>
                <input type="text" id="payment_ref" name="payment_ref" readonly class="form-control @error('payment_ref') is-invalid @enderror" value="#{{ $payment->payment_ref }}" placeholder="Payment Ref">
            </div>
            @error('payment_ref') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" readonly class="form-control @error('email') is-invalid @enderror" value="{{ $payment->user->email }}" placeholder="Email">
            </div>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="payment_method" class="form-label">Payment Method</label>
                <input type="text" id="payment_method" name="payment_method" readonly class="form-control @error('payment_method') is-invalid @enderror" value="{{ $payment->payment_method->payment_method_name }}" placeholder="Umur">
            </div>
            @error('payment_method') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="payment_price" class="form-label">Payment Price</label>
                <input type="text" id="payment_price" name="payment_price" readonly class="form-control @error('payment_price') is-invalid @enderror" value="{{ $payment->payment_price }}" placeholder="Kabupaten/Kota">
            </div>
            @error('payment_price') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select class="form-select" id="payment_status" name="payment_status">
                    <option checked value="{{ $payment->payment_status }}">{{ $payment->payment_status }}</option>
                    <option value="PENDING">PENDING</option>
                    <option value="DECLINE">DECLINE</option>
                    <option value="SUCCESS">SUCCESS</option>
                </select>
            </div>

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
    <div class="col-lg-6">
        <img src="{{ asset('storage/' . $payment->payment_picture) }}" alt="" class="img-fluid">
    </div>
</div>
@endsection
