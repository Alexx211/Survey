@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Question to Survey: {{ $survey->title }}</h1>

        <form action="{{ route('questions.store', $survey) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question_text">Question Text</label>
                <input type="text" class="form-control" id="question_text" name="question_text" required>
            </div>

            <div class="form-group">
                <label for="question_type">Question Type</label>
                <select class="form-control" id="question_type" name="question_type" required>
                    <option value="multiple_choice">Multiple Choice</option>
                    <option value="text">Text</option>
                    <option value="boolean">True/False</option>
                    <!-- Adaugă alte tipuri de întrebări necesare -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Question</button>
        </form>
    </div>
@endsection
