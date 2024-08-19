@extends('layouts.app')

@section('content')
    <h1>Edit Survey: {{ $survey->title }}</h1>

    <form action="{{ route('user.surveys.update', $survey->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Indică faptul că metoda HTTP este PUT pentru actualizare -->

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $survey->title }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ $survey->description }}</textarea>
        </div>

        <button type="submit">Update Survey</button>
    </form>
@endsection
