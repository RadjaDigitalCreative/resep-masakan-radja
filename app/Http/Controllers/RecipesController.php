<?php

namespace App\Http\Controllers;

use App\Spice;
use App\Recipe;
use App\Comment;
use App\Category;
use App\Ingredient;
use App\Models\Duration;
use App\Models\Difficulty;
use App\Http\Requests\RecipeRequest;
use Illuminate\Support\Facades\Auth;

class RecipesController extends Controller
{
    /**
     * Create a new RecipesController instance and set middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('verified')->except('show', 'like', 'userLikes');
    }

    /**
     * Display a recipe detail page.
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $comments = Comment::where('recipe_id', $recipe->id)->latest('updated_at')
                            ->paginate(5, ['*'], 'komentare');

        return view('recipes.show', compact('recipe', 'comments'));
    }

    /**
     * Show the form for creating a new recipe.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create', $this->getDependencies());
    }

    /**
     * Show the form for editing the recipe.
     * @return \Illuminate\Http\Response
     */
    public function edit($recipe)
    {
        session()->flash('backUrl', \URL::previous());

        if (Auth::user()->canEditRecipe($recipe))
            return view('recipes.edit', array_merge(compact('recipe'), $this->getDependencies()));
        else
            return redirect()->route('recipes.auth');
    }

    /**
     * List all recipes from logged user.
     * @return \Illuminate\Http\Response
     */
    public function userRecipes()
    {
        $recipes = Recipe::where('user_id', Auth::id())->orderedPagination('updated_at', 20);

        return view('recipes.list', compact('recipes'));
    }

    /**
     * List all favourite recipes from logged user.
     * @return \Illuminate\Http\Response
     */
    public function userLikes()
    {
        $recipes = Recipe::whereLikedBy(Auth::id())->orderedPagination('updated_at', 12);

        return view('auth.favourites', compact('recipes'));
    }


    private function getDependencies()
    {
        $categories = Category::pluck('name', 'id');  // returns [id => 'name', ...]
        $ingredients = Ingredient::pluck('name', 'id');
        $spices = Spice::pluck('name', 'id');
        $difficulties = Difficulty::orderBy('id')->pluck('name', 'id');
        $durations = Duration::orderBy('id')->pluck('name', 'id');

        return compact('categories', 'ingredients', 'spices', 'difficulties', 'durations');
    }

    /**
     * Validate and save a new recipe.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeRequest $request)
    {
        $recipe = Auth::user()->recipes()->create($request->all());
        $recipe->syncAndSave($request);

        event(new \App\Events\RecipeAdded($recipe));
        flash(__('recipes.created'));

        return redirect()->route('recipes.auth');
    }

    /**
     * Validate and update an existing recipe.
     * @param  \App\Recipe  $recipe
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe, RecipeRequest $request)
    {
        $recipe->fill($request->all());
        $recipe->syncAndSave($request);

        flash(__('recipes.updated'));

        $url = session()->get('backUrl');
        return $url ? redirect($url) : redirect()->route('recipes.auth');
    }

    /**
     * Remove the specified recipe.
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        if (Auth::user()->canEditRecipe($recipe)) {
            $recipe->delete();

            flash(__('recipes.deleted'));
        }
        $url = session()->get('backUrl');
        return $url ? redirect($url) : redirect()->route('recipes.auth');
    }
    /**
     * Bring the recipe back to life.
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function restore(Recipe $recipe)
    {
        if (Auth::user()->canEditRecipe($recipe)) {
            $recipe->restore();

            flash(__('recipes.restored'));
        }
        $url = session()->get('backUrl');
        return $url ? redirect($url) : redirect()->route('recipes.auth');
    }

    /**
     * Toggle the "liked by logged user" property on the recipe.
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function like(Recipe $recipe)
    {
        if ($recipe->liked()){
            $recipe->unlike();
        } else {
            $recipe->like();
            event(new \App\Events\RecipeLiked($recipe));
        }

        return redirect()->back();
    }

}
