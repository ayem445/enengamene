<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourNotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'cour_notation';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cour_id')->nullable()->comment('reference du cours');
            $table->foreign('cour_id')->references('id')->on('cours')->onDelete('set null');

            $table->unsignedBigInteger('notation_id')->nullable()->comment('reference de la notation');
            $table->foreign('notation_id')->references('id')->on('notations')->onDelete('set null');

            $table->unsignedBigInteger('user_id')->nullable()->comment('reference du compte (User) ayant effectué la notation');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `$tableName` comment 'Notation d un cours donné.'");
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
        Schema::table('cour_notation', function (Blueprint $table) {
            $table->dropForeign(['cour_id']);
            $table->dropForeign(['notation_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('cour_notation');
    }
}
