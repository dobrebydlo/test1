<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemPurchase extends Pivot
{
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'item_id',
        'purchase_id',
        'price',
        'quantity',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
