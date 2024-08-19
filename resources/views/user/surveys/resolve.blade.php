@extends('layouts.app')

@section('content')
    <h1>Resolve Survey: {{ $survey->title }}</h1>

    <form action="{{ route('user.surveys.submit', $survey->id) }}" method="POST">
        @csrf

        @foreach($questions as $question)
            <div class="question">
                <p>{{ $question->question_text }}</p>

                <!-- Text box pentru întrebări de tip text -->
                @if($question->question_type === 'text')
                    <textarea name="answers[{{ $question->id }}]" rows="3" cols="50" placeholder="Your answer here..."></textarea>
                @endif

                <!-- Opțional: alte tipuri de întrebări -->
                @if($question->question_type === 'multiple_choice')
                    @foreach($question->answers as $answer)
                        <div>
                            <label>
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                                {{ $answer->answer_text }}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach

        <button type="submit">Submit Answers</button>
    </form>
@endsection
