@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Creează Survey</h1>
        <form action="{{ route('admin.surveys.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Titlu</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descriere</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Salvează</button>
        </form>
    </div>
@endsection

