<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $comments = [];

        for ($i = 0; $i < 20; $i++) {
            $comments[rand(\DB::table('users')->min('id'), \DB::table('users')->max('id'))]
                = rand(\DB::table('recipes')->min('id'), \DB::table('recipes')->max('id'));
        }

        foreach ($comments as $user => $recipe) {
            DB::table('comments')->insert([
                'user_id' => $user,
                'recipe_id' => $recipe,
                'body' => $faker->paragraph,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ]);
        }


        for ($i = 0; $i < 40; $i++) {
            DB::table('comments')->insert([
                'user_id' => rand(\DB::table('users')->min('id'), \DB::table('users')->max('id')),
                'recipe_id' => rand(\DB::table('recipes')->min('id'), \DB::table('recipes')->max('id')),
                'body' => $faker->paragraph,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ]);
        }

    }
}
