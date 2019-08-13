<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Grau_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grau_items')->delete();
        /**
         * 1=comum
         * 2=superior
         * 3=raro
         * 4=supremo
         * 5=lendario
         */

        DB::table('grau_items')->insert(array(
            0 =>
                array(
                    'cod_grau' => '1',
                    'nome' => 'comum',
                    'status' => '1',
                ),
            1 =>
                array(
                    'cod_grau' => '2',
                    'nome' => 'superior',
                    'status' => '1',
                ),
            2 =>
                array(
                    'cod_grau' => '3',
                    'nome' => 'raro',
                    'status' => '1',
                ),
            3 =>
                array(
                    'cod_grau' => '4',
                    'nome' => 'supremo',
                    'status' => '1',
                ),
            4 =>
                array(
                    'cod_grau' => '5',
                    'nome' => 'lendario',
                    'status' => '1',
                ),

        ));


        $this->command->info('Grau Itens Incluidas com sucesso...');

    }
}
