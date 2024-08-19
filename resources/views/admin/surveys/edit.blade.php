@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editează Survey</h1>
        <form action="{{ route('admin.surveys.update', $survey->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titlu</label>
                <input type="text" name="title" class="form-control" value="{{ $survey->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descriere</label>
                <textarea name="description" class="form-control">{{ $survey->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Actualizează</button>
        </form>
    </div>
@endsection
