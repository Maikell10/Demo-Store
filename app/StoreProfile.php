<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProfile extends Model
{
    protected $fillable = [
        'user_id', 'contact_phone', 'facebook', 'twitter', 'instagram', 'gmaps'
    ];

    // Relataion Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
