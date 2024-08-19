@extends('layouts.app')

@section('content')
    <h1>{{ $survey->title }}</h1>
    <p>{{ $survey->description }}</p>

    @if($questions->isEmpty())
        <p>No questions have been added to this survey yet.</p>
    @else
        <ul>
            @foreach($questions as $question)
                <li>{{ $question->question_text }}</li>
                <ul>
                    @foreach($question->answers as $answer)
                        <li>{{ $answer->answer_text }}</li>
                    @endforeach
                </ul>
            @endforeach
        </ul>
    @endif
@endsection
