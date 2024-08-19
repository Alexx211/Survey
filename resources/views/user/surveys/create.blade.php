@extends('layouts.app')

@section('content')
    <h1>Create New Survey</h1>

    <form action="{{ route('user.surveys.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <button type="submit">Create Survey</button>
    </form>
@endsection
