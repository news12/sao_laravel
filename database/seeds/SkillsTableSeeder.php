<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->delete();

        DB::table('skills')->insert(array(
            0 =>
                array(
                    'nome' => 'Golpe Normal',
                    'descricao' => 'Avança em direção ao oponente causando dano com seus punhos ou arma',
                    'id_classe' => '99',
                    'level' => '1',
                ),
            1 =>
                array(
                    'nome' => 'Investida Primaria',
                    'descricao' => 'Uma investida com os pés que causa dano ao seu oponente',
                    'id_classe' => '2',
                    'level' => '1',
                ),
            2 =>
                array(
                    'nome' => 'Recuperar',
                    'descricao' => 'Recupera uma % da vida atual perdida',
                    'id_classe' => '99',
                    'level' => '20',
                ),
            3 =>
                array(
                    'nome' => 'Defesa',
                    'descricao' => 'Entra em estado defensivo reduzindo o dano causado pelo prómixo ataque do oponente',
                    'id_classe' => '1',
                    'level' => '1',
                ),


        ));


        $this->command->info('skills Incluidas com sucesso...');


    }
}
