<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'auteurs';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('resume', 500)->nullable()->comment('Infos résumées (parcours) sur l auteur');

            $table->unsignedBigInteger('personne_id')->nullable()->comment('référence de la personne');
            $table->foreign('personne_id')->references('id')->on('personnes')->onDelete('set null');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Les auteurs de cours du Système.'");
                break;
            case 'sqlite':
                //sqlite syntax
                break;
            default:
                //throw new \Exception('Driver not supported.');
                break;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auteurs', function (Blueprint $table) {
            $table->dropForeign(['personne_id']);
        });
        Schema::dropIfExists('auteurs');
    }
}
