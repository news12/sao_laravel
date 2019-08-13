<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaxAtributosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('max_atributos')->delete();

        DB::table('max_atributos')->insert(array(
            0 =>
                array(
                    'id'      => 1,
                ),
        ));

        $this->command->info('Max Atributos Incluidos com sucesso...');
    }
}
