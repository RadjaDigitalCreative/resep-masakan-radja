<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(SpicesTableSeeder::class);
        $this->call(DifficultiesTableSeeder::class);
        $this->call(DurationsTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);

        // Prepare relations
        $category_recipe = [];
        for ($i = 0; $i < 20; $i++)
            $category_recipe[rand(\DB::table('categories')->min('id'), \DB::table('categories')->max('id'))]
                = rand(\DB::table('recipes')->min('id'), \DB::table('recipes')->max('id'));

        $ingredient_recipe = [];
        for ($i = 0; $i < 40; $i++)
            $ingredient_recipe[rand(\DB::table('ingredients')->min('id'), \DB::table('ingredients')->max('id'))]
                = rand(\DB::table('recipes')->min('id'), \DB::table('recipes')->max('id'));

        $recipe_spice = [];
        for ($i = 0; $i < 30; $i++)
            $recipe_spice[rand(\DB::table('recipes')->min('id'), \DB::table('recipes')->max('id'))]
                = rand(\DB::table('spices')->min('id'), \DB::table('spices')->max('id'));


        // Fill the pivot tables
        foreach ($category_recipe as $category => $recipe) {
            DB::table('category_recipe')->insert([
                'category_id' => $category,
                'recipe_id' => $recipe,
            ]);
        }
        foreach ($ingredient_recipe as $ingredient => $recipe) {
            DB::table('ingredient_recipe')->insert([
                'ingredient_id' => $ingredient,
                'recipe_id' => $recipe,
            ]);
        }
        foreach ($recipe_spice as $recipe => $spice) {
            DB::table('recipe_spice')->insert([
                'recipe_id' => $recipe,
                'spice_id' => $spice,
            ]);
        }
        /**/

    }

}
