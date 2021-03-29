<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['product_id', 'user_id', 'rating', 'review'];

    //Relacion con usuarios
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    //Relacion con productos
    public function products()
    {
        return $this->belongsTo(Cart::class);
    }
}
