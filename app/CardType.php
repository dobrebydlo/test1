<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

}
