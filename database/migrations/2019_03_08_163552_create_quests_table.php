<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateQuestsTable.
 */
class CreateQuestsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quests', function(Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('descricao')->nullable();
            $table->integer('level')->default(1);
            $table->integer('guild')->default(0);
            $table->integer('boss')->default(0);
            $table->integer('status')->default(0);//0 normal 1=guild 2=evento 3=vip
            //campos de recompensa
            $table->decimal('cols',15,2)->default(1);
            $table->integer('exp')->default(50);
            $table->integer('itens')->default(0);//0= sem recompensa de itens  1= recompensa com itens
            $table->integer('andar')->default(0);
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
		Schema::drop('quests');
	}
}
