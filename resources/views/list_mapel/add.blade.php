@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('list_mapel/add') }}">
            @csrf
            <div class="mt-2">
                <label for="sub_mapel_id" class="form-label">Select Sub Mapel</label>
                <select class="form-select" id="sub_mapel_id" name="sub_mapel_id">
                    @foreach ($sub_mapels as $sub_mapel)
                    <option value="{{ $sub_mapel->sub_mapel_id }}">{{ $sub_mapel->mapel->mapel_name . ' - '
                        .$sub_mapel->sub_mapel_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="list_mapel_no" class="form-label">List Mapel No</label>
                <input type="number" id="list_mapel_no" name="list_mapel_no"
                    class="form-control @error('list_mapel_no') is-invalid @enderror" value="{{ old('list_mapel_no') }}"
                    placeholder="List Mapel No">
            </div>
            @error('list_mapel_no') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="list_mapel_name" class="form-label">List Mapel Name</label>
                <input type="text" id="list_mapel_name" name="list_mapel_name"
                    class="form-control @error('list_mapel_name') is-invalid @enderror"
                    value="{{ old('list_mapel_name') }}" placeholder="List Mapel Name">
            </div>
            @error('list_mapel_name') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="list_mapel_link" class="form-label">List Mapel Link</label>
                <input type="text" id="list_mapel_link" name="list_mapel_link"
                    class="form-control @error('list_mapel_link') is-invalid @enderror"
                    value="{{ old('list_mapel_link') }}" placeholder="List Mapel Link">
            </div>
            @error('list_mapel_link') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="list_mapel_desc" class="form-label">Text area</label>
                <textarea class="form-control @error('list_mapel_desc') is-invalid @enderror" id="list_mapel_desc"
                    name="list_mapel_desc" rows="10"></textarea>
            </div>
            @error('list_mapel_desc') <div class="text-danger">{{ $message }}</div> @enderror

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection