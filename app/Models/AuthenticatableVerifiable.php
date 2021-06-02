<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthenticatableVerifiable extends Authenticatable
{
    /**
     * The user attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token',
    ];

    /**
     * Verify the user's email address.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }

    /**
     * Unverify the user's email address.
     *
     * @return void
     */
    public function unconfirmEmail()
    {
        $this->verified = false;
        $this->token = str_random(30);
        $this->save();
    }

    /**
     * Boot the model. When creating an instance, add a token for email verification.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->token = str_random(30);
        });
    }

}
