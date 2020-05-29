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

            $table->string('code')->unique()->comment('code de la session');
            $table->string('libelle')->comment('libelle de la session');
            $table->string('lien')->nullable()->comment('lien vers le fichier ou ID de la vidéo (le cas échéant)');
            $table->string('description')->nullable()->comment('description de la session');
            $table->string('commentaire')->nullable()->comment('commentaire sur Quiz');

            $table->integer('num_ordre')->nullable()->comment('numéro d ordre de la session dans le chapitre');

            $table->unsignedBigInteger('chapitre_id')->nullable()->comment('référence du chapitre');
            $table->foreign('chapitre_id')->references('id')->on('chapitres')->onDelete('set null');

            $table->unsignedBigInteger('type_contenu_id')->nullable()->comment('référence du type de contenu');
            $table->foreign('type_contenu_id')->references('id')->on('type_contenus')->onDelete('set null');

            $table->unsignedBigInteger('quiz_id')->nullable()->comment('référence du Quiz rattaché');
            $table->foreign('quiz_id')->references('id')->on('quizs')->onDelete('set null');

            // Infos Hebergeur video
            // object attributes:
            // id,title,description,url,upload_date,thumbnail_small,thumbnail_medium,thumbnail_large,
            // user_id,user_name,user_url,user_portrait_small,user_portrait_medium,user_portrait_large,
            // user_portrait_huge,stats_number_of_likes,stats_number_of_plays,stats_number_of_comments,
            // duration,width,height,
            // tags => SimpleXMLElement,
            // embed_privacy

            $table->integer('taille_o')->nullable()->comment('taille du fichier de la session (en octet)');
            $table->integer('duree_s')->nullable()->comment('duree de la session (en secondes)');
            $table->string('duree_hhmmss')->nullable()->comment('duree de la session (en hh:mm:ss)');
            $table->integer('width')->nullable()->comment('largeur de la session');
            $table->integer('height')->nullable()->comment('hauteur de la session');
            $table->integer('stats_number_of_likes')->nullable()->comment('nombre de likes');
            $table->integer('stats_number_of_plays')->nullable()->comment('nombre de fois que la video a été jouée');
            $table->integer('stats_number_of_comments')->nullable()->comment('nombre de commentaires recus par la video');

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
