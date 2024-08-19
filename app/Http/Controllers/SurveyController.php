<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    public function index() {
        $surveys = Survey::all();
        return view('user.surveys.index', compact('surveys'));
    }


    public function create() {
        return view('user.surveys.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $survey = new Survey();
        $survey->title = $request->input('title');
        $survey->description = $request->input('description');
        $survey->user_id = auth()->id();
        $survey->save();

        return redirect()->route('user.surveys.index')->with('success', 'Survey created successfully!');
    }

    public function show(Survey $survey) {
        $questions = $survey->questions()->with('answers')->get();

        return view('user.surveys.show', compact('survey', 'questions'));


    }

    public function resolve(Survey $survey) {

        $questions = $survey->questions()->with('answers')->get();


        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'This survey has no questions.');
        }

        return view('user.surveys.resolve', compact('survey', 'questions'));
    }

    public function submitAnswers(Request $request, Survey $survey)
    {
        $score = 0;
        $totalQuestions = $survey->questions->count();
        $incorrectAnswers = []; // Inițializăm un array pentru răspunsurile greșite

        foreach ($request->answers as $question_id => $answer_id) {
            $question = Question::find($question_id);

            if ($question->question_type === 'multiple_choice') {
                $answer = Answer::find($answer_id);

                if ($answer && $answer->is_correct) {
                    $score++;
                } else {
                    // Adaugă întrebarea și răspunsul corect în lista de răspunsuri greșite
                    $correctAnswer = $question->answers->where('is_correct', true)->first();
                    $incorrectAnswers[] = [
                        'question' => $question,
                        'selectedAnswer' => $answer,
                        'correctAnswer' => $correctAnswer,
                    ];
                }
            }
        }

        $result = [
            'score' => $score,
            'total' => $totalQuestions,
            'percentage' => ($score / $totalQuestions) * 100,
            'incorrectAnswers' => $incorrectAnswers, // Transmitem răspunsurile greșite către view
        ];

        return view('user.surveys.result', compact('survey', 'result'));
    }

    public function addQuestion($surveyId)
    {
        $survey = Survey::findOrFail($surveyId);
        return view('user.surveys.add_question', compact('survey'));
    }

    public function createQuestionAndAnswers(Survey $survey)
    {
        return view('surveys.create_question_and_answers', compact('survey'));
    }

    public function storeQuestionAndAnswers(Request $request, Survey $survey)
    {

        $request->validate([
            'question_text' => 'required|string|max:255',
            'question_type' => 'required|string',
            'correct_answer' => 'nullable|string|max:255',
            'answers' => 'required_if:question_type,multiple_choice|array',
            'answers.*.answer_text' => 'required_if:question_type,multiple_choice|string|max:255',
            'answers.*.is_correct' => 'nullable|boolean',
        ]);


        $question = new Question();
        $question->survey_id = $survey->id;
        $question->question_text = $request->input('question_text');
        $question->question_type = $request->input('question_type');
        $question->save();

        if ($question->question_type === 'multiple_choice') {
            foreach ($request->input('answers') as $answerData) {
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->answer_text = $answerData['answer_text'];
                $answer->is_correct = $answerData['is_correct'] ?? false;
                $answer->save();
            }
        }

        return redirect()->route('user.surveys.show', $survey->id)->with('success', 'Question and answers added successfully!');
    }

    public function checkSurveyQuestions($surveyId)
    {

        $survey = Survey::with('questions.answers')->find($surveyId);

        if (!$survey) {
            return "Sondajul nu a fost găsit.";
        }


        foreach ($survey->questions as $question) {
            echo "Întrebare: " . $question->question_text . "<br>";

            foreach ($question->answers as $answer) {
                $correct = $answer->is_correct ? "DA" : "NU";
                echo "Răspuns: " . $answer->answer_text . " | Corect: " . $correct . "<br>";
            }

            echo "<br>";
        }
    }


    public function edit(Survey $survey) {
        return view('user.surveys.edit', compact('survey'));
    }


    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $survey->update($request->all());

        return redirect()->route('user.surveys.index')->with('success', 'Survey updated successfully!');
    }


    public function destroy(Survey $survey) {
        $survey->delete();
        return redirect()->route('user.surveys.index');
    }

}
