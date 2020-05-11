<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'cours';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique()->comment('code du cours');
            $table->string('libelle')->comment('libelle du Cours');
            $table->string('description')->nullable()->comment('description du Cours');
            $table->string('commentaire')->nullable()->comment('commentaire sur Quiz');

            $table->string('image_url')->nullable()->comment('url de l image du cours');

            $table->unsignedBigInteger('auteur_id')->nullable()->comment('référence de l auteur (personne) du cours');
            $table->foreign('auteur_id')->references('id')->on('personnes')->onDelete('set null');

            $table->unsignedBigInteger('matiere_id')->nullable()->comment('référence de la matiere du cours');
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('set null');

            $table->unsignedBigInteger('niveau_etude_id')->nullable()->comment('référence du niveau d étude du cours');
            $table->foreign('niveau_etude_id')->references('id')->on('niveau_etudes')->onDelete('set null');

            $table->unsignedBigInteger('difficulte_id')->nullable()->comment('niveau de difficulté du cours');
            $table->foreign('difficulte_id')->references('id')->on('difficultes')->onDelete('set null');

            $table->unsignedBigInteger('quiz_id')->nullable()->comment('référence du Quiz rattaché');
            $table->foreign('quiz_id')->references('id')->on('quizs')->onDelete('set null');

            $table->boolean('statut')->default(false)->comment('Statut du Cours');
            $table->boolean('etat')->default(false)->comment('Etat du Cours');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Cours du Système.'");
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
        Schema::table('cours', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropForeign(['auteur_id']);
            $table->dropForeign(['difficulte_id']);
            $table->dropForeign(['matiere_id']);
            $table->dropForeign(['niveau_etude_id']);
        });
        Schema::dropIfExists('cours');
    }
}
