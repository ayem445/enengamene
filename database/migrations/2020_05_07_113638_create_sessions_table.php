<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'sessions';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code de la session');
            $table->string('libelle')->comment('libelle de la session');
            $table->string('lien')->nullable()->comment('lien vers le fichier ou ID de la vidéo (le cas échéant)');
            $table->string('description')->nullable()->comment('description de la session');
            $table->string('commentaire')->nullable()->comment('commentaire sur Quiz');

            $table->integer('num_ordre')->nullable()->comment('numéro d ordre de la session dans le chapitre');

            $table->integer('taille')->nullable()->comment('taille du fichier de la session');
            $table->integer('duree')->nullable()->comment('duree en secondes de la session');

            $table->unsignedBigInteger('chapitre_id')->nullable()->comment('référence du chapitre');
            $table->foreign('chapitre_id')->references('id')->on('chapitres')->onDelete('set null');

            $table->unsignedBigInteger('type_contenu_id')->nullable()->comment('référence du type de contenu');
            $table->foreign('type_contenu_id')->references('id')->on('type_contenus')->onDelete('set null');

            $table->unsignedBigInteger('quiz_id')->nullable()->comment('référence du Quiz rattaché');
            $table->foreign('quiz_id')->references('id')->on('quizs')->onDelete('set null');

            $table->boolean('statut')->default(false)->comment('Statut de la session');
            $table->boolean('etat')->default(false)->comment('Etat de la session');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Sessions de chapitre de cours du Système.'");
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
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropForeign(['type_contenu_id']);
            $table->dropForeign(['chapitre_id']);
        });
        Schema::dropIfExists('sessions');
    }
}
