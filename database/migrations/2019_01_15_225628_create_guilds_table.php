<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guild', 20);
            $table->unique('guild', 'unique_guild');
            $table->string('sigla', 3);
            $table->integer('id_cidade')->default(1);
            $table->integer('id_mapa')->default(1);
            $table->integer('id_lider')->default(1);
            $table->integer('cap_max')->default(10);
            $table->integer('level')->default(1);
            $table->decimal('cols', 15, 2);
            $table->string('descricao', 255);
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
        Schema::dropIfExists('guilds');
    }
}
