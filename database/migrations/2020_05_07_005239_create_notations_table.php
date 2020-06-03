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

            $table->string('code')->unique()->comment('code de la notation');
            $table->string('libelle', 100)->unique()->comment('libelle de la notation');
            $table->integer('level')->comment('niveau hiérarchique');
            $table->string('illustration1')->nullable()->comment('script d illustration1');
            $table->boolean('statut')->default(false)->comment('Statut de la notation');
            $table->boolean('etat')->default(false)->comment('Etat de la notation');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Notations du Système.'");
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
        Schema::dropIfExists('notations');
    }
}
