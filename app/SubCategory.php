<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable=['nombre','slug','descripcion'];

    public function mainCategories(){
        return $this->hasMany(MainCategory::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
