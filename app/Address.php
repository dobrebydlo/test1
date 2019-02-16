<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'street',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
