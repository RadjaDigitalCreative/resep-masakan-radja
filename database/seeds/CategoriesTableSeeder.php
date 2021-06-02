<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Předkrmy',
            'Polévky',
            'Přílohy',
            'Sendviče',
            'Saláty',
            'Maso',
            'Vege',
            'Sladké',
            'Nápoje',
        ];

        foreach ($categories as $category)
        {
            DB::table('categories')->insert([
                'name' => $category,
                'slug' => str_slug($category),
                'color' => '',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ]);
        }
    }
}
