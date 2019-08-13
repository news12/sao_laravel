<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cod_tipo_item');
            $table->string('nome', 155);
            $table->unique('nome', 'unique_tipo_nome');
            $table->integer('status')->default(0);
            $table->integer('slot')->default(0); // 0=mochila 1=arma 2=escudo 3= elmo 4=armadura
            // 5=calca 6=luva 7= bota 8=capa/asa 9=colar 10=brinco d 11=brinco e 12=anel d 13=anel e 14=pet
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
        Schema::dropIfExists('tipo_items');
    }
}
