<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyUserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Ruta principală
Route::get('/', function () {
return view('welcome');
});




// Ruta pentru dashboard
Route::get('/dashboard', function () {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Rute pentru utilizatori autentificați
Route::middleware('auth')->group(function () {


    //Ruta pentru login

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

    Route::get('surveys', [SurveyController::class, 'index'])->name('user.surveys.index');

// Formular pentru creare sondaj
    Route::get('surveys/create', [SurveyController::class, 'create'])->name('user.surveys.create');
    Route::post('surveys', [SurveyController::class, 'store'])->name('user.surveys.store');

// Afișare detalii sondaj și întrebări
    Route::get('surveys/{survey}', [SurveyController::class, 'show'])->name('user.surveys.show');

// Formular pentru editare sondaj
    Route::get('surveys/{survey}/edit', [SurveyController::class, 'edit'])->name('user.surveys.edit');
    Route::put('surveys/{survey}', [SurveyController::class, 'update'])->name('user.surveys.update');


// Rute pentru rezolvare sondaj
    Route::get('surveys/{survey}/resolve', [SurveyController::class, 'resolve'])->name('user.surveys.resolve');
    Route::post('surveys/{survey}/submit', [SurveyController::class, 'submitAnswers'])->name('user.surveys.submit');

    Route::get('surveys/{survey}/questions/create', [SurveyController::class, 'createQuestionAndAnswers'])->name('questions.create');
    Route::post('surveys/{survey}/questions/store', [SurveyController::class, 'storeQuestionAndAnswers'])->name('questions.store');

    Route::get('/surveys/{surveyId}/check', [SurveyController::class, 'checkSurveyQuestions']);




});

// routes/web.php

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/register-success', function () {
    return view('register-success');
})->name('register.success');

route::get('/register', [RegisteredUserController::class, 'create'])->name('register');


Route::get('/surveys/delete', [SurveyController::class, 'showDeletePage'])->name('surveys.delete');

// Ruta pentru trimiterea formularului de înregistrare
Route::post('/register', [RegisteredUserController::class, 'store']);


// Rute pentru admin
Route::middleware('is_admin')->prefix('admin')->group(function () {
    Route::resource('surveys', SurveyController::class)->names([
        'index' => 'admin.surveys.index',
        'create' => 'admin.surveys.create',
        'store' => 'admin.surveys.store',
        'show' => 'admin.surveys.show',
        'edit' => 'admin.surveys.edit',
        'update' => 'admin.surveys.update',
        'destroy' => 'admin.surveys.destroy',
    ]);
});

require __DIR__.'/auth.php';
