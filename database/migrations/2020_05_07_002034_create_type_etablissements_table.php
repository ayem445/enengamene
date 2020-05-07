<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'type_etablissements';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du type d établissement');
            $table->string('nom', 100)->comment('nom du type d établissement');
            $table->string('description')->nullable()->comment('description du type d établissement');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Types d établissement du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_etablissements');
    }
}
