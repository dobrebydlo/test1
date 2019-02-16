<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    public $incrementing = false;

    protected $primaryKey = 'number';
    protected $fillable = [
        'number',
        'user_id',
        'type_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CardType::class, 'type_id');
    }
}
