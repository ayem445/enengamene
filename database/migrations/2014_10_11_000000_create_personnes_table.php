<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'personnes';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code de la Personne');
            $table->string('email')->comment('email de la Personne');
            $table->string('nom')->comment('nom de la Personne');
            $table->string('prenom')->nullable()->comment('prenom de la Personne');
            $table->string('sexe')->nullable()->comment('sexe de la Personne');
            $table->string('adresse')->nullable()->comment('adresse de la Personne');
            $table->string('telephone')->nullable()->comment('telephone de la Personne');
            $table->string('fonction')->nullable()->comment('fonction de la Personne');
            $table->string('pays')->nullable()->comment('fonction de la Personne');

            $table->boolean('statut')->is_default(false)->comment('Statut de la Personne');
            $table->boolean('etat')->is_default(false)->comment('Etat de la Personne');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Personnes du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnes');
    }
}
