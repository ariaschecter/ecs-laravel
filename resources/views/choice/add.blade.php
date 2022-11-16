@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ url('choice/add') }}">
            @csrf
            <div class="mt-2">
                <label for="question_id" class="form-label">Question</label>
                <select class="form-select" id="question_id" name="question_id">
                    @foreach ($questions as $question)
                        <option value="{{ $question->question_id }}">{{ $question->question }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="choice_name" class="form-label">Choice Answer</label>
                <input type="text" id="choice_name" name="choice_name" class="form-control @error('choice_name') is-invalid @enderror" value="{{ old('choice_name') }}" placeholder="List Mapel No">
            </div>
            @error('choice_name') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="mt-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="choice_score" name="choice_score" value="1">
                    <label class="form-check-label" for="choice_score">Choice True ?</label>
                </div>
            </div>

            <button type="submit" class="mt-2 btn btn-primary waves-effect waves-light">Submit</button>
        </form>
    </div> <!-- end col -->
</div>
@endsection
