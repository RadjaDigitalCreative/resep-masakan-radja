<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Models\TimestampsModel
{
    /**
     * The user attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    /**
     * Every Comment belongs to one Recipe.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    /**
     * A Comment was written by one User.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
