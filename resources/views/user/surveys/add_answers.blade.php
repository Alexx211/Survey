@extends('layouts.app')

@section('content')
    <h1>Add Answers to Question</h1>

    <form action="{{ route('answers.store', $question->id) }}" method="POST">
        @csrf
        <div>
            <label for="answer_text">Answer Text</label>
            <input type="text" id="answer_text" name="answer_text" required>
        </div>

        <div>
            <label for="is_correct">Is Correct?</label>
            <input type="checkbox" id="is_correct" name="is_correct">
        </div>

        <button type="submit">Add Answer</button>
    </form>
@endsection

