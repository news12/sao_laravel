<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonagemSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagem_skill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_skill')->default(1);
            $table->integer('id_personagem');
            $table->unique(['id_skill', 'id_personagem']);
            $table->integer('status')->default(0); //0 inativo 1 ativo obs: skills ativo serão usadas em batalha
            //pode ativar um máximo de 7 habilidades do personagem para uso em combate
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
        Schema::dropIfExists('personagem_skill');
    }
}
