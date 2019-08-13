<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMochilasTable.
 */
class CreateMochilasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mochilas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_personagem');
            $table->integer('id_item');
            $table->integer('status')->default(0); //0=bag 1 a 14 slot personagem
            $table->integer('id_grau')->default(1);

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
		Schema::drop('mochilas');
	}
}
