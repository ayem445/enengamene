<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $tableName = 'quiz_questions';
      Schema::create($tableName, function (Blueprint $table) {
          $table->id();

          $table->string('libelle')->unique()->comment('libelle de la Question de Quiz');
          $table->string('description')->nullable()->comment('description de la Question de Quiz');
          $table->string('commentaire')->nullable()->comment('commentaire sur Quiz');

          $table->unsignedBigInteger('quiz_type_question_id')->nullable()->comment('référence du type de question');
          $table->foreign('quiz_type_question_id')->references('id')->on('quiz_type_questions')->onDelete('set null');

          $table->unsignedBigInteger('quiz_id')->nullable()->comment('référence du Quiz rattaché');
          $table->foreign('quiz_id')->references('id')->on('quizs')->onDelete('set null');

          $table->boolean('statut')->default(false)->comment('Statut de la Question de Quiz');
          $table->boolean('etat')->default(false)->comment('Etat de la Question de Quiz');

          $table->timestamps();
      });
      DB::statement("ALTER TABLE `$tableName` comment 'Questions d un Quiz du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropForeign(['quiz_type_question_id']);
        });
        Schema::dropIfExists('quiz_questions');
    }
}
