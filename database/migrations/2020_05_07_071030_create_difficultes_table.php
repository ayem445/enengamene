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

            $table->string('code')->unique()->comment('code de la difficulté');
            $table->string('libelle', 100)->unique()->comment('libelle de la difficulté');
            $table->integer('level')->comment('niveau hiérarchique');
            $table->boolean('statut')->default(false)->comment('Statut de la difficulté');
            $table->boolean('etat')->default(false)->comment('Etat de la difficulté');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Niveaux de difficultés (des cours) du Système.'");
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
        Schema::dropIfExists('difficultes');
    }
}
