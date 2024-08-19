<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function addAnswers($questionId)
    {
        $question = Question::findOrFail($questionId);
        return view('user.surveys.add_answers', compact('question'));
    }

    public function storeAnswer(Request $request, $questionId)
    {
        $request->validate([
            'answer_text' => 'required|string|max:255',
            'is_correct' => 'nullable|boolean',
        ]);

        $question = Question::findOrFail($questionId);

        $answer = new Answer();
        $answer->question_id = $question->id;
        $answer->answer_text = $request->input('answer_text');
        $answer->is_correct = $request->has('is_correct');
        $answer->save();

        return redirect()->route('questions.addAnswers', $question->id)->with('success', 'Answer added successfully!');
    }
}
