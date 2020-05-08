<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'quizs';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du Quiz');
            $table->string('libelle', 100)->unique()->comment('libelle du Quiz');
            $table->string('description')->nullable()->comment('description du Quiz');
            $table->string('commentaire')->nullable()->comment('commentaire sur Quiz');

            $table->boolean('statut')->default(false)->comment('Statut du Quiz');
            $table->boolean('etat')->default(false)->comment('Etat du Quiz');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Quiz du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizs');
    }
}
