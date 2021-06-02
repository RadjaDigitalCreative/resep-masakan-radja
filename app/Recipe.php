<?php

namespace App;

use \Conner\Likeable\LikeableTrait;
use App\Http\Requests\RecipeRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Models\TimestampsModel
{
    use LikeableTrait, SoftDeletes;

    /**
     * The user attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'body', 'difficulty_id', 'duration_id', 'video'
    ];

    /**
     * A Recipe has been written by one User.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Recipe has a difficulty level.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function difficulty()
    {
        return $this->belongsTo('App\Models\Difficulty');
    }

    /**
     * Recipe has a preparation time.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function duration()
    {
        return $this->belongsTo('App\Models\Duration');
    }

    /**
     * Every Recipe is made of many ingredients.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient');
    }

    /**
     * Recipe is made of many spices.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spices()
    {
        return $this->belongsToMany('App\Spice');
    }

    /**
     * Recipe can be in many categories.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Recipe can have many comments.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function thumbnailPath()
    {
        return '/img/recipes/'.$this->thumbnail;
    }

    /**
     * Get similar recipes to this recipe.
     * @param  integer $limit
     * @return array|null
     */
    public function similarRecipes($limit = 4)
    {
        $recipes = [];

        foreach ($this->categories->shuffle() as $category) {
            foreach ($category->recipes->where('id', '!=', $this->id)->shuffle() as $recipe){
                $recipes[$recipe->id] = $recipe;

                if (count($recipes) == $limit)
                    break(2);
            }
        }
        return count($recipes) ? $recipes : null;
    }

    public function syncAndSave(RecipeRequest $request)
    {
        $this->categories()->sync($request->input('categories'));
        $this->ingredients()->sync($request->input('ingredients'));
        $this->spices()->sync($request->input('spices'));

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = str_random(2).time().'.'.$thumbnail->getClientOriginalExtension();
            // upload thumbnail image
            Image::make($thumbnail)->resize(400, 250)->save(public_path('img/recipes/'.$filename));

            if ($this->thumbnail && $this->thumbnail !== 'default.jpg')
                unlink(public_path('img/recipes/'.$this->thumbnail));

            $this->thumbnail = $filename;
        }
        $this->updated_at = \Carbon\Carbon::now();
        $this->save();
    }

}
