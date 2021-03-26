<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id', 'cantidad', 'user_id', 'price_cart'];

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
