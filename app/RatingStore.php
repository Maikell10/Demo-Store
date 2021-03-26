<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingStore extends Model
{
    protected $fillable = ['user_id', 'store_user_id', 'rating', 'opinion', 'option', 'selectOption', 'status'];

    //Relacion con usuarios
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
