<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Item
 * @package App
 * @property string $name
 * @property float $price
 * @property Collection $purchases
 */
class Item extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)->using(ItemPurchase::class);
    }
}
