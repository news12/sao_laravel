<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_skill')->default(0);
            $table->integer('dano_fisico')->default(0);
            $table->integer('dano_magico')->default(0);
            $table->integer('dano_evoc')->default(0);
            $table->integer('critico')->default(0);
            $table->integer('esquiva')->default(0);
            $table->integer('bloqueio')->default(0);
            $table->integer('defesa')->default(0);
            $table->integer('resistencia')->default(0);
            $table->integer('hp')->default(0);
            $table->integer('cura')->default(0);
            $table->integer('reqlevel')->default(0);
            $table->integer('reqmissao')->default(0);
            $table->integer('reqboss')->default(0);
            $table->integer('reqguild')->default(0);
            $table->string('expira')->default('nao');
            $table->integer('reqevento')->default(0);
            $table->timestamp('inicio')->nullable();
            $table->timestamp('fim')->nullable();


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
        Schema::dropIfExists('skill_status');
    }
}
