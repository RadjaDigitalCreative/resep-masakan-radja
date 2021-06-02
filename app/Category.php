<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Models\TimestampsModel
{
    use SoftDeletes;

    /**
     * The user attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'color'
    ];

    /**
     * There are many Recipes in every Category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recipes()
    {
        return $this->belongsToMany('App\Recipe');
    }

}
