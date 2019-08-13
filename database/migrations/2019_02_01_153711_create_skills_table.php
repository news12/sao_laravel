<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSkillsTable.
 */
class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->integer('id_classe')->default(0); //0=clan 1 a 98 classes do jogo 99 sem restrição
            $table->integer('level')->default(1);
            $table->decimal('cols', 15, 2)->default(0);
            $table->integer('status')->default(0);
            $table->integer('tipo')->default(0);
            $table->string('avatar')->nullable();
            $table->integer('energia')->default(0);
            $table->integer('turnos')->default(0);
            $table->integer('turnos_efeito')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skills');
    }
}
