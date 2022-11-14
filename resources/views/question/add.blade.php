@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('question/add') }}">
            @csrf
            <div class="mt-2">
                <label for="sub_mapel_id" class="form-label">Select Sub Mapel</label>
                <select class="form-select" id="sub_mapel_id" name="sub_mapel_id">
                    @foreach ($sub_mapels as $sub_mapel)
                        <option value="{{ $sub_mapel->sub_mapel_id }}">{{ $sub_mapel->mapel->mapel_name . ' - ' . $sub_mapel->sub_mapel_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="question" class="form-label">Question</label>
                <input type="text" id="question" name="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question') }}" placeholder="Sub Mapel No">
            </div>
            @error('question') <div class="text-danger">{{ $message }}</div> @enderror

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection
