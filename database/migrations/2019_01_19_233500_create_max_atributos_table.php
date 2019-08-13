<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMaxAtributosTable.
 */
class CreateMaxAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('max_atributos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('max_for')->default('10000');
            $table->integer('max_int')->default('10000');
            $table->integer('max_agi')->default('8000');
            $table->integer('max_def')->default('30000');
            $table->integer('max_res')->default('30000');
            $table->integer('max_dan')->default('90000');
            $table->integer('max_hp')->default('100000');
            $table->integer('max_ene')->default('10000');
            $table->decimal('max_cols', 15, 2)->default('999999999');
            $table->integer('max_level')->default('100');
            $table->integer('max_guild_member')->default('100');
            $table->integer('max_guilds')->default('500');
            $table->integer('max_player')->default('2000');
            $table->integer('max_quest')->default('999');
            $table->integer('max_vit')->default('1000');
            $table->integer('max_esp')->default('3000');
            $table->integer('max_mag')->default('3000');
            $table->integer('max_evo')->default('3000');
            $table->decimal('max_cash', 15, 2)->default('50000');
            $table->integer('max_slot')->default('50'); //+12 slot do personagem total de 32
            $table->integer('max_slot_vip')->default('40');
            $table->integer('max_avatar')->default(4); //maximo de personagens por conta free
            $table->integer('max_avatar_vip')->default(4); //maximo de perssonagens adcional para conta vip ex: free + vip

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
        Schema::drop('max_atributos');
    }
}
