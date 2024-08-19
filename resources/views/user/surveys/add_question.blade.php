@extends('layouts.app')

@section('content')
    <h1>Add Question to Survey</h1>

    <form action="{{ route('questions.store', $survey->id) }}" method="POST">
        @csrf
        <div>
            <label for="question_text">Question Text</label>
            <input type="text" id="question_text" name="question_text" required>
        </div>

        <div>
            <label for="question_type">Question Type</label>
            <select id="question_type" name="question_type" required>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="text">Text</option>
            </select>
        </div>

        <button type="submit">Add Question</button>
    </form>
@endsection

