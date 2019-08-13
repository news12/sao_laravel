<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEquipesTable.
 */
class CreateEquipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('min_membros')->default(2);
            $table->integer('max_membros')->default(7);
            $table->string('nome', 100);
            $table->unique('nome', 'unique_equipe_nome');
            $table->string('sigla');
            $table->integer('id_lider');
            $table->integer('level')->default(1);
            $table->integer('exp')->default(1);
            $table->integer('pontos')->default(1);
            $table->integer('level_min')->nullable();
            $table->integer('level_max')->nullable();

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
        Schema::drop('equipes');
    }
}
