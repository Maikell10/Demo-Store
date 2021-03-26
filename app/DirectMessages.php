<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectMessages extends Model
{
    protected $fillable = ['order_id', 'user_id', 'body', 'type', 'status', 'date_order'];

    //Relacion con usuarios
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
