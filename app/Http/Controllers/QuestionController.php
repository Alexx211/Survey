<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Afișează formularul de creare a unei întrebări
    public function create(Survey $survey)
    {
        return view('user.questions.create', compact('survey'));
    }

    // Salvează o nouă întrebare
    public function store(Request $request, Survey $survey)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'question_type' => 'required|string',
        ]);

        $question = new Question();
        $question->survey_id = $survey->id;
        $question->question_text = $request->input('question_text');
        $question->question_type = $request->input('question_type');
        $question->save();

        return redirect()->route('user.surveys.show', $survey)->with('success', 'Question added successfully!');
    }
}

