<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
Schema::create('answers', function (Blueprint $table) {
$table->id();
$table->unsignedBigInteger('question_id');
$table->string('answer_text');
    $table->string('correct_answer')->nullable();
$table->boolean('is_correct')->default(false);
$table->timestamps();

// Foreign key constraint
$table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('answers');
}
}
