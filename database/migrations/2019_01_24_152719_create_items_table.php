<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateItemsTable.
 */
class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 155)->default('sem nome');
            $table->unique('nome', 'unique_item_nome');
            $table->string('descricao')->default('sem descricao');
            $table->integer('level')->default(1);
            $table->integer('id_classe')->nullable();
            $table->integer('for')->nullable();
            $table->integer('int')->nullable();
            $table->integer('agi')->nullable();
            $table->integer('def')->nullable();
            $table->integer('res')->nullable();
            $table->integer('esp')->nullable();
            $table->integer('evo')->nullable();
            $table->integer('mag')->nullable();
            $table->integer('energia')->nullable();
            $table->integer('vida')->nullable();
            $table->decimal('cols', 15, 2)->nullable();
            $table->integer('extra')->nullable();
            $table->decimal('cash', 15, 2)->nullable();
            $table->integer('quest')->default(0);
            $table->integer('vinculado')->default(0); //0=não 1=sim
            $table->integer('temporario')->default(0); //0=não 1=sim
            $table->timestamp('data_inicio')->nullable();
            $table->timestamp('data_fim')->nullable();
            $table->integer('id_tipo_drop')->default(1); // 1=drop 2=npc 3=evento 4=outro
            $table->integer('id_tipo_item')->default(1);// 1=arma 2=armadura 3=consumo 4=quest 5=outro
            $table->integer('id_grau_item')->default(1);// 1=comum 2=superior 3=raro 4=supremo 5=lendario
            $table->integer('id_avatar')->default(1);
            $table->float('poder_fisico')->virtualAs('(((`for`*4) +(agi*3) +(esp*5)) /2)');
            $table->float('poder_magico')->virtualAs('(((`int`*4) +(agi*3) +(mag*5)) /2)');
            $table->float('poder_evocacao')->virtualAs('((((`int`+`for`)*2) +(agi*3) +(evo*5)) /2)');
            $table->float('esquiva')->virtualAs('((((`int`+`for`)/8) +(agi*2) +((esp+mag+evo)/20))/100)');
            $table->float('critico')->virtualAs('((((`int`+`for`)/4) +(agi*2) +((esp+mag+evo)/10))/100)');
            $table->float('bloqueio')->virtualAs('(((def+res) )/100)');
            $table->float('poder')->virtualAs('((((`for`*4)+(agi*3)+(esp*5))/2)+(((`int`*4)+(agi*3)+(mag*5))/2)+((((`int`+`for`)*2)+(agi*3)+(evo*5))/2)+((((`int`+`for`)/8)+(agi*2)+((esp+mag+evo)/20))/100)+((def+res)/100)+((((`int`+`for`)/4)+(agi*2)+((esp+mag+evo)/10))/100)+((res+def+vida)*2))');

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
        Schema::drop('items');
    }
}
