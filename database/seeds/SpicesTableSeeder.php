<?php

use Illuminate\Database\Seeder;

class SpicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spices = [
            'Sůl',
            'Pepř',
            'Paprika',
            'Bazalka',
            'Majoránka',
            'Oregano',
            'Tymián',
            'Rozmarýn',
            'Máta',
        ];

        foreach ($spices as $spice)
        {
            DB::table('spices')->insert([
                'name' => $spice,
                'slug' => str_slug($spice),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ]);
        }
    }
}
