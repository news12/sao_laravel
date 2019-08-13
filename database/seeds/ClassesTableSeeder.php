<?php

use App\Entities\Classe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->delete();
        /**
         * 1 = Noob
         * 2= Espadachim
         * 3= Domador
         * 4= Paladino
         */

        DB::table('classes')->insert(array(
            0 =>
                array(
                    'classe' => 'Noob',
                    'inteligencia' => '1',
                    'forca' => '1',
                    'defesa' => '1',
                    'resistencia' => '1',
                    'level' => '1',
                    'status' => '1',
                ),
            1 =>
                array(
                    'classe' => 'Espadachim',
                    'inteligencia' => '5',
                    'forca' => '10',
                    'defesa' => '2',
                    'resistencia' => '2',
                    'level' => '1',
                    'status' => '1',
                ),
            2 =>
                array(
                    'classe' => 'Domador',
                    'inteligencia' => '10',
                    'forca' => '2',
                    'defesa' => '5',
                    'resistencia' => '5',
                    'level' => '1',
                    'status' => '1',
                ),
           3 =>
                array(
                    'classe' => 'Paladino',
                    'inteligencia' => '3',
                    'forca' => '3',
                    'defesa' => '10',
                    'resistencia' => '10',
                    'level' => '1',
                    'status' => '1',
                ),


        ));


        $this->command->info('Classes Incluidas com sucesso...');
    }
}
