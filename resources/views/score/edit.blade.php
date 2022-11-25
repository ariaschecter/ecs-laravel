@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('score/update/' . $score->score_id) }}">
            @csrf
            <div class="mt-2">
                <label for="sub_mapel_id" class="form-label">Select Sub Mapel</label>
                <select class="form-select" id="sub_mapel_id" name="sub_mapel_id">
                    <option value="{{ $score->sub_mapel_id }}">{{ $score->sub_mapel->mapel->mapel_name . ' - ' .
                        $score->sub_mapel->sub_mapel_name }}</option>
                    @foreach ($sub_mapels as $sub_mapel)
                    <option value="{{ $sub_mapel->sub_mapel_id }}">{{ $sub_mapel->mapel->mapel_name . ' - ' .
                        $sub_mapel->sub_mapel_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="question" class="form-label">Score</label>
                <input type="text" id="score" name="score" class="form-control @error('score') is-invalid @enderror"
                    value="{{ $score->score }}" placeholder="Score">
            </div>
            @error('question') <div class="text-danger">{{ $message }}</div> @enderror

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection