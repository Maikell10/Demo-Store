<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id', 'user_id', 'product_id', 'cant', 'price_purchase', 'price_sell'
    ];

    // Relataion Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    // Relataion Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relataion Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
