@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Șterge Sondaje</h1>
        <ul class="list-group">
            @foreach($surveys as $survey)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $survey->title }}
                    <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Șterge</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

