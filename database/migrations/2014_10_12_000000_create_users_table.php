<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'users';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->unsignedBigInteger('personne_id')->nullable()->comment('référence de la personne');
            $table->foreign('personne_id')->references('id')->on('personnes')->onDelete('set null');

            $table->boolean('statut')->is_default(false)->comment('Statut du compte de l utilisateur');
            $table->boolean('etat')->is_default(false)->comment('Etat du compte de l utilisateur');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Comptes utilisateur du Système.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
