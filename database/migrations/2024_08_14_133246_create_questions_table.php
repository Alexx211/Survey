<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
public function up()
{
Schema::create('questions', function (Blueprint $table) {
$table->id();
$table->foreignId('survey_id')->constrained()->onDelete('cascade');
$table->text('question_text');
$table->enum('question_type', ['multiple_choice', 'text']); // Adaptează după nevoile tale
$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('questions');
}
}
