<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMapasTable.
 */
class CreateMapasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mapas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_andar')->default(1);
            $table->string('nome');
            $table->integer('level')->default(1);
            $table->integer('id_mini_boss')->default(0);
            $table->integer('status_mini_boss')->default(0);//0=vivo 1=morto
            $table->integer('boss_kill')->default(0);

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
		Schema::drop('mapas');
	}
}
