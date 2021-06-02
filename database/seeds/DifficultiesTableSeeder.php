<?php

use Illuminate\Database\Seeder;

class DifficultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $difficulties = [
            'Snadné',
            'Střední',
            'Obtížné',
        ];

        foreach ($difficulties as $difficulty)
        {
            DB::table('difficulties')->insert([
                'name' => $difficulty,
            ]);
        }
    }
}
