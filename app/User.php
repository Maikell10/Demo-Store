<?php

namespace App;

use App\StorePermission\Traits\UserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sale'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function social_image()
    {
        $social_profile = $this->socialProfiles->first();

        if ($social_profile) {
            return $social_profile->social_avatar;
        } else {
            $error = 'no hay img';
            return $error;
        }
    }


    // Relations Socialite
    public function SocialProfiles()
    {
        return $this->hasMany(SocialProfile::class);
    }
}
