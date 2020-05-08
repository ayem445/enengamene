<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'notations';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code de la notation');
            $table->integer('note')->comment('note');
            $table->boolean('statut')->default(false)->comment('Statut de la notation');
            $table->boolean('etat')->default(false)->comment('Etat de la notation');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Notations du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notations');
    }
}
