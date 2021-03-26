<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['product_id', 'user_id', 'parent_id', 'body', 'status'];

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

    //Relacion con comentarios para responder
    public function answers()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
