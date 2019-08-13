<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AndarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('andars')->delete();

        for ($i=1; $i < 101; $i++) {
            DB::table('andars')->insert([
                'andar' => $i,

            ]);
        }
        $this->command->info('Andares Incluidos com sucesso...');

    }
}
