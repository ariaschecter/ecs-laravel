@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('payment_method/add') }}">
            @csrf
            <div>
                <label for="payment_method_name" class="form-label">Payment Name</label>
                <input type="text" id="payment_method_name" name="payment_method_name" class="form-control @error('payment_method_name') is-invalid @enderror" value="{{ old('payment_method_name') }}" placeholder="Role Name">
            </div>
            @error('payment_method_name') <div class="text-danger">{{ $message }}</div> @enderror
            <div>
                <label for="payment_method_rek" class="form-label">Rekening</label>
                <input type="text" id="payment_method_rek" name="payment_method_rek" class="form-control @error('payment_method_rek') is-invalid @enderror" value="{{ old('payment_method_rek') }}" placeholder="Role Name">
            </div>
            @error('payment_method_rek') <div class="text-danger">{{ $message }}</div> @enderror

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection
