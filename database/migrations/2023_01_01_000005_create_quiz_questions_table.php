<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained();
            $table->text('question');
            $table->json('options'); // {"a": "Option 1", "b": "Option 2"}
            $table->string('correct_answer'); // 'a', 'b', etc.
            $table->integer('points')->default(1);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
};   