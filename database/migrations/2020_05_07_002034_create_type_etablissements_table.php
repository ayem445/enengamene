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

            $table->string('code')->unique()->comment('code du type d établissement');
            $table->string('libelle', 100)->comment('libelle du type d établissement');
            $table->string('description')->nullable()->comment('description du type d établissement');

            $table->boolean('statut')->default(false)->comment('Statut du type d établissement');
            $table->boolean('etat')->default(false)->comment('Etat du type d établissement');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Types d établissement du Système.'");
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
        Schema::dropIfExists('type_etablissements');
    }
}
