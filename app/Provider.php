<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name', 'document', 'number', 'phone', 'email', 'user_id'
    ];

    // Relataion Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
