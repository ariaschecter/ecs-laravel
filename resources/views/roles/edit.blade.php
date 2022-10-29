@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('role/edit/' . $role->role_id) }}">
            @csrf
            <div>
                <label for="role_name" class="form-label">Role Name</label>
                <input type="text" id="role_name" name="role_name" class="form-control @error('role_name') is-invalid @enderror" value="{{ $role->role_name }}" placeholder="Role Name">
            </div>
            @error('role_name') <div class="text-danger">{{ $message }}</div> @enderror

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection
