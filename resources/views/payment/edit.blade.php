@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('user/edit/' . $user->user_id) }}">
            @csrf
            <div>
                <label for="user_name" class="form-label">Full Name</label>
                <input type="text" id="user_name" name="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ $user->user_name }}" placeholder="Full Name">
            </div>
            @error('user_name') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" placeholder="Email">
            </div>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="user_city" class="form-label">City</label>
                <input type="text" id="user_city" name="user_city" class="form-control @error('user_city') is-invalid @enderror" value="{{ $user->user_city }}" placeholder="Kabupaten/Kota">
            </div>
            @error('user_city') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="user_age" class="form-label">Age</label>
                <input type="number" id="user_age" name="user_age" class="form-control @error('user_age') is-invalid @enderror" value="{{ $user->user_age }}" placeholder="Umur">
            </div>
            @error('user_age') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="example-select" class="form-label">Select Role</label>
                <select class="form-select" id="role_id" name="role_id">
                    <option selected value="{{ $user->role_id }}">{{ $user->role->role_name }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ $user->active ? 'checked': '' }}>
                    <label class="form-check-label" for="active">Check me out !</label>
                </div>
            </div>

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection
