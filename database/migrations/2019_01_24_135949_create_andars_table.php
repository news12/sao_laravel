<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAndarsTable.
 */
class CreateAndarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('andars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('andar');
            $table->unique('andar', 'unique_andar');
            $table->integer('status')->default(0); //0=fechado 1=aberto
            $table->integer('level')->default(1);
            $table->integer('id_conquest')->nullable();
            $table->integer('id_team_conquest')->nullable();
            $table->integer('id_guild_conquest')->nullable();
            $table->integer('id_boss')->default(0);
            $table->integer('boss_vivo')->default(1); //0=morto 1=vivo

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
        Schema::drop('andars');
    }
}
