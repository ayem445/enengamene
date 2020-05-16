<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAstucesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'astuces';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('libelle')->comment('libelle de l astuce');
            $table->string('details')->comment('détails de l astuce');
            $table->integer('num_ordre')->nullable()->comment('numéro d ordre de l astuce');

            $table->unsignedBigInteger('quiz_question_id')->nullable()->comment('référence de la question de Quiz');
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions')->onDelete('set null');

            $table->boolean('statut')->default(false)->comment('Statut de l astuce');
            $table->boolean('etat')->default(false)->comment('Etat de l astuce');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Astuces pouvant être utilisés dans les questions de Quiz.'");
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
        Schema::table('astuces', function (Blueprint $table) {
            $table->dropForeign(['quiz_question_id']);
        });
        Schema::dropIfExists('astuces');
    }
}
