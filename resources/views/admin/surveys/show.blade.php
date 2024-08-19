@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $survey->title }}</h1>
        <p>{{ $survey->description }}</p>

        <h3>Întrebări</h3>
        <a href="{{ route('admin.surveys.questions.create', $survey->id) }}" class="btn btn-primary">Adaugă Întrebare Nouă</a>

        <ul class="list-group mt-3">
            @foreach($survey->questions as $question)
                <li class="list-group-item">
                    {{ $question->question_text }}
                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline-block; float:right;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Șterge</button>
                    </form>
                    <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-warning btn-sm" style="float:right; margin-right: 10px;">Editează</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
