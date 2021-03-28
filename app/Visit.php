<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'ip_client'
    ];

    //Relacion con productos
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
