@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('mapel/edit/' . $mapel->mapel_id) }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="mapel_name" class="form-label">Mapel Name</label>
                <input type="text" id="mapel_name" name="mapel_name" class="form-control @error('mapel_name') is-invalid @enderror" value="{{ $mapel->mapel_name }}" placeholder="Mapel Name">
            </div>
            @error('mapel_name') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="semester_id" class="form-label">Semester</label>
                <input type="number" id="semester_id" name="semester_id" class="form-control @error('semester_id') is-invalid @enderror" value="{{ $mapel->semester_id }}" placeholder="Semester">
            </div>
            @error('semester_id') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <label for="mapel_picture" class="form-label">Mapel Picture</label>
                <input type="file" id="mapel_picture" name="mapel_picture" class="form-control @error('mapel_picture') is-invalid @enderror">
            </div>
            @error('mapel_picture') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="mapel_active" name="mapel_active" value="1" {{ $mapel->mapel_active ? 'checked': '' }}>
                    <label class="form-check-label" for="mapel_active">Active?</label>
                </div>
            </div>

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
    <div class="col-lg-6">
        <img src="{{ asset('storage/' . $mapel->mapel_picture) }}" alt="" class="img-fluid">
    </div>
</div>
@endsection
