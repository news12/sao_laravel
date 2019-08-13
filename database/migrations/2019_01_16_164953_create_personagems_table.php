<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePersonagemsTable.
 */
class CreatePersonagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('treinos_concluidos')->default(0);
            $table->enum('status', ['banido', 'bloqueado', 'liberado'])->default('liberado');
            $table->integer('id_equipe')->default(0);
            $table->integer('id_guild')->unsigned()->default(1);
            $table->timestamp('ultima_atualizacao')->nullable();
            $table->integer('conta')->unsigned();
            $table->timestamp('tempo_vip')->nullable();
            $table->timestamp('tempoTratamentoVip')->nullable();
            $table->timestamp('tempoExpEstra')->nullable();
            $table->integer('vipExp')->nullable();
            $table->string('referencia', 255)->nullable();
            $table->string('nome', 10);
            $table->unique('nome', 'unique_nome');
            $table->integer('id_avatar')->unsigned();
            $table->integer('img_avatar')->default(1);
            $table->enum('classificacao', ['1', '2', '3', '4', '5']);
            $table->integer('id_andar')->default(1);
            $table->integer('mapa')->unsigned()->default(1);
            $table->integer('x')->unsigned()->default(1);
            $table->integer('y')->unsigned()->default(1);
            $table->integer('id_classe')->unsigned()->default(1);
            $table->integer('cidade')->unsigned()->default(1);
            $table->integer('ponto_atributo')->default(0);
            $table->decimal('cols', '15', '2')->default(700);
            $table->integer('_ticket')->default(0);
            $table->integer('level')->unsigned()->default(1);
            $table->integer('vida')->default(100);
            $table->integer('vida_m')->default(100);
            $table->integer('energia')->default(100);
            $table->integer('energia_m')->default(100);
            $table->integer('eng')->default(0);
            $table->integer('exp')->default(0);
            $table->integer('forca')->default(1);
            $table->integer('agilidade')->default(1);
            $table->integer('inteligencia')->default(1);
            $table->integer('resistencia')->default(10);
            $table->integer('vitalidade')->default(1);
            $table->integer('espada')->default(1);
            $table->integer('magia')->default(1);
            $table->integer('evoc')->default(1);
            $table->integer('ponto')->default(0);
            $table->integer('vitoria_pvm')->default(0);
            $table->integer('vitoria_pvp')->default(0);
            $table->integer('derrota_pvm')->default(0);
            $table->integer('derrota_pvp')->default(0);
            $table->integer('fuga_pvm')->default(0);
            $table->integer('fuga_pvp')->default(0);
            $table->integer('empate')->default(0);
            $table->integer('ponto_tecnica')->default(0);
            $table->integer('ponto_tacnica_usado')->default(0);
            $table->integer('rank_D')->default(0);
            $table->integer('rank_C')->default(0);
            $table->integer('rank_B')->default(0);
            $table->integer('rank_A')->default(0);
            $table->integer('rank_S')->default(0);
            $table->integer('treino_restante')->default(0);
            $table->integer('ativo')->default(1);
            $table->integer('defesa')->default('10');
            $table->integer('max_mochila')->default(40);
            $table->integer('max_vip_mochila')->default(0);
            $table->integer('vida_combat')->virtualAs('((vitalidade*10) +vida)');
            $table->integer('vida_m_combat')->virtualAs('((vitalidade*10) +vida_m)');
            $table->float('poder_fisico')->virtualAs('(((forca*4) +(agilidade*3) +(espada*5)) /2)');
            $table->float('poder_magico')->virtualAs('(((inteligencia*4) +(agilidade*3) +(magia*5)) /2)');
            $table->float('poder_evocacao')->virtualAs('((((inteligencia+forca)*2) +(agilidade*3) +(evoc*5)) /2)');
            $table->float('esquiva')->virtualAs('((((inteligencia+forca)/8) +(agilidade*2) +((espada+magia+evoc)/20))/100)');
            $table->float('critico')->virtualAs('((((inteligencia+forca)/4) +(agilidade*2) +((espada+magia+evoc)/10))/100)');
            $table->float('bloqueio')->virtualAs('(((defesa+resistencia) )/100)');

            $table->timestamps();
        });

        Schema::table('personagems', function (Blueprint $table) {
            $table->foreign('id_guild')
                ->references('id')->on('guilds');
            $table->foreign('conta')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('id_avatar')
                ->references('id')->on('avatars');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personagems');
    }
}
