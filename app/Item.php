<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = [
        'name',
        'price',
    ];

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)->using(ItemPurchase::class);
    }
}
