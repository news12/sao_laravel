<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->delete();

        for ($i=1; $i < 100; $i++) {
            DB::table('levels')->insert([
                'level' => $i+1,
                'exp' => $i*100,
                'cols'=>$i *10,
                'energia'=>$i*4/2 ,
                'hp'=> $i*8/2,

            ]);
        }
        $this->command->info('Levels Incluidos com sucesso...');
    }
}
