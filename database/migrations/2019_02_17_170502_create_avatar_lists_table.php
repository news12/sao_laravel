<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAvatarListsTable.
 */
class CreateAvatarListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatar_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_avatar');
            $table->integer('numero_avatar');
            $table->integer('tipo')->default(0);//0=free 1=vip 2=evento 3=outro
            $table->integer('status')->default(0);//0=disponivel 1=indisponivel
            $table->unique('id_avatar,numero_avatar', 'unique_img');

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
        Schema::drop('avatar_lists');
    }
}
