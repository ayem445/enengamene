<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNiveauEtudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'niveau_etudes';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du niveau d étude');
            $table->string('libelle', 100)->comment('libelle du niveau d étude');
            $table->boolean('statut')->is_default(false)->comment('Statut du niveau d étude');
            $table->boolean('etat')->is_default(false)->comment('Etat du niveau d étude');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Niveaux d étude du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveau_etudes');
    }
}
