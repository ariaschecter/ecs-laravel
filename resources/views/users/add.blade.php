@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('user/add') }}">
            @csrf
            <div>
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Full Name">
            </div>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="Email">
            </div>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="user_city" class="form-label">City</label>
                <input type="text" id="user_city" name="user_city"
                    class="form-control @error('user_city') is-invalid @enderror" value="{{ old('user_city') }}"
                    placeholder="Kabupaten/Kota">
            </div>
            @error('user_city') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="user_age" class="form-label">Age</label>
                <input type="number" id="user_age" name="user_age"
                    class="form-control @error('user_age') is-invalid @enderror" value="{{ old('user_age') }}"
                    placeholder="Umur">
            </div>
            @error('user_age') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            </div>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Password Confirmation">
            </div>
            @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror

            {{-- <div>
                <label for="example-helping" class="form-label">Helping text</label>
                <input type="text" id="example-helping" class="form-control" placeholder="Helping text">
                <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond
                        one line.</small></span>
            </div> --}}
            <div class="mt-2">
                <label for="role_id" class="form-label">Select Role</label>
                <select class="form-select" id="role_id" name="role_id">
                    @foreach ($roles as $role)
                    <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                    <label class="form-check-label" for="active">Check me out !</label>
                </div>
            </div>

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection