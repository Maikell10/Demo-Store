<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function main_category()
    {
        return $this->belongsTo(MainCategory::class);
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    //Relacion con usuarios
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimesTamps();
    }

    //Relacion con comentarios para responder
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id')->orderBy('created_at', 'desc');
    }

}
