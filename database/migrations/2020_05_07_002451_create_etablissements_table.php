<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'etablissements';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique()->comment('code de l établissement');
            $table->string('nom', 100)->comment('nom de l établissement');

            $table->unsignedBigInteger('type_etablissement_id')->nullable()->comment('référence du type de l établissement');
            $table->foreign('type_etablissement_id')->references('id')->on('type_etablissements')->onDelete('set null');

            $table->string('numero_agrement')->nullable()->comment('numéro d agrément');
            $table->string('description')->nullable()->comment('description de l établissement');
            $table->string('adresse')->nullable()->comment('adresse de l établissement');
            $table->string('telephone')->nullable()->comment('numéro de telephone de l établissement');
            $table->string('email')->nullable()->comment('adresse e-mail de l établissement');
            $table->string('commentaire')->nullable()->comment('commentaire sur l établissement');
            $table->string('pays')->nullable()->comment('pays de l établissement');
            $table->string('province')->nullable()->comment('province de l établissement');
            $table->string('ville')->nullable()->comment('ville de l établissement');
            $table->string('localisation')->nullable()->comment('localisation de l établissement');

            $table->boolean('statut')->default(false)->comment('Statut de l établissement');
            $table->boolean('etat')->default(false)->comment('Etat de l établissement');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Etablissements du Système.'");
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
        Schema::table('etablissements', function (Blueprint $table) {
            $table->dropForeign(['type_etablissement_id']);
        });
        Schema::dropIfExists('etablissements');
    }
}
