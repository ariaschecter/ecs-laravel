@extends('layouts.content')

@section('body')
<form method="post" action="{{ url('quiz') }}">
    @csrf
    @foreach($questions as $question)
    <div class="mb-3">
        <label class="form-label">{{ $question->question }}</label>
        @foreach($question->choice as $choice)
            <div class="form-check mb-1">
                <input type="radio" name="{{ $choice->question_id }}" id="{{ $choice->choice_id }}" value="{{ $choice->choice_id }}" required="" class="form-check-input">
                <label for="{{ $choice->choice_id }}">{{ $choice->choice_name }}</label>
            </div>
        @endforeach
    </div>
    @endforeach
    <div>
        <input type="submit" class="btn btn-success" value="Validate">
    </div>
</form>
@endsection
