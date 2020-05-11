<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizReponseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'quiz_reponse_user';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quiz_question_user_id')->nullable()->comment('référence (combinée) de l utilisateur et de la question');
            $table->foreign('quiz_question_user_id')->references('id')->on('quiz_question_user')->onDelete('set null');

            $table->string('reponse')->comment('Réponse donnée par l utilisateur');
            $table->boolean('is_valide')->default(false)->comment('Indique si la Réponse de Quiz est valide ou pas');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Réponse à une question de Quiz donnée par un utilisateur.'");
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
        Schema::table('quiz_reponse_user', function (Blueprint $table) {
            $table->dropForeign(['quiz_question_user_id']);
        });
        Schema::dropIfExists('quiz_reponse_user');
    }
}
