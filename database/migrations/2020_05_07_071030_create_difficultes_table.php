<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifficultesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'difficultes';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code de la difficulté');
            $table->string('libelle', 100)->unique()->comment('libelle de la difficulté');
            $table->int('niveau')->comment('niveau de la difficulté');
            $table->boolean('statut')->is_default(false)->comment('Statut de la difficulté');
            $table->boolean('etat')->is_default(false)->comment('Etat de la difficulté');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Niveaux de difficultés (des cours) du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('difficultes');
    }
}
