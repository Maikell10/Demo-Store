<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['product_id', 'user_id', 'rating', 'review'];

    //Relacion con usuarios
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relacion con productos
    /*public function products()
    {
        return $this->belongsTo(Cart::class);
    }*/

    //Relacion con productos
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
