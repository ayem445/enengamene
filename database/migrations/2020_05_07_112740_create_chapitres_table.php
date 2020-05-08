<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapitresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'chapitres';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du chapitre');
            $table->string('libelle')->comment('libelle du chapitre');
            $table->string('description')->nullable()->comment('description du chapitre');
            $table->string('commentaire')->nullable()->comment('commentaire sur Quiz');

            $table->unsignedBigInteger('cour_id')->nullable()->comment('référence du Cours');
            $table->foreign('cour_id')->references('id')->on('cours')->onDelete('set null');

            $table->unsignedBigInteger('quiz_id')->nullable()->comment('référence du Quiz rattaché');
            $table->foreign('quiz_id')->references('id')->on('quizs')->onDelete('set null');

            $table->boolean('statut')->default(false)->comment('Statut du chapitre');
            $table->boolean('etat')->default(false)->comment('Etat du chapitre');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Chapitres de Cours du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chapitres', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropForeign(['cour_id']);
        });
        Schema::dropIfExists('chapitres');
    }
}
