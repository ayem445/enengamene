<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTypeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'quiz_type_questions';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du Type de question');
            $table->string('libelle', 100)->unique()->comment('libelle du Type de question: Texte-Match, Choix-Multiple');
            $table->string('description')->nullable()->comment('description du Type de question');

            $table->boolean('statut')->is_default(false)->comment('Statut du Type de question');
            $table->boolean('etat')->is_default(false)->comment('Etat du Type de question');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Types de Question d une Question de Quiz du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_type_questions');
    }
}
