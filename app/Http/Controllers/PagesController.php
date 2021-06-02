<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Category;
use App\Ingredient;
use Illuminate\Http\Request;
use DB;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application home page.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        $favourites = $this->favourtieRecipes(10)->shuffle()->take(4);
        $fresh = Recipe::orderBy('created_at', 'desc')->limit(10)->get()->shuffle()->take(4);
        $recipes = Recipe::all();

        return view('home', compact('ingredients', 'favourites', 'fresh', 'recipes'));
    }

    public function search(Request $request)
    {
        $ingredients = Ingredient::all();
        $recipes = Recipe::all();
        $favourites = $this->favourtieRecipes(10)->shuffle()->take(4);
        $fresh = Recipe::orderBy('created_at', 'desc')->limit(10)->get()->shuffle()->take(4);
        
        $cari = $request->recipes;
        $count = count($request->recipes);
        for ($i=0; $i < $count ; $i++) { 
            $hasil[$i] = DB::table('recipes')
            ->where('title','like',"%".$cari[$i]."%")
            ->get();
        }
        $teling = $hasil;
        // return response()->json($hasil);
        return view('search', compact('teling', 'count', 'ingredients', 'favourites', 'fresh', 'recipes'));
    }

    public function search2(Request $request)
    {
        $ingredients = Ingredient::all();
        $recipes = Recipe::all();
        $favourites = $this->favourtieRecipes(10)->shuffle()->take(4);
        $fresh = Recipe::orderBy('created_at', 'desc')->limit(10)->get()->shuffle()->take(4);
        
        $cari = $request->recipes;
        $count = count($request->recipes);
        for ($i=0; $i < $count ; $i++) { 
            $hasil[$i] = DB::table('recipes')
            ->where('title','like',"%".$cari[$i]."%")
            ->get();
        }
        $teling = $hasil;

        $cari2 = $request->ingredients;
        $count2 = count($request->ingredients);
        for ($i=0; $i < $count2 ; $i++) { 
            $hasil2[$i] = DB::table('ingredients')
            ->join('ingredient_recipe', 'ingredients.id', '=', 'ingredient_recipe.ingredient_id')
            ->join('recipes', 'recipes.id', '=', 'ingredient_recipe.recipe_id')
            ->where('name','like',"%".$cari2[$i]."%")
            ->select('recipes.title', 'recipes.slug', 'recipes.thumbnail','ingredients.name')
            ->get();
        }
        $teling2 = $hasil2;
        // return response()->json($teling2);
        return view('search', compact('teling2', 'teling', 'count', 'ingredients', 'favourites', 'fresh', 'recipes'));
    }
    public function search3(Request $request)
    {
        $ingredients = Ingredient::all();
        $recipes = Recipe::all();
        $favourites = $this->favourtieRecipes(10)->shuffle()->take(4);
        $fresh = Recipe::orderBy('created_at', 'desc')->limit(10)->get()->shuffle()->take(4);
        
        $cari = $request->recipes;
        $count = count($request->recipes);
        for ($i=0; $i < $count ; $i++) { 
            $hasil[$i] = DB::table('recipes')
            ->where('title','like',"%".$cari[$i]."%")
            ->get();
        }
        $teling = $hasil;

        $cari2 = $request->ingredients;
        $count2 = count($request->ingredients);
        for ($i=0; $i < $count2 ; $i++) { 
            $hasil2[$i] = DB::table('ingredients')
            ->join('ingredient_recipe', 'ingredients.id', '=', 'ingredient_recipe.ingredient_id')
            ->join('recipes', 'recipes.id', '=', 'ingredient_recipe.recipe_id')
            ->where('name','like',"%".$cari2[$i]."%")
            ->select('recipes.title', 'recipes.slug', 'recipes.thumbnail','ingredients.name')
            ->get();
        }
        $teling2 = $hasil2;
        // return response()->json($teling2);
        return view('search2', compact('teling2', 'teling', 'count', 'ingredients', 'favourites', 'fresh', 'recipes'));
    }


    public function recipes()
    {
        $recipes = Recipe::orderedPagination('created_at', 12);

        return view('pages.recipes', compact('recipes'));
    }

    /**
     * Show categories and recipes from selected category (or all).
     * @return \Illuminate\Http\Response
     */
    public function categories(Category $category = null)
    {
        if ($category->id) {
            $selectedCategory = $category->name;
            $recipes = Recipe::whereIn('id', $category->recipes->pluck('id')->toArray())
            ->orderedPagination('created_at', 14);
        } else {
            $recipes = Recipe::orderedPagination('created_at', 14);
        }

        $categories = Category::orderBy('name')->get();

        return view('pages.categories', compact('recipes', 'categories', 'selectedCategory'));
    }

    /**
     * Show the recipes with best rankings.
     * @return \Illuminate\Http\Response
     */
    public function rankings()
    {
        $favourites = $this->favourtieRecipes(4);

        $discussed = Recipe::leftJoin('comments', 'recipes.id', '=', 'comments.recipe_id')
        ->groupBy('recipes.id')
        ->orderBy('comments_count','desc')
        ->selectRaw('recipes.*, count(recipes.id) AS comments_count')
        ->limit(4)->get();

        return view('pages.rankings', compact('favourites', 'discussed'));
    }


    /**
     * Get most favourites recipes.
     * @param int $limit
     * @return \Illuminate\Http\Response
     */
    private function favourtieRecipes($limit = 4)
    {
        $favourites = Recipe::where(\DB::raw('MONTH(created_at)'), '=', date('n'))
        ->with('likeCounter')->get();

        return $favourites->sortByDesc(function($recipe) {
            return $recipe->likeCount;
        })->take($limit);
    }

}
