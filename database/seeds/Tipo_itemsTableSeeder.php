<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tipo_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_items')->delete();
        /**
         * Tipo codigo
         * 1=arma
         * 2=armadura
         * 3=acessorio
         * 4=consumo
         * 5=quest
         * 6=outro
         *
         * Slot
         * 0=duas maos
         * 1=mao direita
         * 2=mao esquerda
         * 3= capacete
         * 4=armadura
         * 5=luva
         * 6= bota
         * 7=capa/asa
         * 8=colar
         * 9=brinco d
         * 10= brinco e
         * 11=anel d
         * 12=anel e
         */

        DB::table('tipo_items')->insert(array(
            0 =>
                array(
                    'cod_tipo_item' => '0',
                    'nome' => 'mochila',
                    'status' => '1',
                    'slot' => '0',
                ),
            1 =>
                array(
                    'cod_tipo_item' => '1',
                    'nome' => 'arma D',
                    'status' => '1',
                    'slot' => '1',
                ),
            2 =>
                array(
                    'cod_tipo_item' => '1',
                    'nome' => 'arma E',
                    'status' => '1',
                    'slot' => '2',
                ),
            3 =>
                array(
                    'cod_tipo_item' => '2',
                    'nome' => 'elmo',
                    'status' => '1',
                    'slot' => '3',
                ),
            4 =>
                array(
                    'cod_tipo_item' => '2',
                    'nome' => 'armadura',
                    'status' => '1',
                    'slot' => '4',
                ),
            5 =>
                array(
                    'cod_tipo_item' => '2',
                    'nome' => 'calca',
                    'status' => '1',
                    'slot' => '5',
                ),
            6 =>
                array(
                    'cod_tipo_item' => '2',
                    'nome' => 'luva',
                    'status' => '1',
                    'slot' => '6',
                ),
            7 =>
                array(
                    'cod_tipo_item' => '2',
                    'nome' => 'bota',
                    'status' => '1',
                    'slot' => '7',
                ),
            8 =>
                array(
                    'cod_tipo_item' => '2',
                    'nome' => 'capa/asa',
                    'status' => '1',
                    'slot' => '8',
                ),
            9 =>
                array(
                    'cod_tipo_item' => '3',
                    'nome' => 'colar',
                    'status' => '1',
                    'slot' => '9',
                ),
            10 =>
                array(
                    'cod_tipo_item' => '3',
                    'nome' => 'brinco D',
                    'status' => '1',
                    'slot' => '10',
                ),
            11 =>
                array(
                    'cod_tipo_item' => '3',
                    'nome' => 'brinco E',
                    'status' => '1',
                    'slot' => '11',
                ),
            12 =>
                array(
                    'cod_tipo_item' => '3',
                    'nome' => 'anel D',
                    'status' => '1',
                    'slot' => '12',
                ),
            13 =>
                array(
                    'cod_tipo_item' => '3',
                    'nome' => 'anel E',
                    'status' => '1',
                    'slot' => '13',
                ),
            14 =>
                array(
                    'cod_tipo_item' => '4',
                    'nome' => 'pet',
                    'status' => '1',
                    'slot' => '14',
                ),
            15 =>
                array(
                    'cod_tipo_item' => '5',
                    'nome' => 'buff',
                    'status' => '1',
                    'slot' => '15',
                ),


        ));


        $this->command->info('Tipo_Itens Incluidas com sucesso...');

    }
}
