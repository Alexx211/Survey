<!DOCTYPE html>
<html>
<head>
    <title>Survey</title>
</head>
<body>
<h1>{{ $survey->title }}</h1>
<form action="{{ route('user.surveys.store', $survey) }}" method="POST">
    @csrf
    @foreach ($survey->questions as $question)
        <div>
            <p>{{ $question->text }}</p>
            @foreach ($question->answers as $answer)
                <label>
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                    {{ $answer->text }}
                </label>
            @endforeach
        </div>
    @endforeach
    <button type="submit">Submit</button>
</form>
</body>
</html>
