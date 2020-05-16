<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignsToPersonnes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personnes', function (Blueprint $table) {
            $table->unsignedBigInteger('etablissement_id')->nullable()->comment('niveau de difficulté du chapitre');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personnes', function (Blueprint $table) {
            $table->dropForeign(['etablissement_id']);
        });
    }
}
