<?php
namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class SurveyUserController extends Controller
{
// Afișare test pentru utilizator
public function show(Survey $survey)
{
    $questions = $survey->questions()->with('answers')->get();

    return view('user.surveys.show', compact('survey', 'questions'));
}

// Stocare răspunsuri și afișare rezultate
    public function store(Request $request, Survey $survey)
    {
        $score = 0;

        foreach ($request->answers as $question_id => $answer_id) {
            $answer = Answer::find($answer_id);
            $isCorrect = $answer->is_correct;

            UserAnswer::create([
                'user_id' => auth()->id(),
                'question_id' => $question_id,
                'answer_id' => $answer_id,
                'is_correct' => $isCorrect,
            ]);

            if ($isCorrect) {
                $score++;
            }
        }

        return view('user.surveys.result', compact('score', 'survey'));
    }

    public function result(Survey $survey)
    {
        $score = session('score');
        return view('user.surveys.result', compact('survey', 'score'));
    }
}
