<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuildsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guilds')->delete();

        DB::table('guilds')->insert(array(
            0 =>
                array(
                    'guild'      => 'Nenhuma',
                    'sigla'     => '-',
                    'cols'      => 0,
                    'descricao'      => 'Sem guild',
                ),
            1 =>
                array(
                    'guild'      => 'Equipe News Games',
                    'sigla'     => 'ENG',
                    'cols'      => 999999999,
                    'descricao'      => 'Staff de Sword Art Online NG',
                ),
        ));

        $this->command->info('Guilds Incluidas com sucesso...');
    }
}
