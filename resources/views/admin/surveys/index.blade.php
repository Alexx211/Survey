@extends('layouts.admin')

@section('content')
    <h1>Surveys</h1>
    <ul>
        @foreach ($surveys as $survey)
            <li>{{ $survey->title }}</li>
        @endforeach
    </ul>
@endsection
