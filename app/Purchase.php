<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'date', 'provider_id', 'user_id', 'serie', 'number', 'tax', 'total', 'state'
    ];

    // Relataion Provider
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    // Relataion Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
