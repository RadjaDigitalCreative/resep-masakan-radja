<?php

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            'Rajče',
            'Paprika',
            'Cibule',
            'Česnek',
            'Okurek',
            'Lilek',
            'Cuketa',
            'Dýně',
            'Mrkev',
            'Řepa',
            'Celer',
            'Zelí',
            'Fazole',
            'Fazolky',
            'Hrášek',
            'Sója',
            'Vejce',
            'Sýr',
            'Mléko',
            'Máslo',
            'Smetana',
            'Tvaroh',
            'Mouka',
            'Cukr',
            'Kakao',
            'Čokoláda',
            'Šunka',
            'Slanina',
            'Kuřecí maso',
            'Hovězí maso',
            'Vepřové maso',
            'Arašídy',
            'Kešu',
            'Mandle',
            'Vlašské ořechy',
            'Lískové oříšky',
            'Jablko',
            'Hruška',
            'Banán',
            'Pomeranč',
            'Mandarinka',
            'Citrón',
            'Limetka',
        ];

        foreach ($ingredients as $ingredient)
        {
            DB::table('ingredients')->insert([
                'name' => $ingredient,
                'slug' => str_slug($ingredient),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ]);
        }
    }
}
