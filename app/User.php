<?php

namespace App;

use App\Recipe;
use App\Mail\Promotion;
use App\Mail\VerifyEmail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Notifications\Notifiable;
use App\Models\AuthenticatableVerifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends AuthenticatableVerifiable
{
    use Notifiable, SoftDeletes;

    /**
     * The user attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'slug', 'bio', 'password',
    ];

    /**
     * The user attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token',
    ];

    /**
     * Every user has one of the roles (instance of UserRole).
     * @return void
     */
    public function role()
    {
        return $this->belongsTo('App\Models\UserRole');
    }

    /**
     * User can have many recipes.
     * @return void
     */
    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }

    /**
     * Re-send the e-mail verifiacion (if not verified from welcome mail).
     * @return void
     */
    public function sendEmailVerification()
    {
        if (! $this->verified)
            Mail::to($this)->send(new VerifyEmail($this));
    }

    /**
     * Send the password reset notification.
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPassword($token));
    }

    /**
     * Send the user promotion email notification.
     * @return void
     */
    public function sendPromotionNotification()
    {
        Mail::to($this)->send(new Promotion($this));
    }


    public function avatarPath()
    {
        return '/img/avatars/'.$this->avatar;
    }
    public function coverPath()
    {
        return '/img/covers/'.$this->cover;
    }

    public function saveAvatar($file)
    {
        $this->avatar = $this->saveImage($file, 'img/avatars/', 120, 120, $this->avatar);
    }
    public function saveCover($file)
    {
        $this->cover = $this->saveImage($file, 'img/covers/', 750, 400, $this->cover);
    }

    private function saveImage($file, $path, $x, $y, $actualImage = 'default.png')
    {
        $filename = str_random(4).time().'.'.$file->getClientOriginalExtension();

        Image::make($file)->resize($x, $y)->save(public_path($path . $filename));

        if ($actualImage && $actualImage !== 'default.png')
            unlink(public_path($path . $actualImage));

        return $filename ? $filename : 'default.png';
    }

    public function deleteAvatar()
    {
        if ($this->avatar !== 'default.png') {
            unlink(public_path('img/avatars/' . $this->avatar));
            $this->avatar = 'default.png';
        }
    }
    public function deleteCover()
    {
        unlink(public_path('img/covers/' . $this->cover));
        $this->cover = NULL;
    }


    public function isCook()
    {
        return $this->role_id > 1;
    }
    public function isPro()
    {
        return $this->role_id > 2;
    }
    public function isAdmin()
    {
        return $this->role_id >= 5;
    }

    public function canEditRecipe(Recipe $recipe)
    {
        return $this->id == $recipe->user_id || $this->isAdmin();
    }

}
