<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Models\TimestampsModel
{
    use SoftDeletes;

    /**
     * The user attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];

    /**
     * Every Ingredient can be used in many Recipes.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recipes()
    {
        return $this->belongsToMany('App\Recipe');
    }

}
