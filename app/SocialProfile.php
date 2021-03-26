<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    protected $fillable = ['user_id', 'social_id', 'social_name', 'social_avatar'];

    // Relataion Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
