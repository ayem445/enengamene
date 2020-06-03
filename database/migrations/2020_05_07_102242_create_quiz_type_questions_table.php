<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTypeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'quiz_type_questions';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique()->comment('code du Type de question');
            $table->string('libelle', 100)->unique()->comment('libelle du Type de question: Texte-Libre, Choix-Multiple');
            $table->string('description')->nullable()->comment('description du Type de question');
            $table->string('illustration1')->nullable()->comment('script d illustration1');
            $table->boolean('statut')->default(false)->comment('Statut du Type de question');
            $table->boolean('etat')->default(false)->comment('Etat du Type de question');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Types de Question d une Question de Quiz du Système.'");
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
        Schema::dropIfExists('quiz_type_questions');
    }
}
