<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AvatarsTableSeeder::class,
            ClassesTableSeeder::class,
            GuildsTableSeeder::class,
            LevelsTableSeeder::class,
            AndarsTableSeeder::class,
            Tipo_itemsTableSeeder::class,
            Tipo_dropsTableSeeder::class,
            Grau_itemsTableSeeder::class,
            SkillsTableSeeder::class,
        ]);
    }
}
