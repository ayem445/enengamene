<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'cours';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du cours');
            $table->string('libelle')->unique()->comment('libelle du Cours');
            $table->string('description')->nullable()->comment('description du Cours');
            $table->string('commentaire')->nullable()->comment('commentaire sur Quiz');

            $table->unsignedBigInteger('auteur_id')->nullable()->comment('référence de l auteur (personne) du cours');
            $table->foreign('auteur_id')->references('id')->on('personnes')->onDelete('set null');

            $table->unsignedBigInteger('quiz_id')->nullable()->comment('référence du Quiz rattaché');
            $table->foreign('quiz_id')->references('id')->on('quizs')->onDelete('set null');

            $table->boolean('statut')->default(false)->comment('Statut du Cours');
            $table->boolean('etat')->default(false)->comment('Etat du Cours');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Cours du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cours', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropForeign(['auteur_id']);
        });
        Schema::dropIfExists('cours');
    }
}
