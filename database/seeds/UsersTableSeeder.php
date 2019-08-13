<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 =>
                array(
                    'name'      => 'Uerley Cerqueira',
                    'email'     => 'uell12@hotmail.com',
                    'password'  => bcrypt('123456'),
                    'sexo'      => 'M',
                    'tipo'      => 99, //Admin
                    'cash'      => 999999999,
                    'ip'        => 'localhost',
                    'conta'     => 'admin',
                ),
        ));

        $this->command->info('Users Incluidos com sucesso...');
    }
}
