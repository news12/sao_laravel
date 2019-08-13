<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->string('email', 100);
            $table->unique('email', 'unique_email');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('token_access')->nullable();
            $table->string('password');
            $table->string('sexo', '1')->default('-');
            $table->integer('tipo')->default(1);
            $table->decimal('cash', 15, 2)->default(0);
            $table->ipAddress('ip')->nullable();
            $table->integer('tipo_vip')->default(0);//0=free 1=vip prata 2=vip ouro 3=vip diamente
            $table->integer('status')->default(0); //0=normal 1=banido 2=suspenso 3=observação
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
