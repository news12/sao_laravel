<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tipo_dropsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_drops')->delete();
        /**
         * 1=drop
         * 2=npc
         * 3=evento
         * 4=outro
         */

        DB::table('tipo_drops')->insert(array(
            0 =>
                array(
                    'cod_drop' => '1',
                    'nome' => 'drop',
                    'status' => '1',
                ),
            1 =>
                array(
                    'cod_drop' => '2',
                    'nome' => 'npc',
                    'status' => '1',
                ),
            2 =>
                array(
                    'cod_drop' => '3',
                    'nome' => 'evento',
                    'status' => '1',
                ),
            3 =>
                array(
                    'cod_drop' => '4',
                    'nome' => 'outros',
                    'status' => '1',
                ),


        ));


        $this->command->info('Tipo Drops Incluidas com sucesso...');

    }
}
