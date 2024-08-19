@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Question to Survey: {{ $survey->title }}</h1>

        <form action="{{ route('questions.store', $survey->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question_text" class="form-label">Question Text</label>
                <input type="text" class="form-control" id="question_text" name="question_text" required>
            </div>

            <div class="mb-3">
                <label for="question_type" class="form-label">Question Type</label>
                <select class="form-control" id="question_type" name="question_type">
                    <option value="text">Text</option>
                    <option value="radio">Multiple Choice (Radio)</option>
                    <option value="checkbox">Multiple Choice (Checkbox)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Question</button>
        </form>
    </div>
@endsection
