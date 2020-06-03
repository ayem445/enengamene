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

            $table->string('code')->unique()->comment('code du Type de Contenu');
            $table->string('libelle', 100)->unique()->comment('libelle du Type de Contenu');
            $table->string('description')->nullable()->comment('description du Type de Contenu');
            $table->string('illustration1')->nullable()->comment('script d illustration1');
            $table->boolean('statut')->default(false)->comment('Statut du Type de Contenu');
            $table->boolean('etat')->default(false)->comment('Etat du Type de Contenu');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Types de Contenu du Système.'");
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
        Schema::dropIfExists('type_contenus');
    }
}
