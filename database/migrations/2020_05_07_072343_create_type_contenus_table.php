<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeContenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'type_contenus';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du Type de Contenu');
            $table->string('libelle', 100)->unique()->comment('libelle du Type de Contenu');
            $table->string('description')->nullable()->comment('description du Type de Contenu');

            $table->boolean('statut')->default(false)->comment('Statut du Type de Contenu');
            $table->boolean('etat')->default(false)->comment('Etat du Type de Contenu');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Types de Contenu du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_contenus');
    }
}
