<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'matieres';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code de la matière');
            $table->string('libelle', 100)->unique()->comment('libelle de la matière');
            $table->string('description')->nullable()->comment('description de la matière');
            $table->string('commentaire')->nullable()->comment('commentaire sur la matière');

            $table->boolean('statut')->is_default(false)->comment('Statut de la matière');
            $table->boolean('etat')->is_default(false)->comment('Etat de la matière');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Matières du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matieres');
    }
}
