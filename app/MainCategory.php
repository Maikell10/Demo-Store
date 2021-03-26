<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $fillable=['nombre','slug','descripcion'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }
}
