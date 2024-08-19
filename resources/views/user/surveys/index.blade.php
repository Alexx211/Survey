@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Surveys</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($surveys as $survey)
                <tr>
                    <td>{{ $survey->title }}</td>
                    <td>
                        <a href="{{ route('user.surveys.show', $survey->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('user.surveys.edit', $survey->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('user.surveys.destroy', $survey->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('user.surveys.resolve', $survey->id) }}" class="btn btn-success">Resolve</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
