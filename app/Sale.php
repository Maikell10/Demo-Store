<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['product_id', 'cantidad', 'user_id', 'price_sale'];

    //Relacion con usuarios
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relacion con productos
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
