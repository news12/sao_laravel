<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDrops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_drops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cod_drop');
            $table->unique('cod_drop', 'unique_cod_drop');
            $table->string('nome',155);
            $table->unique('nome', 'unique_drop_nome');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('tipo_drops');
    }
}
