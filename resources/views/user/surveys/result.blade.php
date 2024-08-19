@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Survey Results</h1>

        <p>Score: {{ $result['score'] }} / {{ $result['total'] }}</p>
        <p>Percentage: {{ number_format($result['percentage'], 2) }}%</p>

        @if(!empty($result['incorrectAnswers']))
            <h2>Incorrect Answers:</h2>
            <ul>
                @foreach($result['incorrectAnswers'] as $incorrectAnswer)
                    <li>
                        <strong>Question:</strong> {{ $incorrectAnswer['question']->question_text }}<br>
                        <strong>Your Answer:</strong> {{ $incorrectAnswer['selectedAnswer']->answer_text ?? 'No Answer Selected' }}<br>
                        <strong>Correct Answer:</strong> {{ $incorrectAnswer['correctAnswer']->answer_text }}
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('user.surveys.index') }}" class="btn btn-primary">Back to Surveys</a>
    </div>
@endsection
