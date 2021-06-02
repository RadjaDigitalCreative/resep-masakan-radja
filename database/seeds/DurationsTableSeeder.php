<?php

use Illuminate\Database\Seeder;

class DurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $durations = [
            'Rychle',
            'Středně',
            'Dlouho',
        ];

        foreach ($durations as $duration)
        {
            DB::table('durations')->insert([
                'name' => $duration,
            ]);
        }
    }
}
