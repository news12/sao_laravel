<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvatarsTableSeeder extends Seeder
{
    /**
     */
    public function run()
    {
        DB::table('avatars')->delete();
        /**1, 'Kirito', 0, 'Protagonista do anime,<br>vencou o jogo, <br>conhecido como Beater'
         * 2, 'Asuna', 0, 'Protagonista do anime, <br>Namorada do Kirito,<br> Fazia parte da linha de frente'
         * 3, 'Leafa', 0, 'Protagonista no ALO,<br> irmã/prima do Kirito'
         * 4, 'Heathcliff', 0, 'O mais forte da primeira temporada,<br> GM do jogo'
         * 5, 'Klein', 0, 'Primeiro amigo do Kirito no anime,<br> fazia parte da linha de frente'
         * 6, 'Lizbeth', 0, 'Ferreira com habilidades de luta'
         * 7, 'Egil', 0, 'Vendedor com habilidades de luta'
         * 8, 'Silica', 0, 'Principal evocadora do anime.'
         * 9, 'Yui', 0, 'AI(Artificial Intelligence),<br>filha do Kirito e da Asuna,<br>Sitema de Ajuda'
         * 10, 'Kuradeel', 0, 'Um dos Vilões do anime,<br> Fazia parte da Caixão Sorridente,<br> fazia parte da linha de frente'
         */
        DB::table('avatars')->insert(array(
            0 =>
                array(
                    'id' => '1',
                    'avatar' => 'Kirito',
                    'descricao' => /** @lang text */
                        'Protagonista do anime,<br>venceu o jogo, <br>conhecido como Beater',

                ),
            1 =>
                array(
                    'id' => '2',
                    'avatar' => 'Asuna',
                    'descricao' => /** @lang text */
                        'Protagonista do anime, <br>Namorada do Kirito,<br> Fazia parte da linha de frente',
                ),
            2 =>
                array(
                    'id' => '3',
                    'avatar' => 'Leafa',
                    'descricao' => /** @lang text */
                        'Protagonista no ALO,<br> irmã/prima do Kirito',
                ),
            3 =>
                array(
                    'id' => '4',
                    'avatar' => 'Heathcliff',
                    'descricao' => /** @lang text */
                        'O mais forte da primeira temporada,<br> GM do jogo',
                ),
            4 =>
                array(
                    'id' => '5',
                    'avatar' => 'Klein',
                    'descricao' => /** @lang text */
                        'Primeiro amigo do Kirito no anime,<br> fazia parte da linha de frente',
                ),
            5 =>
                array(
                    'id' => '6',
                    'avatar' => 'Lizbeth',
                    'descricao' => /** @lang text */
                        'Ferreira com habilidades de luta',
                ),
            6 =>
                array(
                    'id' => '7',
                    'avatar' => 'Egil',
                    'descricao' => /** @lang text */
                        'Vendedor com habilidades de luta',
                ),
            7 =>
                array(
                    'id' => '8',
                    'avatar' => 'Silica',
                    'descricao' => /** @lang text */
                        'Principal evocadora do anime.',
                ),
            8 =>
                array(
                    'id' => '9',
                    'avatar' => 'Yui',
                    'descricao' => /** @lang text */
                        'AI(Artificial Intelligence),<br>filha do Kirito e da Asuna,<br>Sitema de Ajuda',
                ),
            9 =>
                array(
                    'id' => '10',
                    'avatar' => 'Kuradeel',
                    'descricao' => /** @lang text */
                        'Um dos Vilões do anime,<br> Fazia parte da Caixão Sorridente,<br> fazia parte da linha de frente',
                ),


        ));


        $this->command->info('Avatars Incluidas com sucesso...');
    }
}
