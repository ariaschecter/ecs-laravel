@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('sub_mapel/add') }}">
            @csrf
            <div class="mt-2">
                <label for="mapel_id" class="form-label">Select Mapel</label>
                <select class="form-select" id="mapel_id" name="mapel_id">
                    @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->mapel_id }}">{{ $mapel->mapel_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="sub_mapel_no" class="form-label">Sub Mapel No</label>
                <input type="number" id="sub_mapel_no" name="sub_mapel_no" class="form-control @error('sub_mapel_no') is-invalid @enderror" value="{{ old('sub_mapel_no') }}" placeholder="Sub Mapel No">
            </div>
            @error('sub_mapel_no') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="sub_mapel_name" class="form-label">Sub Mapel Name</label>
                <input type="text" id="sub_mapel_name" name="sub_mapel_name" class="form-control @error('sub_mapel_name') is-invalid @enderror" value="{{ old('sub_mapel_name') }}" placeholder="Sub Mapel Name">
            </div>
            @error('sub_mapel_name') <div class="text-danger">{{ $message }}</div> @enderror

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection
